<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once __DIR__ . '../../../vendor/autoload.php';
class GDRIVE
{
	private static $oauth_credentials;
	private static function isWebRequest()
	{
		return isset($_SERVER['HTTP_USER_AGENT']);
	}

	private static function pageHeader($title)
	{
		$ret = "<!doctype html>
  <html>
  <head>
    <title>" . $title . "</title>
    <link href='styles/style.css' rel='stylesheet' type='text/css' />
  </head>
  <body>\n";
		if ($_SERVER['PHP_SELF'] != "/index.php") {
			$ret .= "<p><a href='index.php'>Back</a></p>";
		}
		$ret .= "<header><h1>" . $title . "</h1></header>";

		// Start the session (for storing access tokens and things)
		// if (!headers_sent()) {
		// 	session_start();
		// }

		return $ret;
	}


	private static function pageFooter($file = null)
	{
		$ret = "";
		if ($file) {
			$ret .= "<h3>Code:</h3>";
			$ret .= "<pre class='code'>";
			$ret .= htmlspecialchars(file_get_contents($file));
			$ret .= "</pre>";
		}
		$ret .= "</html>";

		return $ret;
	}

	private static function missingApiKeyWarning()
	{
		$ret = "
    <h3 class='warn'>
      Warning: You need to set a Simple API Access key from the
      <a href='http://developers.google.com/console'>Google API console</a>
    </h3>";

		return $ret;
	}

	private static function missingClientSecretsWarning()
	{
		$ret = "
    <h3 class='warn'>
      Warning: You need to set Client ID, Client Secret and Redirect URI from the
      <a href='http://developers.google.com/console'>Google API console</a>
    </h3>";

		return $ret;
	}

	private static function missingServiceAccountDetailsWarning()
	{
		$ret = "
    <h3 class='warn'>
      Warning: You need download your Service Account Credentials JSON from the
      <a href='http://developers.google.com/console'>Google API console</a>.
    </h3>
    <p>
      Once downloaded, move them into the root directory of this repository and
      rename them 'service-account-credentials.json'.
    </p>
    <p>
      In your application, you should set the GOOGLE_APPLICATION_CREDENTIALS environment variable
      as the path to this file, but in the context of this example we will do this for you.
    </p>";

		return $ret;
	}

	private static function missingOAuth2CredentialsWarning()
	{
		$ret = "
    <h3 class='warn'>
      Warning: You need to set the location of your OAuth2 Client Credentials from the
      <a href='http://developers.google.com/console'>Google API console</a>.
    </h3>
    <p>
      Once downloaded, move them into the root directory of this repository and
      rename them 'oauth-credentials.json'.
    </p>";

		return $ret;
	}

	private static function invalidCsrfTokenWarning()
	{
		$ret = "
    <h3 class='warn'>
      The CSRF token is invalid, your session probably expired. Please refresh the page.
    </h3>";

		return $ret;
	}

	private static function checkServiceAccountCredentialsFile()
	{
		// service account creds
		$application_creds = __DIR__ . '/../../service-account-credentials.json';

		return file_exists($application_creds) ? $application_creds : false;
	}

	private static function getCsrfToken()
	{
		if (!isset($_SESSION['csrf_token'])) {
			$_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
		}

		return $_SESSION['csrf_token'];
	}

	private static function validateCsrfToken()
	{
		return isset($_REQUEST['csrf_token'])
			&& isset($_SESSION['csrf_token'])
			&& $_REQUEST['csrf_token'] === $_SESSION['csrf_token'];
	}

	private static function getOAuthCredentialsFile()
	{
		// oauth2 creds
		$oauth_creds = __DIR__ . '../../../g/oauth-credentials.json';

		if (file_exists($oauth_creds)) {
			return $oauth_creds;
		}

		return false;
	}

	private static function setClientCredentialsFile($apiKey)
	{
		$file = __DIR__ . '/../../tests/.apiKey';
		file_put_contents($file, $apiKey);
	}


	private static function getApiKey()
	{
		$file = __DIR__ . '/../../tests/.apiKey';
		if (file_exists($file)) {
			return file_get_contents($file);
		}
	}

	private static function setApiKey($apiKey)
	{
		$file = __DIR__ . '/../../tests/.apiKey';
		file_put_contents($file, $apiKey);
	}

	private static function pre()
	{
		if (!self::$oauth_credentials = self::getOAuthCredentialsFile()) {
			echo self::missingOAuth2CredentialsWarning();
			return;
		}
	}

	public static function upload($type, $name, $file_name = null, $folderName = null)
	{
		self::pre();
		$redirect_uri = current_url();
		$client = new Google_Client();
		$client->setAuthConfig(self::$oauth_credentials);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("https://www.googleapis.com/auth/drive");
		$service = new Google_Service_Drive($client);
		$optParams = array(
			'pageSize' => 999,
			'fields' => 'nextPageToken, files',
		);
		// add "?logout" to the URL to remove a token from the session
		// if (isset($_REQUEST['logout'])) {
		// 	unset($_SESSION['upload_token']);
		// }

		/************************************************
		 * If we have a code back from the OAuth 2.0 flow,
		 * we need to exchange that with the
		 * Google_Client::fetchAccessTokenWithAuthCode()
		 * function. We store the resultant access token
		 * bundle in the session, and redirect to ourself.
		 ************************************************/
		if (isset($_SESSION['code'])) {
			$token = $client->fetchAccessTokenWithAuthCode($_SESSION['code']);
			// $token = file_get_contents(__DIR__ . '../../../g/access-token.json');
			$client->setAccessToken($token);
			// store in the session also
			$_SESSION['upload_token'] = $token;
			unset($_SESSION['code']);

			// redirect back to the example
			// header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}

		if (!empty($_SESSION['upload_token'])) {
			$client->setAccessToken($_SESSION['upload_token'], true);
			if ($client->isAccessTokenExpired()) {
				unset($_SESSION['upload_token']);
				// $refreshTokenSaved = $client->getRefreshToken();
				// $client->fetchAccessTokenWithRefreshToken($refreshTokenSaved);
				// $updatedAccessToken = $client->getAccessToken();
				// $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
				// $client->setAccessToken($updatedAccessToken);
			}
		} else {
			$authUrl = $client->createAuthUrl();
			error("silahkan melakukan autentikasi google drive", ['url' => $authUrl]);
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && $client->getAccessToken()) {


			$loc = UPLOAD_FILE::type($type, $name, 'gdrive', $file_name);
			DEFINE("TESTFILE", $loc);
			$name = str_replace('uploads/gdrive/', '', $loc);
			$folderId = null;
			if ($folderName !== null) {
				$results = $service->files->listFiles($optParams);
				$having = false;
				foreach ($results->files as $data) {
					if ($data->name == $folderName && $data->trashed == false) {
						$folderId = $data->id;
						$having = true;
						break;
					}
				}
				if (!$having) {
					$fileMeta = new Google_Service_Drive_DriveFile();
					$fileMeta->name = $folderName;
					$fileMeta->mimeType = 'application/vnd.google-apps.folder';
					$object = new StdClass;
					$folder = $service->files->create($fileMeta, (array) $object->fields = 'id');
					$folderId = $folder->id;
				}
			}
			$file = new Google_Service_Drive_DriveFile();
			$file->name = $name;
			$file->parents = (array) $folderId;
			$result = $service->files->create($file, [
				'data' => file_get_contents(base_url() . $loc),
				'mimeType' => 'application/octet-stream',
				'uploadType' => 'media'
			]);
			// $chunkSizeBytes = 1 * 1024 * 1024;

			// Call the API with the media upload, defer so it doesn't immediately return.
			// $client->setDefer(true);

			// // Create a media file upload to represent our upload process.
			// $media = new Google_Http_MediaFileUpload(
			// 	$client,
			// 	$request,
			// 	'multipart/media',
			// 	null,
			// 	true,
			// 	$chunkSizeBytes
			// );
			// $media->setFileSize(filesize(TESTFILE));

			// // Upload the various chunks. $status will be false until the process is
			// // complete.
			// $status = false;
			// $handle = fopen(TESTFILE, "rb");
			// while (!$status && !feof($handle)) {
			// 	// read until you get $chunkSizeBytes from TESTFILE
			// 	// fread will never return more than 8192 bytes if the stream is read buffered and it does not represent a plain file
			// 	// An example of a read buffered file is when reading from a URL
			// 	$chunk = self::readVideoChunk($handle, $chunkSizeBytes);
			// 	$status = $media->nextChunk($chunk);
			// }

			// The final value of $status will be the data from the API for the object
			// that has been uploaded.
			UPLOAD_FILE::delete($loc, true);
			$id = $result->id;
			return "https://drive.google.com/open?id=$id";
			// $result = false;
			// if ($status != false) {
			// 	$result = $status;
			// 	return $result;
			// } else
			// 	error('error saat upload');

			// fclose($handle);
		} else {
			error("Terjadi masalah ketika melakukan upload file ke google drive");
		}
	}
	private static function readVideoChunk($handle, $chunkSize)
	{
		$byteCount = 0;
		$giantChunk = "";
		while (!feof($handle)) {
			// fread will never return more than 8192 bytes if the stream is read buffered and it does not represent a plain file
			$chunk = fread($handle, 8192);
			$byteCount += strlen($chunk);
			$giantChunk .= $chunk;
			if ($byteCount >= $chunkSize) {
				return $giantChunk;
			}
		}
		return $giantChunk;
	}
}
