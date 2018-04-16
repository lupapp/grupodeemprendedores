<?php
    /**
     * Add a new userTrack user from the admin dashboard
     */
    include '../../login.php';

    $_GET['level'] = 5;
    include 'getUser.php';

    $name = $_POST['name'];
    $pass = md5($_POST['pass']);

    $query = "INSERT INTO users(name, password) VALUES(:name, :pass)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
?>
