<?php
    include '../login.php';
    
    $domain = $_POST['domain'];
    
    // Get all the clients for the current page, ordered by date
    $query = "SELECT * FROM clients
              INNER JOIN clientpage
              ON clients.id = clientpage.clientid
              GROUP by token";
    $clientsStmt = $db->prepare($query);
    $clientsStmt->bindValue(':domain', $domain, PDO::PARAM_STR);
    $clientsStmt->execute();
       
    // Count the number of pages visited
    while($row = $clientsStmt->fetch(PDO::FETCH_ASSOC)){
    
        // Get first record ID from records
        $query = "SELECT id FROM records 
                  WHERE client IN (
                    SELECT id FROM clientpage
                    WHERE clientid = :clientid
                  ) ORDER BY id LIMIT 1";

        $stmt  = $db->prepare($query);
        $stmt->bindValue(':clientid', $row['clientid'], PDO::PARAM_INT);
        $stmt->execute();

        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If it was not found in records, search in partials
        if(!$record){
            $query = "SELECT id FROM partials
                      WHERE client IN (
                        SELECT id FROM clientpage
                        WHERE clientid = :clientid
                      ) ORDER BY id LIMIT 1";

            $stmt  = $db->prepare($query);
            $stmt->bindValue(':clientid', $row['clientid'], PDO::PARAM_INT);
            $stmt->execute();

            $record = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // If no first record was found, set recordid to -1
        if(count($record) == 1)
            $recordid = $record['id'];
        else
            $recordid = -1;

        // No records found, delete client
        if($recordid == -1 || $recordid == null) {
                $clientID = $row['clientid'];

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
    };
?>
