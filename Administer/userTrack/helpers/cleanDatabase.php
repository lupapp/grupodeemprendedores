<?php
    include '../login.php';
    
    $domain = $_POST['domain'];
    
    // Get all clients for current domain
    $query = "SELECT id FROM clients WHERE domain = :domain";
    $clientsStmt  = $db->prepare($query);
    $clientsStmt->bindValue(':domain', $domain, PDO::PARAM_STR);
    $clientsStmt->execute();

    while($res = $clientsStmt->fetch(PDO::FETCH_ASSOC)) {
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
    }
?>
