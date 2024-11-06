<?php session_start();
// start session

// login to the softball database

// select password from users where username = <what the user typed in>

// if no rows, then username is not valid (but don't tell Mallory) just send
// her back to the login

// otherwise, password_verify(password from form, password from db)

// if good, put username in session, otherwise send back to login

include_once 'validate.php';

$user = test_input($_POST['user']);
$pwd = test_input($_POST['pwd']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    $_SESSION['error'] = 'Invalid username or password';
    header("location: index.php");
    exit();
}

$verified = password_verify($pwd, trim($row['password']));
if ($verified) {
    $_SESSION['username'] = $user;
    $_SESSION['error'] = '';
    header("location: games.php");
    exit();
} else {
    $_SESSION['error'] = 'Invalid username or password';
}



$conn->close();
header("location: index.php");
?>