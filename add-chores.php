
<?php 
include('shared/auth.php');
// Setting the title variable for the page
$title = 'Add Chore'; 
// Including the header.php file which likely contains the header section of the page
include('shared/header.php'); 

?>
>
<!-- Start of HTML body -->
<h2>Add a New Chore</h2>

<!-- Form for adding a new chore -->
<form method="post" action="insert-chore.php" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Name: *</label>
        <input name="name" id="name" required />
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
    <?php
     try {
        // connect
        include('shared/db.php');
             // disconnect
             $db = null;
            }
            catch (Exception $err) {
                //Example Email Send: mail('me@domain.com', 'PHP TV Error', $err);
                header('location:error.php');
                exit();
            }
            ?>
            </select>
        </fieldset>
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
    </fieldset>
    <!-- Submit button for the form -->
    <button class="offset-button">Submit</button>
</form>
<!-- End of form -->
</main>
<!-- End of HTML body -->
</body>
</html>
