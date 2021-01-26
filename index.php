<?php

use thiagoalessio\TesseractOCR\TesseractOCR;

include 'vendor/autoload.php';

$output = "";

if(isset($_POST["upload"])){

$ufile = "uploads/" . basename($_FILES["fname"]["name"]);

$target_file = move_uploaded_file($_FILES["fname"]["tmp_name"], $ufile);

//echo $ufile;

    $data = (new TesseractOCR($ufile))
            ->lang("eng")
            ->run();

    if ($GLOBALS["generateFile"]) {
        file_put_contents("uploads/text.txt", $data);
    } else {
        $output = $data;
    }

}

?>


<html>
<head>
<title>Image to text</title>
</head>
<body>
<form method="POST" enctype="multipart/form-data">
<input type="file" name="fname">
<input type="submit" name="upload" value="Upload">
</form>

<h2>Generated text:</h2>
<p><?php echo $output; ?></p>
</html>


