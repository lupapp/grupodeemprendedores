<?php
    $ip       = @$_POST['ip'];
    
    $country = file_get_contents('http://api.ipinfodb.com/v3/ip-country/?key=e8dad84ca2cfa796cc01258a5fe5ff9b63765996d7ff53dafaaf652d7b367684&ip='.$ip);
    
    for($i = 1; $i <= 3; ++$i)
        $country = substr($country, strpos($country,';')+1);
    $country = substr($country,0,strpos($country,';'));
    
    echo $country;
?>