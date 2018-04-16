<?php
    include '../login.php';
  
    $delay           = $_POST['delay'];
    $recordClicks    = $_POST['recordClick'];
    $recordMoves     = $_POST['recordMove'];
    $recordKey       = $_POST['recordKey'];
    $maxMoves        = $_POST['maxMove'];
    $static          = $_POST['static'];
    $serverPath      = $_POST['serverPath'];

    /*** Directly edit the tracker.js file ***/
    $filename = '../tracker.js';
    $contents = file_get_contents($filename);
    
    $pattern = '/recordClick: \S+,/';
    $newpat = 'recordClick: '.$recordClicks.',';
    $contents = preg_replace($pattern, $newpat, $contents);
    
    $pattern = '/delay: \d+,/';
    $newpat = 'delay: '.$delay.',';
    $contents = preg_replace($pattern, $newpat, $contents);
    
    $pattern = '/isStatic: \S+,/';
    $newpat = 'isStatic: '.$static.',';
    $contents = preg_replace($pattern, $newpat, $contents);
    
    $pattern = '/maxMoves: \d+,/';
    $newpat = 'maxMoves: '.$maxMoves .',';
    $contents = preg_replace($pattern, $newpat, $contents);
    
    $pattern = '/recordMove: \S+,/';
    $newpat = 'recordMove: '.$recordMoves .',';
    $contents = preg_replace($pattern, $newpat, $contents);
    
    $pattern = '/recordKeyboard: \S+,/';
    $newpat = 'recordKeyboard: '.$recordKey .',';
    $contents = preg_replace($pattern, $newpat, $contents);
    
    $pattern = '/serverPath: \S+,/';
    $newpat = 'serverPath: "'.$serverPath .'",';
    $contents = preg_replace($pattern, $newpat, $contents);
    
    file_put_contents($filename, $contents);
?>