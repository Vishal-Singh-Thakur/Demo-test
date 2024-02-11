<?php
session_start();
if(!isset($_SESSION['studentID'])){
    $newURL = "task2.php";
header('Location: '.$newURL);
die;
}

?>
<?php

require_once('dbconnection.php');


// Create the students table
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS blogs (
    BlogID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    Description TEXT NOT NULL,
    Image VARCHAR(255),
    StudentID INT
)";
if ($conn->query($sqlCreateTable) === TRUE) {
    //echo "Table created successfully!<br>";
} else {
    //echo "Error creating table: " . $conn->error . "<br>";
}
// Handle blog post form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $title = $_POST["title"];
    $description = $_POST["description"];
    // Note: You'll need additional code to handle file uploads for the image.

    // Get the StudentID from the session or your authentication system
    // For this example, let's assume StudentID is stored in a session variable
    
    $studentID = $_SESSION['studentID'];

    $targetDir = "uploads/";

    // Get the uploaded file name
    $fileName = basename($_FILES["image"]["name"]);

    // Get the path to save the uploaded file
    $targetFilePath = $targetDir . $fileName;

    // Get the file extension
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if the file is an image
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            echo "The file " . $fileName . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    }

    // Insert data into the blogs table
    $query = "INSERT INTO blogs (Title, Description, StudentID,Image) VALUES ('$title', '$description', '$studentID','$fileName')";

    if ($conn->query($query) === TRUE) {
        echo "Blog post successful!";
    } else {
        echo "Error posting blog: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post</title>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(128,128,128);
        }
		.blog-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
		input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
		button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
	</style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="blog-container">
        <h2>Create a Blog Post</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required></br>
            <textarea name="description" placeholder="Description" required></textarea></br>
            <input type="file" name="image" id="image"></br>
            <button type="submit">Post Blog</button>
        </form>
    </div>
</body>
</html>
