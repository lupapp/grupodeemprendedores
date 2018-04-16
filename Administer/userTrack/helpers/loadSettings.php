<?php

    /*** Directly edit the tracker.js file ***/
    $filename = '../tracker.js';
    $contents = file_get_contents($filename);
    
    $pattern = '/recordClick: \S+,/';
    preg_match($pattern, $contents,$recordClicks);
    $recordClicks = $recordClicks[0];
    $recordClicks = str_replace('recordClick: ','',$recordClicks);
    $recordClicks = str_replace(',','',$recordClicks);
    
    
    $pattern = '/delay: \d+,/';
    preg_match($pattern, $contents,$delay);
    $delay = $delay[0];
    $delay = str_replace('delay: ','',$delay);
    $delay = str_replace(',','',$delay);
    
    $pattern = '/isStatic: \S+,/';
    preg_match($pattern, $contents,$static);
    $static = $static[0];
    $static = str_replace('isStatic: ','',$static);
    $static = str_replace(',','',$static);
    
    
    $pattern = '/maxMoves: \d+,/';
    preg_match($pattern, $contents,$maxMoves);
    $maxMoves = $maxMoves[0];
    $maxMoves = str_replace('maxMoves: ','',$maxMoves);
    $maxMoves = str_replace(',','',$maxMoves);

    $pattern = '/recordMove: \S+,/';
    preg_match($pattern, $contents,$recordMoves);
    $recordMoves = $recordMoves[0];
    $recordMoves = str_replace('recordMove: ','',$recordMoves);
    $recordMoves= str_replace(',','',$recordMoves);
    
    $pattern = '/recordKeyboard: \S+,/';
    preg_match($pattern, $contents,$recordKey);
    $recordKey = $recordKey[0];
    $recordKey = str_replace('recordKeyboard: ','',$recordKey);
    $recordKey= str_replace(',','',$recordKey);
    
    $pattern = '/serverPath: "\S+",/';
    preg_match($pattern, $contents,$serverPath);
    if(count($serverPath) > 0 ){
        $serverPath = $serverPath[0];
        $serverPath = str_replace('serverPath: "','',$serverPath);
        $serverPath = str_replace('",','',$serverPath);
    }
    
    $arr = array(
             'delay' => $delay, 
             'recordClicks' => $recordClicks, 
             'recordMoves' => $recordMoves, 
             'static' => $static,
             'maxMoves' => $maxMoves, 
             'recordKey' => $recordKey,
             'serverPath' => $serverPath,
           );
                 
    echo json_encode($arr);    
?>
