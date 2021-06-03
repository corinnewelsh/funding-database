<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set up the variables that are going to be inserted. We must check if the POST variables exist; if not, we can default them to blank.
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists; if not, default the value to blank. (We do the same for each variable.)
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $deadline = isset($_POST['deadline']) ? $_POST['deadline'] : '';
    $details = isset($_POST['details']) ? $_POST['details'] : '';
    // Insert new record into the funders table. (There is no "id" field on the form but it must be included here because an id is created.)
    $stmt = $pdo->prepare('INSERT INTO funders VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $description, $amount, $deadline, $details]);
    // Redirect to the landing page
    header("location: index.php");
    // Uses the global _SESSION variable to display message on landing page (the session is started in the functions.php file)
    $_SESSION['message'] = "Record has been saved!";
    // Set session variable for Bootstrap alert styling
    $_SESSION['msg_type'] = "success";
}
?>

<!-- Calls template_header() with page title. Supplies first section of HTML for the page (DOCTYPE, html, head, and initial body). -->
<?=template_header('Create')?>

<div class="container">
    <h2>Add Funder</h2>
    <div class="row justify-content-center">
        <form action="create.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="amount">Grant Size</label>
                <input type="text" name="amount" id="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline(s)</label>
                <input type="text" name="deadline" id="deadline" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="details">Link to further information</label>
                <input type="text" name="details" id="details" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Save" class="btn btn-success">
            </div>
        </form>
    </div>
    <div>
        <a href="index.php">Back to Database</a>
    </div>
</div>

<!-- Calls template_footer() which supplies end section of HTML (closing body and html tags)
<?=template_footer()?>
