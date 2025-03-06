<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }
        .container {
            margin-top: 100px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
        }
        .important {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to the API</h1>
        <p>This is a simple API that provides functionalities like user registration, login, profile management, etc.</p>
        <p class="important">This is an API and cannot be accessed through a standard browser view. All interactions must be done via HTTP requests (e.g., POST, GET, PUT, DELETE) to the corresponding API endpoints.</p>
        <p>To use the API, send the appropriate requests to the API endpoints:</p>
        <ul>
            <li><b>/user-crud/api/register.php</b> - Register a new user</li>
            <li><b>/user-crud/api/login.php</b> - Login to the system</li>
            <li><b>/user-crud/api/profile.php</b> - View your profile (requires authentication)</li>
            <li><b>/user-crud/api/update-password.php</b> - Update your password (requires authentication)</li>
            <li><b>/user-crud/api/update-info.php</b> - Update your user information (requires authentication)</li>
            <li><b>/user-crud/api/users.php</b> - View all users (requires authentication)</li>
            <li><b>/user-crud/api/delete.php</b> - Delete user (requires authentication)</li>
            <li><b>/user-crud/api/logout.php</b> - Delete user (requires authentication)</li>
        </ul>
        <p>Use tools like Postman or cURL to interact with the API endpoints.</p>
    </div>

</body>
</html>
