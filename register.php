<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php 

    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        $_SESSION['error'] = '';
    }
    ?>


    <form action="new_user.php" method="POST">
        Username: <input type="text" name="user"><br>
        Password: <input type="password" name="pwd"><br>
        Repeat: <input type="password" name="repeat"><br>
        <input type="submit">
    </form>
</body>

</html>