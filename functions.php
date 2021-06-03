<?php

// This file is included in the first line of each page

// A session is a way to store information (in variables) to be used across multiple pages
// We are using it for the session variables that display a message on the landing page when an action (Create, Update, Delete) is executed
// The session_start() function must be the very first thing in your document. Before any HTML tags.
session_start();

// Function to connect to the database. The function is called at the top of each page.
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'admin';
    $DATABASE_PASS = 'admin';
    $DATABASE_NAME = 'funding_pdo';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to database!');
    }
}

// Provides the first section of HTML for each page. Dividing page into layout sections keeps application DRY.
function template_header($title) {
// EOT is a delimiter (Heredoc PHP syntax). It is marking where the HTML starts and ends within the PHP file. Helps to keep the code neat!
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>$title</title> 

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="custom.css">
    </head>
    <body>

    <div class="container">
        <h1 class="pt-4 pb-4">Funding Database</h1>
    </div>
EOT;
}

// Provides the end section of HTML for each page
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>
