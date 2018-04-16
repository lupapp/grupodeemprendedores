<?php
    include '../login.php';
  
    $page = @$_POST['url'];
    if($page == '') die('Invalid page url.');
      
    $domain = @$_POST['domain'];    
    if($domain == '') die('Invalid domain.');
    

    // Get distinct resolutions from visits at the $page on $domain
    $query = "SELECT DISTINCT resolution FROM clientpage 
              WHERE page = :page AND clientid IN (
                    SELECT id FROM clients
                    WHERE domain = :domain
              )";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":page", $page, PDO::PARAM_STR);
    $stmt->bindValue(":domain", $domain, PDO::PARAM_STR);
    $stmt->execute();
                    
    $res = $stmt->fetchAll(PDO::FETCH_NUM);

    echo json_encode($res);
?>
