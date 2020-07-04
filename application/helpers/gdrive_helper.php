<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once __DIR__ . '../../../vendor/autoload.php';
class GDRIVE
{
	private static $oauth_credentials;
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

	private static function getOAuthCredentialsFile()
	{
		// oauth2 creds
		$oauth_creds = __DIR__ . '../../../g/oauth-credentials.json';

		if (file_exists($oauth_creds)) {
			return $oauth_creds;
		}

		return false;
	}

	private static function pre()
	{
		if (!self::$oauth_credentials = self::getOAuthCredentialsFile()) {
			echo self::missingOAuth2CredentialsWarning();
			return;
		}
	}
	public static function listDrive()
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
		return $service->files->listFiles($optParams);
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
		if (isset($_SESSION['code'])) {
			$token = $client->fetchAccessTokenWithAuthCode($_SESSION['code']);
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
			UPLOAD_FILE::delete($loc, true);
			$id = $result->id;
			return ['name' => $name, 'url' => "https://drive.google.com/file/d/$id/view"];
		} else {
			error("Terjadi masalah ketika melakukan upload file ke google drive");
		}
	}

	public static function download($name)
	{
		$data = self::listDrive()->files;
		foreach ($data as $key) {
			if ($key->originalFilename == $name) {
				return $key->webContentLink;
			}
		}
	}
}
