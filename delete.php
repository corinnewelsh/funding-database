<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

// Check the funder id exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM funders WHERE id=?');
    $stmt->execute([$_GET['id']]);
    $funder = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$funder) {
        exit('Funder does not exist with that ID!');
    }
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Delete" button, delete record
            $stmt = $pdo->prepare('DELETE FROM funders WHERE id=?');
            $stmt->execute([$_GET['id']]);
            // Redirect to landing page
            header("location: index.php");
            // Uses the global _SESSION variable to display message on landing page (the session is started in the functions.php file)
            $_SESSION['message'] = "Record has been deleted!";
            // Set session variable for Bootstrap alert styling
            $_SESSION['msg_type'] = "danger";
        } else {
            // User clicked the "Cancel" button, just redirect to landing page
            header('Location: index.php');
            exit;
        }
    }
    } else {
        exit('No ID specified!');
}
?>

<!-- Calls template_header() with page title. Supplies first section of HTML for the page (DOCTYPE, head, and initial body) -->
<?=template_header('Delete')?>

<div class="container">
    <h2 class="pb-4">Delete <?=$funder['name']?></h2> <!-- Sets h2 heading to "Delete Name of funder" --> 
    <!-- Confirm deletion message referencing Name of funder -->
    <p class="border-top border-danger pt-4 pb-2">Are you sure you want to delete <?=$funder['name']?>?</p>
    <div>
        <!-- Uses word Cancel and less obtrusive button colour for good UX to cancel the delete action -->
        <a class="btn btn-secondary" href="delete.php?id=<?=$funder['id']?>&confirm=no">Cancel</a>
        <!-- Uses word Delete and red button to reinforce delete action for good UX -->
        <a class="btn btn-danger" href="delete.php?id=<?=$funder['id']?>&confirm=yes">Delete</a>
    </div>
</div>

<!-- Calls template_footer() which supplies end section of HTML (closing body and html tags) -->
<?=template_footer()?>
