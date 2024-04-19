<?php
include('shared/auth.php');

// Read the choreId from the URL parameter using $_GET   
$choreId = $_GET['choreId'];

// Check if $choreId is numeric
if (is_numeric($choreId)) {
    try {
        // connect to db
        include('shared/db.php');

        // Prepare SQL DELETE statement
        $sql = "DELETE FROM category WHERE choreId = :choreId"; // Assuming 'choreId' is the primary key column
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':choreId', $choreId, PDO::PARAM_INT);

        // Execute the delete operation
        $cmd->execute();

        // disconnect
        $db = null;

        // Show a message indicating successful deletion
        echo 'Chore Deleted';

        // Redirect back to updated show-chore.php (eventually)
        header('location:show-chore.php');
    } catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
