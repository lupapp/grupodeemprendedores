<?php include ("restringir.php"); ?>
<?php require_once('Connections/admin.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
	
	mysql_select_db($database_admin, $admin);
	$query_delfotos = "SELECT * FROM tbl_fotos WHERE album = '".$_GET['id']."'";
	$delfotos = mysql_query($query_delfotos, $admin) or die(mysql_error());
	$row_delfotos = mysql_fetch_assoc($delfotos);
	$totalRows_delfotos = mysql_num_rows($delfotos);
	
	do { if($row_delfotos['id']!=""){
	
		if (file_exists('../public/'.$row_delfotos['imagen'])) {
			unlink('../public/'.$row_delfotos['imagen']);
		}
		
		$deleteSQL = sprintf("DELETE FROM tbl_fotos WHERE id=%s",
                       GetSQLValueString($row_delfotos['id'], "int"));

		mysql_select_db($database_admin, $admin);
		$Result1 = mysql_query($deleteSQL, $admin) or die(mysql_error());
		
	} } while ($row_delfotos = mysql_fetch_assoc($delfotos));
	
	mysql_select_db($database_admin, $admin);
	$query_filedel = "SELECT * FROM tbl_album WHERE id = '".$_GET['id']."' ORDER BY id DESC";
	$filedel = mysql_query($query_filedel, $admin) or die(mysql_error());
	$row_filedel = mysql_fetch_assoc($filedel);
	$totalRows_filedel = mysql_num_rows($filedel);
	
	if($row_filedel['id']!=""){
		if (file_exists('../public/'.$row_filedel['imagen'])) {
				unlink('../public/'.$row_filedel['imagen']);
		}
	}	
	
  $deleteSQL = sprintf("DELETE FROM tbl_album WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_admin, $admin);
  $Result1 = mysql_query($deleteSQL, $admin) or die(mysql_error());

  $deleteGoTo = "album.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
</body>
</html>