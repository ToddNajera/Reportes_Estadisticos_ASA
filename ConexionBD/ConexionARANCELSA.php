<?php
/*
@author:Miguel Anagel Porras Najera
El siguiente script es la conexion a la base de datos de ARANCELSA
*/

$dbahst = '192.0.0.4';
$dbausr = 'IntranetARA';
$dbacve = 'Intranet18ARA';
$dbanom = 'arancelsa';

/*
$dbahst = 'localhost';
$dbausr = 'IntranetARA';
$dbacve = 'Intranet18ARA';
$dbanom = '04arancel';
*/

$dbARA = new mysqli($dbahst, $dbausr, $dbacve, $dbanom);
if ($dbARA->connect_error)
{
    die("¡CONEXION FALLIDA! : " . $dbARA->connect_error);
}
$dbARA->set_charset("utf8");
?>
