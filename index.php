<?php require_once('dbconnection.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
	<style>
body {
    font-family: Arial, sans-serif;
    background-color: rgb(128,128,128);
    margin: 0;
}

.dashboard {
    background-color: #fff;
    padding: 20px;
    text-align: center;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    display: inline-block;
    margin-right: 20px;
}

a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

a:hover {
    color: #4caf50;
}
	
	</style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <h2>Welcome to the Student Dashboard</h2>
        <ul>
            <li><a href="task2.php">Login</a></li>
            <li><a href="task3.php">Create Blog Post</a></li>
            <li><a href="task4.php">View Your Blogs</a></li>
        </ul>
    </div>
</body>
</html>