<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_baseboca = "localhost";
$database_baseboca = "baseboca";
$username_baseboca = "baseboca";
$password_baseboca = "Makipuray@123";
$baseboca = mysql_pconnect($hostname_baseboca, $username_baseboca, $password_baseboca) or trigger_error(mysql_error(),E_USER_ERROR); 
?>