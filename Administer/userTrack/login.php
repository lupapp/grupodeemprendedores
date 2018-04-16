<?php

include 'dbconfig.php';

//Get password & username from input or cookie
$pass = isset($_POST['pw']) ? md5($_POST['pw']) : @$_COOKIE["userTrackPassword"];
$user = isset($_POST['user']) ? $_POST['user'] : @$_COOKIE["userTrackUsername"];

$loggedIn = false;

//Check login
$stmt = $db->prepare("SELECT * FROM users WHERE name = :name AND password = :password");
$stmt->bindValue(':name', $user, PDO::PARAM_STR);
$stmt->bindValue(':password', $pass, PDO::PARAM_STR);
$stmt->execute();

$rows = $stmt->fetchAll();
$loggedIn = count($rows);

//If login is incorrect
if($loggedIn != 1){
        
    //If in cookie is stored a wrong username
    if( isset($_COOKIE["userTrackUsername"]) ){
        setcookie("userTrackUsername", '', time()-3600, "/");
        header("location:login.php");
    }
?>
    <!doctype html>
    <html>
    <head>
        <link rel="stylesheet" href="css/login.css" />
    </head>
    <body>
        <div>
            <img src="images/usertrack.png" alt="userTrack"/><h3>Incorrect password.</h3>
            <form action="login.php" method="post">
                Username: <input type="text" name="user"/><br/>
                Password: <input type="password" name="pw"/><br />
                <input type="submit" />
            </form>
            <br />
            If you do not know what your password is see the Quick Start Guide.
        </div>
    </body>
    </html>
        
<?php
    die();
}

//Ok, log in
$row = $rows[0];
$userId = $row['id'];
$level = $row['level'];

//Set login cookies
setcookie("userTrackPassword", $pass, time()+2592000, "/");
setcookie("userTrackUsername", $user, time()+2592000, "/");
setcookie("userTrackUserid", $userId, time()+2592000, "/");
setcookie("userTrackUserLevel", $level, time()+2592000, "/");
    
if(!isset($_COOKIE["userTrackUsername"])){    
    sleep(2);
    header("location:index.html");
}

?>