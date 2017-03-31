<?php

$error = "error";

mysql_connect('localhost', 'root', "",'info') or die ($error);
mysql_select_db("info");

if(isset($_GET['dow'])) {
     $path = $_GET['dow'];
    
   $res = mysql_query("SELECT * FROM pipes WHERE image='$path'");
    
   header('Content-Type: application/octet-stream');
   header('Content-Disposition: attachment; filename="'.($path).'"');
   header('Content-Length: ' . filesize($path));
   readfile($path);
   
}

?>