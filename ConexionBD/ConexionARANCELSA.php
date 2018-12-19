<?php
/*
@author:Miguel Anagel Porras Najera
El siguiente script es la conexion a la base de datos de ARANCELSA
*/

$dbahst = '192.0.0.4';
$dbsusr = 'IntranetARA';
$dbacve = 'Intranet18ARA';
$dbanom = 'arancelsa';

$dbacon = new mysqli($dbahst, $dbausr, $dbacve, $dbanom);
if ($dbscon->connect_error)
{
    die("¡CONEXION FALLIDA! : " . $dbscon->connect_error);
}
$dbscon->set_charset("utf8");
?>
