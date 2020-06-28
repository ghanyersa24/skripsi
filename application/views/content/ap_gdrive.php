<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<?php echo form_open_multipart('TEST/post'); ?>
	<input type="file" name="hayo" id="">
	<input type="submit" value="Click here to upload a large (20MB) test file" />
	</form>
</body>

</html>
