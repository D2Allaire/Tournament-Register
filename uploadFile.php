<?php
/**
 * File upload and restrictions
 * Date: 27.01.2016
 */

$dir = 'img/uploads/';
$file = $dir . basename($_FILES["logoUpload"]["name"]);
$uploadOK = 1;
$error = null;
$filetype = pathinfo($file, PATHINFO_EXTENSION);
$thumb_width = 200;
$thumb_height = 200;



// Check if file is a real image
$check = getimagesize($_FILES["logoUpload"]["tmp_name"]);
if ($check !== false) {
    $uploadOK = 1;
}
else {
    $error = 'File is not an image';
    $uploadOK = 0;
}

// Check if file already exists
if (file_exists($file)) {
    $error = 'File already exists.';
    $uploadOK = 0;
}

// Check file size
if ($_FILES["logoUpload"]["size"] > 500000) {
    $error = 'File too large. Maximum filesize: 500 KB';
    $uploadOK = 0;
}

// Limit file type
if ($filetype != 'jpg' && $filetype != 'jpeg' && $filetype != 'png') {
    $error = 'Only JPG or PNG allowed';
    $uploadOK = 0;
}


function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

// Attempt file upload
if ($uploadOK == 0) {
    echo 'Sorry, your file was not uploaded. Reason: ' . $error;
    $picture = null;
}

else {
    $cwd = getcwd();
    if (endsWith($cwd, 'admin')) {
        $cwd = dirname(getcwd());
    }
    if (move_uploaded_file($_FILES["logoUpload"]["tmp_name"], realpath(dirname($cwd)).'/'.$file)) {
        $img = realpath(dirname($cwd)).'/'.$file;
        if ($filetype == 'png') {
            $image = imagecreatefrompng($img);
        } else {
            $image = imagecreatefromjpeg($img);
        }

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect )
        {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        }
        else
        {
            // If the thumbnail is wider than the image
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

        // Resize and crop
        imagecopyresampled($thumb,
            $image,
            0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
            0 - ($new_height - $thumb_height) / 2, // Center the image vertically
            0, 0,
            $new_width, $new_height,
            $width, $height);
        imagejpeg($thumb, $img, 80);

        $picture = $file;
    } else {
        echo 'Sorry, there was an error uploading your file.';
        $picture = null;
    }
}