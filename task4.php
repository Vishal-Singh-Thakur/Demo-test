<?php
session_start();
if(!isset($_SESSION['studentID'])){
    $newURL = "task2.php";
header('Location: '.$newURL);
die;
}

?>
<link rel="stylesheet" href="style.css">
<div class="container">
<?php
// Database connection details
require_once('dbconnection.php');

// Create a database connection


$studentID = $_SESSION['studentID'];

// Retrieve blog posts for the logged-in student
$query = "SELECT * FROM blogs WHERE StudentID = '$studentID'";
$result = $conn->query($query);

// Display the blog list

if ($result->num_rows > 0) {
    ?>
<table>
<tr><th>Title</th><th>Description</th><th>Image</th></tr>
<?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr><td><?php echo $row["Title"]; ?></td><td><?php echo $row["Description"]; ?></td>
      <td><?php if(!empty($row["Image"])) {?><img class="blogimage" src="<?php echo "uploads/". $row["Image"] ?>"> <?php } ?></td>
     </tr>
        
        <?php
    }
        ?>
     <table>  
   <?php 
} else {
    echo "No blog posts found.";
}
// Close the database connection
$conn->close();

?>
</div>
