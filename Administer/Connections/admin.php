<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
include('config.php');
$hostname_admin = DB_HOST;
$database_admin = DB_NAME;
$username_admin =DB_USER;
$password_admin = DB_PASS;
$admin = mysql_connect($hostname_admin, $username_admin, $password_admin) or trigger_error(mysql_error(),E_USER_ERROR);
?>