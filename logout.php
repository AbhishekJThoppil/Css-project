<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Chores</title>
    <link rel="stylesheet" href="./css/site.css" />
</head>
<?php
// access current user session
session_start();
session_destroy();
header('location:home.php');
?>
