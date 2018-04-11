<?php
require_once 'connection.php';

$connection = mysqli_connect($host, $user, $dbPassword) or die("Error " . mysqli_error($connection));

$query = "SELECT users.email, text 
          FROM guestbookdb.records 
          INNER JOIN guestbookdb.users ON guestbookdb.records.user = guestbookdb.users.id
          ORDER BY records.id DESC";

$result = mysqli_query($connection, $query) or die("Error " . mysqli_error($connection));
if($result) {
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
}