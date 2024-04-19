<?php 
include('shared/auth.php');
$title = 'Edit Chore';
try {
    // connect
    include('shared/db.php');

    // Get the choreId from the URL parameter using $_GET
    $choreId = $_GET['choreId'];

    // Initialize variables
    $name = null;
    $time = null;
    $date = null;
    $chore = null;

    // If choreId is numeric, fetch chore from the database
    if (is_numeric($choreId)) {

        // Connect to the database
        include('shared/db.php');

        // Run query and populate chore properties for display
        $sql = "SELECT * FROM category WHERE choreId = :choreId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':choreId', $choreId, PDO::PARAM_INT);
        $cmd->execute();
        $chore = $cmd->fetch();  // use fetch() for 1 record instead of fetchAll() which is for a list

        $name = $chore['name'];
        $choreName = $chore['chore'];
        $time = $chore['time'];
        $date = $chore['date'];
        $photo = $chore['photo'];  // fill var w/show photo name if there is one
    }
} catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chore</title>
</head>
<body>
    <h2>Edit Chore Details</h2>
    <form method="post" action="update-chore.php" enctype="multipart/form-data">
        <fieldset>
            <label for="name">Name: *</label>
            <input name="name" id="name" required value="<?php echo $name; ?>" />
        </fieldset>
        <fieldset>
            <label for="date">Date (YYYY-MM-DD): *</label>
            <input type="text" name="date" id="date" placeholder="YYYY-MM-DD" required />
        </fieldset>
        <fieldset>
            <label for="time">Time (H-M-S): *</label>
            <input type="text" name="time" id="time" placeholder="H-M-S" required />
        </fieldset>

        <fieldset>
            <label for="chore">Chore: *</label>
            <input name="chore" id="chore" required />
        </fieldset>
        <input type="hidden" name="choreId" id="choreId" value="<?php echo $choreId; ?>" />
        <fieldset>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*" />
            <input type="hidden" id="currentPhoto" name="currentPhoto" value="<?php echo $photo; ?>" />
            <?php
            if ($photo != null) {
                echo '<img src="img/uploads/' . $photo . '" alt="Show Photo" />';
            }
            ?>
        </fieldset>
        <button class="offset-button">Submit</button>
        
    </form>
</body>
</html>
