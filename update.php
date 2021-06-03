<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

// Check if the funder id exists. For example, "update.php?id=1" will get the funder with the id of 1.
if (isset($_GET['id'])) {
    // Check if POST data is not empty (this part is similar to create.php, but instead we update a record not insert)
    if (!empty($_POST)) {
        // Post data not empty update record
        // Set up the variables that are going to be updated. We must check if the POST variables exist; if not, we can default them to blank.
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        // Check if POST variable "name" exists; if not, default the value to blank. (We do the same for each variable.)
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $deadline = isset($_POST['deadline']) ? $_POST['deadline'] : '';
        $details = isset($_POST['details']) ? $_POST['details'] : '';
        // Update the record. The id field must be left out of SET (unlike in create.php) because it is the idenifier and not changed.
        $stmt = $pdo->prepare('UPDATE funders SET name=?, description=?, amount=?, deadline=?, details=? WHERE id=?');
        $stmt->execute([$name, $description, $amount, $deadline, $details, $_GET['id']]);
        // Redirect to the landing page
        header("location: index.php");
        // Uses the global _SESSION variable to display message on landing page (the session is started in the functions.php file)
        $_SESSION['message'] = "Record has been updated!";
        // Set session variable for Bootstrap alert styling
        $_SESSION['msg_type'] = "warning";
    }

    // Get the funder record from the funders table
    $stmt = $pdo->prepare('SELECT * FROM funders WHERE id=?');
    $stmt->execute([$_GET['id']]);
    $funder = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$funder) {
        exit('Funder does not exist with that ID!');
    }
    } else {
        exit('No ID specified!');
    }
?>

<!-- Calls template_header() with page title. Supplies first section of HTML for the page (DOCTYPE, head, and initial body) -->
<?=template_header('Update')?>

<div class="container">
    <h2><?=$funder['name']?> (EDIT)</h2> <!-- Sets h2 heading to "Name of funder (EDIT)" --> 
    <div class="row justify-content-center">
        <form action="update.php?id=<?=$funder['id']?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <!-- Inserts the value of the "name" variable into form for editing. (We do the same for each form field.) -->
                <input type="text" name="name" id="name" value="<?=$funder['name']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <!-- For the "description" variable, we put this between the textarea tags (without value=) -->
                <textarea name="description" id="description" class="form-control"><?=$funder['description']?></textarea>
            </div>
            <div class="form-group">
                <label for="amount">Grant Size</label>
                <input type="text" name="amount" id="amount" value="<?=$funder['amount']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="deadline">Deadline(s)</label>
                <input type="text" name="deadline" id="deadline" value="<?=$funder['deadline']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="details">Link to further information</label>
                <input type="text" name="details" id="details" value="<?=$funder['details']?>" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-info">
            </div>
        </form>
    </div>
    <div>
        <a href="index.php">Back to Database</a>
    </div>

<!-- Calls template_footer() which supplies end section of HTML (closing body and html tags) -->
<?=template_footer()?>
