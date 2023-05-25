<?php
session_start();

$servername = isset($_SESSION['servername']) ? $_SESSION['servername'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
$database = isset($_SESSION['database']) ? $_SESSION['database'] : '';

if (isset($_POST['executeQuery'])) {
    $servername = $_POST['servername'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];
    $query = $_POST['query'];
    header('Location: ' . $_SERVER['PHP_SELF']);
    $_SESSION['servername'] = $servername;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['database'] = $database;
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($query);

    if ($result === TRUE) {
        echo "Query executed successfully<br>";
    } else {
        echo "Error executing query: " . $conn->error . "<br>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
    input[type="text"],
    textarea {
        width: 300px;
        height: 100px;
    }
    </style>
</head>

<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="servername">Server Name:</label><br>
        <input type="text" id="servername" name="servername" value="<?php echo $servername; ?>"><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>

        <label for="database">Database Name:</label><br>
        <input type="text" id="database" name="database" value="<?php echo $database; ?>"><br>

        <label for="query">Custom Query:</label><br>
        <textarea id="query" name="query"></textarea><br>

        <button type="submit" name="executeQuery">Query</button>
    </form>
</body>

</html>