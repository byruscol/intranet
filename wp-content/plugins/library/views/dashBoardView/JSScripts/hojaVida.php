<?php
require_once "../../commonVehiculosGrid.php";
$params["sortname"] = "fecha";
$params["sortorder"] = "DESC";
$params["altclass"] = "stripingRows";
$params["CRUD"] = array("add" => false, "edit" => false, "del" => false, "view" => true, "viewDetails" => false, "excel" => true);

$view = new buildView("hojaVida", $params, "hojaVida");
?>
jQuery(document).ready(function($){
    $("#hojaVida").jqGrid().setGridWidth($("#hojaVida_dashboard_widget").width()-30);
});

