<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once('DBManagerModel.php');
class vehiculos extends DBManagerModel{
   
    public function getList($params = array()){
        $entity = $this->entity();
        $start = $params["limit"] * $params["page"] - $params["limit"];
        $query = "SELECT `vehiculoId`,
                        `clienteId`,
                        `placa`,
                        `tipoMotorId`,
                        `marcaMotorId`,
                        `marcaVehiculoId`,
                        `des_modelo`,
                        `serie`
                    FROM ".$entity["tableName"]." i";
        
        if(array_key_exists('where', $params)){
            if (is_array( $params["where"]->rules )){
                $countRules = count($params["where"]->rules);
                for($i = 0; $i < $countRules; $i++){
                    switch($params["where"]->rules[$i]->field ){
                        case "cliente": $params["where"]->rules[$i]->field = "clienteId"; break;
                    }
                }
            }
            
           $query .= " WHERE (". $this->buildWhere($params["where"]) .")";
        }
        
        return $this->getDataGrid($query, $start, $params["limit"] , $params["sidx"], $params["sord"]);
    }

    public function getMyVehicles($params = array()){
        $entity = $this->entity();
        $start = $params["limit"] * $params["page"] - $params["limit"];
        
        if(current_user_can( "publish_posts" ))
            $where = " WHERE  u.`clienteId` = " . $params["filter"];
        else{
            $where = " WHERE  u.`ID` = " . $this->currentUser->ID;
        }
        
        $query = "SELECT `vehiculoId`,
                        v.`clienteId` cliente,
                        `placa`,
                        `tipoMotorId`,
                        `marcaMotorId`,
                        `marcaVehiculoId`,
                        `des_modelo`
                    FROM ".$this->pluginPrefix."clientesUsuarios u "
                .   "   JOIN ".$this->pluginPrefix."vehiculos v ON v.clienteId = u.clienteId" 
                .   $where;
        
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
        
        return $this->getDataGrid($query, $start, $params["limit"] , $params["sidx"], $params["sord"]);
    }
    
    public function getVehiculosCliente($params = array()){
        $entity = $this->entity();
        $start = $params["limit"] * $params["page"] - $params["limit"];
        $query = "SELECT `vehiculoId`,
                        `clienteId` cliente,
                        `placa`,
                        `tipoMotorId`,
                        `marcaMotorId`,
                        `marcaVehiculoId`,
                        `des_modelo`
                    FROM ".$entity["tableName"]." i "
                . "WHERE  `clienteId` = " . $params["filter"];
        
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
        
        return $this->getDataGrid($query, $start, $params["limit"] , $params["sidx"], $params["sord"]);
    }
    
    public function add(){
        $_POST["placa"] = strtoupper((ereg_replace("[^A-Za-z0-9]", "", $_POST["placa"])));
        $this->addRecord($this->entity(), $_POST, array("date_entered" => date("Y-m-d H:i:s"), "created_by" => $this->currentUser->ID));
    }
    public function edit(){
        $this->updateRecord($this->entity(), $_POST, array("vehiculoId" => $_POST["vehiculoId"]), null);
    }
    public function del(){
        $this->eliminateRecord($this->entity(), array("vehiculoId" => $_POST["id"]));
    }

    public function detail($params = array()){}
    
    public function entity($CRUD = array())
    {
        $data = array(
                    "tableName" => $this->pluginPrefix."vehiculos"
                    ,"entityConfig" => $CRUD
                    ,"atributes" => array(
                        "vehiculoId" => array("label" => "id" ,"type" => "int", "PK" => 0, "required" => false, "readOnly" => true, "autoIncrement" => true, "toolTip" => array("type" => "cell", "cell" => 2) )
                        ,"clienteId" => array("label" => "cliente" ,"type" => "int", "required" => true, "references" => array("table" => $this->pluginPrefix."clientes", "id" => "clienteId", "text" => "nombre"))
                        ,"placa" => array("label" => "placa" ,"type" => "varchar", "required" => true)
                        ,"tipoMotorId" => array("label" => "tipoMotorId" ,"type" => "int", "required" => true, "references" => array("table" => $this->pluginPrefix."tipoMotor", "id" => "tipoMotorId", "text" => "tipoMotor"))
                        ,"marcaMotorId" => array("label" => "marcaMotor" ,"type" => "int", "required" => true, "references" => array("table" => $this->pluginPrefix."marcaMotores", "id" => "marcaMotorId", "text" => "marcaMotor"))
                        ,"marcaVehiculoId" => array("label" => "marcaVehiculo" ,"type" => "int", "required" => true, "references" => array("table" => $this->pluginPrefix."marcaVehiculos", "id" => "marcaVehiculoId", "text" => "marcaVehiculo"))
                        ,"des_modelo" => array("label" => "modelo" ,"type" => "varchar", "required" => true)
                        ,"serie" => array("label" => "serie" ,"type" => "varchar", "required" => false)
                        ,"parentId" => array("type" => "int","required" => false, "hidden" => true,"readOnly" => true, "isTableCol" => false)  
                        ,"parentRelationShip" => array("type" => "varchar","required" => false, "hidden" => true,"readOnly" => true, "isTableCol" => false)
                    )
                );  
        return $data;
    }
}
?>