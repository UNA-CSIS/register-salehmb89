<?php session_start();
// session start here...

// get all 3 strings from the form (and scrub w/ validation function)

// make sure that the two password values match!


// create the password_hash using the PASSWORD_DEFAULT argument

// login to the database

// make sure that the new user is not already in the database

// insert username and password hash into db (put the username in the session
// or make them login)

include_once 'validate.php';

$user = test_input($_POST['user']);
$pwd = test_input($_POST['pwd']);
$repeat = test_input($_POST['repeat']);

// Check if username and both passwords have at least one character
if (strlen($user) < 1 || strlen($pwd) < 1 || strlen($repeat) < 1) {
    $_SESSION['error'] = 'All fields are required';
    header("location: register.php");
    exit();
}

if ($pwd !== $repeat) {
    $_SESSION['error'] = 'Passwords do not match';
    header("location: register.php");
    exit();
}

$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['error'] = 'Username already exists';
    header("location: register.php");
    exit();
}

// Insert the new user into the database
$sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_pwd')";
if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $user; // Store username in session
    $_SESSION['error'] = '';
    header("location: games.php"); // Redirect to the games page
    exit();
} else {
    $_SESSION['error'] = 'Registration failed. Please try again.';
    header("location: register.php");
}

$conn->close();
?>

