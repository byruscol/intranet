<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once('DBManagerModel.php');
class hojaVida extends DBManagerModel{
   
    public function getList($params = array()){
        $entity = $this->entity();
        $start = $params["limit"] * $params["page"] - $params["limit"];
        $query = "SELECT `hojaVidaId`, 
                        `fecha`,
                        `ciudad`,
                        `documento`,
                        `tipoServicio`,
                        `cantidad`,
                        `total`,
                        `referencia`,
                        `descripcion`,
                        `valorneto`,
                        `iva`,
                        `descuento`
                    FROM ".$entity["tableName"]." i"
                . " WHERE vehiculoId = ".$params["filter"];
        
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
        return $this->getDataGrid($query, $start, $params["limit"] , $params["sidx"], $params["sord"]);
    }

   
    
    public function add(){}
    public function edit(){}
    public function del(){}

    public function detail($params = array()){
        $entity = $this->entity();
        $start = $params["limit"] * $params["page"] - $params["limit"];
        $query = "SELECT `placa` 
                        `fecha`,
                        `ciudad`,
                        `documento`,
                        `tipoServicio`,
                        `cantidad`,
                        `total`,
                        `referencia`,
                        `descripcion`,
                        `valorneto`,
                        `iva`,
                        `descuento`
                    FROM ".$entity["tableName"]." i"
                . " JOIN ".$this->pluginPrefix."vehiculos v ON v.vehiculoId = i.vehiculoId"
                . " WHERE i.vehiculoId = ".$params["filter"];
        
        $this->queryType = "row";
        return $this->getDataGrid($query);
    
    }
    
    public function entity($CRUD = array())
    {
        $data = array(
                    "tableName" => $this->pluginPrefix."hojaVida"
                    ,"entityConfig" => $CRUD
                    ,"atributes" => array(
                        "hojaVidaId" => array("label" => "id" ,"type" => "int",  "hidden" => true, "PK" => 0, "required" => false, "readOnly" => true, "autoIncrement" => true, "toolTip" => array("type" => "cell", "cell" => 2) ) 
                        ,"fecha" => array("label" => "fecha" ,"type" => "varchar", "required" => true)
                        ,"ciudad" => array("label" => "ciudadId" ,"type" => "varchar", "required" => true)
                        ,"documento" => array("label" => "documento" ,"type" => "varchar", "required" => true)
                        ,"tipoServicio" => array("label" => "tipoServicio" ,"type" => "varchar", "required" => true)
                        ,"cantidad" => array("label" => "Cantidad" ,"type" => "int", "required" => true)
                        ,"total" => array("label" => "total" ,"type" => "number", "required" => true)
                        ,"referencia" => array("label" => "referencia", "hidden" => true ,"type" => "varchar", "required" => true)
                        ,"descripcion" => array("label" => "description", "hidden" => true, "type" => "text", "edithidden" => true, "required" => true)
                        ,"valorneto" => array("label" => "valorNeto", "hidden" => true ,"type" => "number", "required" => true)
                        ,"iva" => array("label" => "iva" ,"type" => "number", "hidden" => true, "required" => true)
                        ,"descuento" => array("label" => "descuento", "hidden" => true ,"type" => "number", "required" => true)
                        ,"parentId" => array("type" => "int","required" => false, "hidden" => true,"readOnly" => true, "isTableCol" => false)  
                        ,"parentRelationShip" => array("type" => "varchar","required" => false, "hidden" => true,"readOnly" => true, "isTableCol" => false)
                    )
                );  
        return $data;
    }
}
?>