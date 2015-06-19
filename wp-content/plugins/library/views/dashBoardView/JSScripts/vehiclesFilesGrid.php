<?php
require_once "../../commonFilesGrid.php";
$params["postData"]["method"] = "getVehiculosFiles";
$params["sortname"] = "created";
$params["gridId"] ="vehiclesFiles";
$params["pagerId"] ="vehiclesFiles";
$params["altclass"] = "stripingRows";
$params["CRUD"] = array("add" => false, "search"=>true, "edit" => false, "del" => false, "view" => false, "detail" => false);
$view = new buildView("files", $params, "files");
?>