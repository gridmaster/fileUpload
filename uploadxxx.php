<?php
//phpinfo();
//print_r($_FILES["fileUpload"]);
//echo $imageFile;

if(isset($_FILES["fileUpload"]["name"])) {

	print_r($_FILES["fileUpload"]);
	
	$imageFile = ($_FILES["fileUpload"]["name"]);
	$imageType = ($_FILES["fileUpload"]["type"]);
	$validext = array("jpeg", "jpg", "png");
	$fileExt = pathinfo($imageFile, PATHINFO_EXTENSION );
	echo $fileExt . "<br>";
	$ready = false;

	if((($imageType == "image/jpeg") || ($imageType == "image/jpg") || ($imageType == "image/png")) && in_array($fileExt, $validext)) {
		echo "was valid image<br>";
	}else{
		echo "was not a valid image<br>";
		$ready = false;
	}


	if($_FILES["fileUpload"]["size"] < 500000) {
		$ready = true;
		echo "file size is " . $_FILES["fileUpload"]["size"] . "<br>";
	}else{
		echo "file was TO BIG!<br>";
		echo "file size is " . $_FILES["fileUpload"]["size"] . "<br>";
		$ready = false;
	}

	if($_FILES["fileUpload"]["error"]) {
		echo "looks like there was an error: " . $_FILES["fileUpload"]["error"] . "<br>";
		$ready = false;
	}

}

$targetPath = "images/".$imageFile;
$sourcePath =  $_FILES["fileUpload"]["tmp_name"];
if(file_exists("images/".$imageFile)) {
	echo "File already there <br>";
	$ready = false;
}

if($ready == true) {
	move_uploaded_file($sourcePath, $targetPath);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload </title>
</head>
<body>
	<form action="index.php" method="post" enctype="multipart/form-data">
		<input type="file" name="fileUpload" id="fileUpload">
		<input type="submit" value="Upload file">
	</form>
</body>
</html>