<?php
if($_FILES){
    $uploadDirectory = "uploads/";
    $uploadFileCopy=uploadDirectory.basename($_FILE['file']['name']);
    if (move_uploaded_file($_FILES["file"]["tmp_name"],$uploadFileCopy)) {
        echo 'si';
    } else {
        echo 'no';
    }
    
}