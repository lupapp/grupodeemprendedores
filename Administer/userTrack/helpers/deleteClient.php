<?php
    require_once '../login.php';
  
    $token = $_POST['token'];

    // Get clientID from token
    $query = "SELECT id FROM clients WHERE token = :token";
    $stmt  = $db->prepare($query);
    $stmt->bindValue(':token', $token, PDO::PARAM_STR);
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$res)
        return;
    $clientID = $res['id'];

    $query = array();

    // Delete records
    $query[] = "DELETE from records WHERE client in (SELECT id FROM clientpage WHERE clientid = :clientid)";
    // Delete partial records
    $query[] = "DELETE from partials WHERE client in (SELECT id FROM clientpage WHERE clientid = :clientid)";
    // Delete movements
    $query[] = "DELETE from movements WHERE client in (SELECT id FROM clientpage WHERE clientid = :clientid)";
    // Delete clicks
    $query[] = "DELETE from clicks WHERE client in (SELECT id FROM clientpage WHERE clientid = :clientid)";
    // Delete clientpages
    $query[] = "DELETE from clientpage WHERE clientid = :clientid";
    // Delete the client itself
    $query[] = "DELETE from clients WHERE id = :clientid";

    foreach($query as $q){
        $stmt = $db->prepare($q);
        $stmt->bindValue(':clientid', $clientID, PDO::PARAM_INT);
        $stmt->execute();
    }   
?>