<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fu"]["name"]);
$uploadOk = 1;




    if (move_uploaded_file($_FILES["fu"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fu"]["name"]). " has been uploaded.<br>";
        $fname=basename( $_FILES["fu"]["name"]);

        echo"uploads/$fname";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

?>