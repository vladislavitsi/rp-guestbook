<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);
$text = htmlentities($_POST['text']);

require_once 'connection.php';
require_once 'crypto.php';

$connection = mysqli_connect($host, $user, $dbPassword) or die("Error " . mysqli_error($connection));

if (isUserExists($connection, $email)) {
    if (checkPassword($connection, $email, $password)){
        if (createNewRecord($connection, $email, $text)) {
            update();
        }
    } else{
        printError("Wrong password");
    }
}else {
    if (registerNewUser($connection, $email, $password)) {
        if (createNewRecord($connection, $email, $text)) {
            update();
        }
    }
}

mysqli_close($connection);

function isUserExists($connection, $email) {
    $query ="SELECT id FROM guestbookdb.users WHERE email = '$email'";
    $result = mysqli_query($connection, $query) or die("Error " . mysqli_error($connection));
    if($result) {
        if ($result->num_rows > 0) {
            return true;
        }
    }
    return false;
}

function checkPassword($connection, $email, $password) {
    $query ="SELECT password FROM guestbookdb.users WHERE email = '$email'";
    $result = mysqli_query($connection, $query) or die("error " . mysqli_error($connection));
    if($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return verify($password, $row["password"]);
        }
    }
    return false;
}

function createNewRecord($connection, $email, $text) {
    $query ="INSERT INTO guestbookdb.records(user, text) VALUES((SELECT id FROM guestbookdb.users WHERE email = '$email'), '$text')";
    $result = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($connection));
    if(!$result) {
        printError('Error while creating new record in DB');
        return false;
    }
    return true;
}

function update() {
    header("Location: index.php");
}

function printError($error) {
    $_SESSION['error-message'] = "$error";
    header("Location: index.php");
}

function registerNewUser($connection, $email, $password) {
    $passHash = generateHash($password);
    $query ="INSERT INTO guestbookdb.users(email, password) VALUES('$email', '$passHash')";
    $result = mysqli_query($connection, $query) or die("Error " . mysqli_error($connection));
    if(!$result) {
        printError('Error while creating new user');
        return false;
    }
    return true;
}
