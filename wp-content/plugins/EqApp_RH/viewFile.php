<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once "pluginConfig.php";
require_once 'controllers/mainController.php';

$controlerId = (!empty($_GET["controller"]))?$_GET["controller"]:"basic";
$controller = new mainController($controlerId, false);

$controller->downLoadFile($_GET["id"]);*/
$file = "files/el destino de un hombre.pdf";
$mime = mime_content_type($file);
$size = filesize($file);
$fdata = file_get_contents($file);

header('Content-type: application/pdf');

// It will be called downloaded.pdf
header('Content-Disposition: inline; filename="test.pdf"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
// The PDF source is in original.pdf
readfile($file);

/*header("Content-Type: ".$mime);
header("Content-Length: ". $size);
header("Content-Disposition: attachment; filename=test.php");
echo $fdata;*/
?>