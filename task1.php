<?php

require_once('dbconnection.php');

// Create the students table
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS students (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    RollNumber VARCHAR(20) NOT NULL,
    Password VARCHAR(8) NOT NULL
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    //echo "Table created successfully!<br>";
} else {
    //echo "Error creating table: " . $conn->error . "<br>";
}

// data
// $name = "Abcd";
// $email = "abcd789@gmail.com";
// $rollNumber = "00667876";

// Function to generate an 8-digit password
function generatePassword() {
    // Generate a random 8-digit number
    return strval(rand(00000000, 99999999));
}
$errorEmail = false;
$errorRoll = false;
if(isset($_POST['submit'])){

$name = $_POST['name'];
$email = $_POST['email'];
$rollnumber = $_POST['rollnumber'];
//$password = $_POST['password'];

$query = "SELECT * FROM students WHERE Email = '$email'"; 
 
    // Execute the query 
    $result = $conn->query($query); 
 
    // Check if the email exists in the database 
    if ($result->num_rows > 0) { 
        $errorEmail = true;
       
    } else { 

        $query = "SELECT * FROM students WHERE RollNumber = '$rollnumber'"; 
 
    // Execute the query 
        $result = $conn->query($query); 
    
        // Check if the email exists in the database 
        if ($result->num_rows > 0) { 
            $errorRoll = true;
        
        }
      else{
        $password = generatePassword();

        // Insert data into the students table
        $sqlInsertData = "INSERT INTO students (Name, Email, RollNumber, Password) VALUES ('$name', '$email', '$rollnumber', '$password')";

        if ($conn->query($sqlInsertData) === TRUE) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
        }
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
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>Registration Form</h2>
            <?php
             if($errorEmail) {
                echo "<span class='red'> The email exists in the database</span>";
             }
             if($errorRoll) {
                echo "<span class='red'> The Roll Number exists in the database</span>";
             }
             
            ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="rollnumber">Roll Number:</label>
                <input type="number" id="rollnumber" name="rollnumber" required>
            </div>
           
            <button type="submit" name="submit">Register</button>
        </form>
    </div>
</body>
</html>
