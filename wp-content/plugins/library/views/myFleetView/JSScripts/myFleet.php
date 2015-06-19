<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once "../../commonVehiculosGrid.php";
header('Content-type: text/javascript');
$params["sortname"] = "ftoma";
$params["sortorder"] = "DESC";
$params["altclass"] = "stripingRows";
$params["actions"] = array(
                            array("type" => "onSelectRow"
                                      ,"function" => 'function(id) {
                                                        if(id != null) {
                                                           var rowData = jQuery("#myFleet").getRowData(id);
                                                           window.open("http://localhost/laflota/wp-content/plugins/laflota/downloadReport.php?controller=miFlota&type="+rowData["tipo"]+"&id="+rowData["vehiculoId"], "_blank")
                                                        }
                                                    }'
                                    )
                        );
$params["CRUD"] = array("add" => false, "edit" => false, "del" => false, "view" => false, "excel" => true);
$view = new buildView("myFleet", $params, "myFleet");
?>
jQuery(document).ready(function($){
    $("#myFleet").jqGrid().hideCol("clienteId");
    $("#myFleet").jqGrid().setGridWidth($("#laflota_dashboard_widget").width()-30);
});

