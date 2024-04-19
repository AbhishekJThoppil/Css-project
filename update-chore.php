<?php
include('shared/auth.php');
$title = 'Saving Chore Updates...';
try {
    // connect to db using the PDO (PHP Data Objects Library)
    include('shared/db.php');

    // capture form inputs into vars
    $choreId = $_POST['choreId'];  // id value from hidden input on form
    $name = $_POST['name'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $chore = $_POST['chore']; // Corrected variable name
    $ok = true;

    // input validation before save
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
    
    // process photo if any
    if ($_FILES['photo']['size'] > 0) { 
        $photoName = $_FILES['photo']['name'];
        $finalName = session_id() . '-' . $photoName;

        // Create the directory if it doesn't exist
        $uploadDirectory = 'img/uploads/';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // in php, file size is bytes (1 kb = 1024 bytes)
        $size = $_FILES['photo']['size']; 

        // temp location in server cache
        $tmp_name = $_FILES['photo']['tmp_name'];

        // file type
        $type = mime_content_type($tmp_name);

        if ($type != 'image/jpeg' && $type != 'image/png') {
            echo 'Photo must be a .jpg or .png';
            exit();
        }
        else {
            // save file to img/uploads
            move_uploaded_file($tmp_name, $uploadDirectory . $finalName);
        }     
    }
    else {
        // no new photo uploaded, keep current photo set in hidden input on form
        // this prevents an existing photo being set to null and removed
        $finalName = $_POST['currentPhoto'];
    }


    if ($ok == true) {
        // set up SQL UPDATE command
        $sql = "UPDATE category SET name = :name, time = :time, 
             date = :date, chore = :chore, photo = :photo WHERE choreId = :choreId";

        // link db connection w/SQL command we want to run
        $cmd = $db->prepare($sql);

        // map each input to a column in the shows table
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':time', $time, PDO::PARAM_INT);
        $cmd->bindParam(':date', $date, PDO::PARAM_STR);
        $cmd->bindParam(':chore', $chore, PDO::PARAM_STR, 100);
        $cmd->bindParam(':choreId', $choreId, PDO::PARAM_INT);
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

        // execute the update (which saves to the db)
        $cmd->execute();

        // disconnect
        $db = null;

        // show msg to user
        echo 'Chore Updated';
    }
} catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>
</main>
</body>
</html>
