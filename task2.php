<?php

require_once('dbconnection.php');session_start(); ?>

<?php
$loginsuccessfull = false;
if(isset($_SESSION['login']) && $_SESSION['login']){
    $loginsuccessfull = true;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollNumber = $_POST["rollNumber"];
    $password = $_POST["password"];

    // Validate user input (you can add more validation)
    if (!empty($rollNumber) && !empty($password)) {

        // Securely retrieve user data from the database
        $query = "SELECT * FROM students WHERE RollNumber = '$rollNumber' AND Password = '$password'";
        $result = $conn->query($query);
       
    
        if ($result->num_rows == 1) {
            // Successful login
            $loginsuccessfull = true;
            $_SESSION['login'] = true;
            while ($row =  $result->fetch_assoc()) {
                $_SESSION['studentID'] = $row['ID'];  
            }

            
        } else {
            // Invalid credentials
            echo "Invalid Roll Number or Password";
        }
    } else {
        // Missing input
        echo "Please enter Roll Number and Password";
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: rgb(128,128,128);
        } */
        .login-container {
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
</head>
<body>

    <div class="login-container">
       
    <?php if(!$loginsuccessfull) { ?>
        <h2>Student Login</h2>
        <form action="" method="post">
            <input type="text" name="rollNumber" placeholder="Roll Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php } else{ ?>
           Login successful!;
           <a href="task3.php" >Create Blog</butaton>
           <a href="task4.php" >List Blog</butaton>
           <a href="logout.php" >Logout</butaton>
            <?php } ?> 
    </div>
    
</body>
</html>
