<?php
/**
 * Created by PhpStorm.
 * User: bert
* Date: 3/07/2015
* Time: 10:37
*/
phpinfo();
if (!empty($_FILES))
{
    print_r($_FILES);
}
?>
<html>
<head>
    <title></title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
</body>
</html>