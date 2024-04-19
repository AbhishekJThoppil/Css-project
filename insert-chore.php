<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Chores</title>
    <link rel="stylesheet" href="./css/site.css" />
</head>
<?php
include('shared/auth.php');
$title = 'Add Chore';
try {
    // connect to db using the PDO (PHP Data Objects Library)
    include('shared/db.php');

    // process photo if any
    if ($_FILES['photo']['size'] > 0) { 
        $photoName = $_FILES['photo']['name'];
        $finalName = session_id() . '-' . $photoName;
        
        // in php, file size is bytes (1 kb = 1024 bytes)
        $size = $_FILES['photo']['size']; 
       

        // temp location in server cache
        $tmp_name = $_FILES['photo']['tmp_name'];
      

        // file type
        // $type = $_FILES['photo']['type']; // never use this - unsafe, only checks extension
        $type = mime_content_type($tmp_name);

        if ($type != 'image/jpeg' && $type != 'image/png') {
            echo 'Photo must be a .jpg or .png';
            exit();
        }
        else {
            // save file to img/uploads
            move_uploaded_file($tmp_name, 'img' . $finalName);
        }

    }

    // Capture form inputs into vars
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $chore = $_POST['chore'];
    $ok = true;

    // Input validation before save
    if (empty($name)) {
        echo 'Name is required<br />';
        $ok = false;
    }

    if (empty($date)) {
        echo 'Date is required<br />';
        $ok = false;
    }

    if (empty($time)) {
        echo 'Time is required<br />';
        $ok = false;
    }

    if (empty($chore)) {
        echo 'Chore is required<br />';
        $ok = false;
    }

    if ($ok == true) {
        // Connect to db using PDO
        include('shared/db.php');

        // Set up SQL INSERT command
        $sql = "INSERT INTO category (name, time, date, chore, photo) 
        VALUES (:name, :time, :date, :chore, :photo)";

        // Link db connection with SQL command
        $cmd = $db->prepare($sql);

        // Bind parameters
        $cmd->bindParam(':name', $name, PDO::PARAM_STR);
        $cmd->bindParam(':date', $date);
        $cmd->bindParam(':time', $time);
        $cmd->bindParam(':chore', $chore, PDO::PARAM_STR);
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

        // Execute the INSERT
        $cmd->execute();

        // Show message to user
        echo 'Chore Saved';
    }
} catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>
</body>
</html>
