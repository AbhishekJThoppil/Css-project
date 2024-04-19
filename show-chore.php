<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Chores</title>
    <link rel="stylesheet" href="./css/site.css" />
</head>
<?php

session_start(); // Start the session

$title = 'Show Chores'; 

// Include the header.php file which likely contains the header section of the page
include('shared/header.php'); 

try {
    // Connect to the database
    include('shared/db.php');

    // Set up query to fetch data
    $sql = "SELECT * FROM category"; // Assuming 'category' is your table name
    $cmd = $db->prepare($sql);

    $cmd->execute();
    $categoryData = $cmd->fetchAll();
} catch (Exception $err) {
    header('location:error.php');
    exit();
}

// Start the list
echo '<h1>Show Chores</h1>';
echo '<table><thead><th>Name</th><th>Photo</th><th>Time</th><th>Date</th><th>Chore</th>';

// Check if the user is logged in to show action buttons
if (!empty($_SESSION['username'])) {
    echo '<th>Actions</th>';
}
echo '</thead>';

// Loop through the data result from the query, and display each chore name
foreach ($categoryData as $category) {
    echo '<tr>
        <td>' . $category['name'] . '</td>
        <td>';
    if ($category['photo'] != null) {
        echo '<img src="img/uploads/' . $category['photo'] . '" class="thumbnail" />';
    }
    echo '</td>
        <td>' . $category['date'] . '</td>
        <td>' . $category['time'] . '</td>
        <td>' . $category['chore'] . '</td>';
    // Display action buttons if the user is logged in
    if (!empty($_SESSION['username'])) {
        echo '<td class="actions">
            <a href="edit.php?choreId=' . $category['choreId'] . '">Edit</a>&nbsp;
            <a href="delete.php?choreId=' . $category['choreId'] . '" onclick="return confirmDelete();">Delete</a>
        </td>';
    }
    echo '</tr>';
}

// End the table
echo '</table>';

// Disconnect from the database
$db = null;
?>
