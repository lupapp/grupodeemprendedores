<?php
    include '../login.php';
    
    // Limit clients before displaying them
    $included = 1;
    include 'limitRecordNumber.php';
    
    $from        = @$_POST['from'];
    $take        = @$_POST['take'];
    $domain      = $_POST['domain'];
    $order       = @$_POST['order'];
    $startDate   = @$_POST['startDate'];
    $endDate     = @$_POST['endDate'];

    // Date interval condition can be null or given by POST
    $dateWhere = $startDate != '' ? "AND CAST(`date` AS DATE) BETWEEN :startDate AND :endDate": '';

    $order  = $order  == '' ? "DESC" : $order;
    
    if($from == '') {
        $from = 0;
        $take = 6;
    }
    
    // Count the total number of clients
    $query = "SELECT * FROM clients
              INNER JOIN clientpage
              ON clients.id = clientpage.clientid
              WHERE domain = :domain ". $dateWhere ."
              GROUP by token";
    $clientsStmt = $db->prepare($query);
    $clientsStmt->bindValue(':domain', $domain, PDO::PARAM_STR);
    if($dateWhere != '') {
        $clientsStmt->bindValue(':startDate', $startDate, PDO::PARAM_STR);
        $clientsStmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);
    }
    $clientsStmt->execute();
    
    $cnt = $clientsStmt->rowCount();

    // Get all the clients for the current page, ordered by date
    $query = "SELECT * FROM clients
              INNER JOIN clientpage
              ON clients.id = clientpage.clientid
              WHERE domain = :domain ". $dateWhere ."
              GROUP by token
              ORDER BY clientpage.date $order LIMIT $from, $take";
    $clientsStmt = $db->prepare($query);
    $clientsStmt->bindValue(':domain', $domain, PDO::PARAM_STR);
    if($dateWhere != '') {
        $clientsStmt->bindValue(':startDate', $startDate, PDO::PARAM_STR);
        $clientsStmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);
    }
    $clientsStmt->execute();
    
    // Array to store the data to be returned
    $res = array();
    
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
        
        // Count number of total pages visited
        $query      = "SELECT COUNT(*) AS n FROM clientpage
                       WHERE clientid = :clientid";
        $stmt       = $db->prepare($query);
        $stmt->bindValue(':clientid', $row['clientid'], PDO::PARAM_INT);
        $stmt->execute();

        $nr         = $stmt->fetch(PDO::FETCH_ASSOC);
        $nr         = $nr['n'];
        
        // Get IP from token
        $ip = preg_split("/#/", $row['token']);
        $ip = $ip[0];

        // Get browser from token
        $br = preg_split('/@/',$row['token']);
        $br = $br[1];
        
        // Build the object with all info for current client
        $res[] = array(
                        'date' => $row['date'],
                        'ip' => $ip,
                        'resolution' => $row['resolution'],
                        'browser' => $br,
                        'page' => $row['page'],
                        'recordid' => $recordid,                        
                        'id' => $row['id'],
                        'nr' => $nr,
                        'token'=> $row['token'],
                );
    };

  echo json_encode(array('clients' => $res, 'count' => $cnt));
?>
