<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once('DBManagerModel.php');
class myFleet extends DBManagerModel{
   
    public function getList($params = array()){
        $entity = $this->entity();
        $start = $params["limit"] * $params["page"] - $params["limit"];
        $query = "SELECT `muestraId`,
                        `ftoma`,
                        `tipoMuestra`,
                        `escritica`,
                        m.vehiculoId,
                        if(m.tipoMuestraId = 1,'diferencial',if((m.tipoMuestraId = 2 or m.tipoMuestraId = 3),'motor','caja')) tipo
                    FROM ".$this->pluginPrefix."vehiculos v"
                . " JOIN laflota.wp_lf_vehiculos vf ON vf.placa = v.placa"
                . " JOIN laflota.wp_lf_muestras m ON m.vehiculoId = vf.vehiculoId"
                . " JOIN laflota.wp_lf_tipoMuestras t ON t.tipoMuestraId = m.tipoMuestraId"
                . " WHERE v.vehiculoId = ".$params["filter"];
        
        if(array_key_exists('where', $params)){
            if (is_array( $params["where"]->rules )){
                $countRules = count($params["where"]->rules);
                for($i = 0; $i < $countRules; $i++){
                    switch($params["where"]->rules[$i]->field ){
                        case "cliente": $params["where"]->rules[$i]->field = "clienteId"; break;
                    }
                }
            }
            
           $query .= " AND (". $this->buildWhere($params["where"]) .")";
        }
        //echo $query;
        return $this->getDataGrid($query, 0, 6 , $params["sidx"], $params["sord"]);
    }

   
    
    public function add(){}
    public function edit(){}
    public function del(){}

    public function detail($params = array()){
    }
    
    public function entity($CRUD = array()) {
        $data = array(
                    "tableName" => $this->pluginPrefix."myFleet"
                    ,"entityConfig" => $CRUD
                    ,"atributes" => array(
                        "muestraId" => array("label" => "id" ,"type" => "int", "hidden" => true, "PK" => 0, "required" => false, "readOnly" => true, "autoIncrement" => true, "toolTip" => array("type" => "cell", "cell" => 2) )
                        ,"ftoma" => array("label" => "fecha" ,"type" => "varchar", "required" => true)
                        ,"tipoMuestra" => array("label" => "tipoMuestra" ,"type" => "varchar", "required" => true)
                        ,"escritica" => array("label" => "escritica" ,"type" => "varchar", "required" => true)
                        ,"vehiculoId" => array("label" => "id" ,"type" => "int", "hidden" => true, "required" => false, "readOnly" => true)
                        ,"tipo" => array("label" => "escritica" ,"type" => "varchar", "required" => true, "hidden" => true)
                    )
                );  
        return $data;
    }
}
?>