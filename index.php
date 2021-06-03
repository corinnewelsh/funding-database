<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get records from funders table ordering by name (A-Z). "LIMIT" will determine the page.
$stmt = $pdo->prepare('SELECT * FROM funders ORDER BY name LIMIT :current_page, :record_per_page');
// Bind variables to the prepared statement as parameters
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
// Execute the prepared statement
$stmt->execute();
// Fetch the records so we can display them in our template
$funders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of funders (this is so we can determine whether there should be a next and previous button)
$num_contacts = $pdo->query('SELECT COUNT(*) FROM funders')->fetchColumn();
?>

<!-- Displays a message at top of the page when an action (Create, Update, Delete) is executed -->
<?php
    if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type'] ?>">

        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>

<!-- Calls template_header with page title. Supplies first section of HTML for the page (DOCTYPE, html, head, and initial body). -->
<?=template_header('Database')?>

<!-- Main page content -->
<div class="container mt-4 mb-5">
    <a href="create.php" class="btn btn-success mb-4">Add Funder</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Descripton</th>
                <th>Grant Size</th>
                <th>Deadline(s)</th>
                <th>Further information</th>
                <th class="actions">Action</th> <!-- Class used in custom.css to force buttons to display side-by-side -->
            </tr>
        </thead>
        <tbody>
            <!-- Loop over each funder in funders and add to the HTML table -->
            <?php foreach ($funders as $funder): ?>
            <tr>
                <td><?=$funder['name']?></td>
                <td><?=$funder['description']?></td>
                <td><?=$funder['amount']?></td>
                <td><?=$funder['deadline']?></td>
                <td><?=$funder['details']?></td>
                <!-- Creates a button link via record's id to update/delete a specific funder -->
                <td>
                    <a href="update.php?id=<?=$funder['id']?>" class="btn btn-info">Edit</a>
                    <a href="delete.php?id=<?=$funder['id']?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination"> <!-- Class used in custom.css to set buttons in flex container and display on right (flex-end) -->
        <!-- Do not show pagination left button (backwards) if on first page -->
        <?php if ($page > 1): ?>
        <a class="btn btn-secondary mr-1" href="index.php?page=<?=$page-1?>"><span class="fas fa-angle-double-left"></span></a>
        <?php endif; ?>
        <!-- Do not show pagination right button (forwards) there are no further pages  -->
        <?php if ($page*$records_per_page < $num_contacts): ?>
        <a class="btn btn-secondary ml-1" href="index.php?page=<?=$page+1?>"><span class="fas fa-angle-double-right"</span></a>
        <?php endif; ?>
    </div>
</div>

<!-- Calls template_footer() which supplies end section of HTML (closing body and html tags) -->
<?=template_footer()?>
