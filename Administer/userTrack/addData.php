<?php

    include 'dbconfig.php';

    // Cross-domain request
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type');

    // Here's the argument from the client.
    $clientPageID = $_POST['clientPageID'];
    $what         = $_POST['what'];
    $json         = null;

    // SQL injection prevention
    $allowedColumns = array('movements', 'clicks', 'record', 'partial');
    if(!in_array($what, $allowedColumns)) {
        die('Datatype invalid: '. $what);
    }

    if($what == 'record' || $what == 'partial') {
        $json = $_POST['record'];
    } else {
        $json = stripslashes($_POST['movements']);
    }

    switch ($what) {
        case 'movements':
        case 'clicks':
            try {
                $query = "INSERT INTO ".$what." (client, data) VALUES (:clientPageID, :json)";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':clientPageID', $clientPageID, PDO::PARAM_INT);
                $stmt->bindValue(':json', $json, PDO::PARAM_STR);
                $stmt->execute();
            }
            catch (PDOException $e) {
                die("Could not insert data into database.\n" . $query);
            }
        break;

        case 'record':
            try {
                $query = "INSERT INTO records (client, record) VALUES (:clientPageID, :json)";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':clientPageID', $clientPageID, PDO::PARAM_INT);
                $stmt->bindValue(':json', $json, PDO::PARAM_STR);
                $stmt->execute();
            }
            catch (PDOException $e) {
                die("Could not insert full record into database.\n" . $query);
            }
        break;

        case 'partial':
            try {
                $query = "INSERT INTO partials (client, record) VALUES (:clientPageID, :json)
                          ON DUPLICATE KEY UPDATE record = :json2";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':clientPageID', $clientPageID, PDO::PARAM_INT);
                $stmt->bindValue(':json', $json, PDO::PARAM_STR);
                $stmt->bindValue(':json2', $json, PDO::PARAM_STR);
                $stmt->execute();
            }
            catch (PDOException $e) {
                print_r($e);
                die("Could not insert partial record into database.\n" . $query);
            }
        break;

        default:
            echo 'Not supported statistics type '.$what;
        break;
    }
?>
