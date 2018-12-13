<?php
/*
@author:Miguel Anagel Porras Najera
El siguiente script es la conexion a la base de datos de CAAAREM3
*/

$dbphst = '192.0.0.1:3310';
$dbppto = '3310';
$dbpusr = 'webuser';
$dbpcve = 'w3bu53r';
$dbpnom = 'CAAAREM3';

$dbpcon = new mysqli($dbphst, $dbpusr, $dbpcve, $dbpnom);
if ($dbpcon->connect_error)
{
    die("¡CONEXION FALLIDA! : " . $dbpcon->connect_error);
}
$dbpcon->set_charset("utf8");


?>
