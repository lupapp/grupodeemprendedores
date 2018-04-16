<?php include("restringir.php"); ?>
<?php include("acentos.php"); ?>
<?php include("funciones.php"); ?>
<?php
mysql_select_db($database_admin, $admin);
$query_ver = "SELECT * FROM tbl_agenda ORDER BY start ASC";
$ver = mysql_query($query_ver, $admin) or die(mysql_error());
$row_ver = mysql_fetch_assoc($ver);
$totalRows_ver = mysql_num_rows($ver);
?>
[
<?php $contador=0; do{ $contador++; ?>
  {
    "title" : "<?php echo $row_ver['titulo']; ?>",
    "id" : "<?php echo $row_ver['id']; ?>",
    "start" : "<?php echo $row_ver['start']; ?>",
    "end" : "<?php echo $row_ver['end']; ?>",
    "color" : "<?php echo $row_ver['color']; ?>",
    "allDay" : "<?php echo $row_ver['allday']; ?>",
    "url" : "agenda_editar.php?id=<?php echo $row_ver['id']; ?>",
    "textColor" : "#FFFFFF"
  }
<?php if($contador!=$totalRows_ver){ echo ","; } } while ($row_ver = mysql_fetch_assoc($ver)); ?>	 
]