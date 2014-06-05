<?php
require_once('dataConn.php');

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

class TablaInternal {
    private $appID;
    private $tablaID;
    protected $data;
    function __construct(MetaData $data,$appID,$tablaID) {
        $this->data = $data;
        $this->appID = $appID;
        $this->tablaID = $tablaID;
    }
    private function getOrden(){
        $query = sprintf("SELECT orden FROM Tabla WHERE appID=%s and tablaID=%s",
            GetSQLValueString($this->appID,"int"),
            GetSQLValueString($this->tablaID,"int"));
        $data=$this->data;
        return $data->getValue($query);;
    }
    private function getRegla($eventoID){
        $query=sprintf("SELECT reglaSQL FROM ReglaServidor WHERE appID=%d and tablaID=%d and eventoID=%s",
            GetSQLValueString($this->appID,"int"),
            GetSQLValueString($this->tablaID,"int"),
            GetSQLValueString($eventoID,"text"));
        $data=$this->data;
        return $data->getValue($query);
    }
    private function getUserID(){
        $eventoID='5';
        return $this->getRegla($eventoID);
    }
    private function getNombre(){
        $query = sprintf("select tablaNombre from Tabla where appID=%s and tablaID=%s",
            GetSQLValueString($this->appID,"int"),
            GetSQLValueString($this->tablaID,"int"));
        $data = $this->data;
        return $data->getValue($query);
    }
    private function getFormat(){
        $query = sprintf("SELECT format FROM Tabla WHERE  appID=%s and tablaID=%s",
            GetSQLValueString($this->appID,"int"),
            GetSQLValueString($this->tablaID,"int"));
        $data=$this->data;
        return $data->getValue($query);;
    }
    private function getLastSync($userID){
        $tabla= $this->getTabla();
        $userField = $this->getUserID();
        $query_rs=sprintf("select max(last_modified) from %d where %s = %s",
            GetSQLValueString($tabla,"text"),
            $userField,
            GetSQLValueString($userID,"text"));
        $data=$this->data;
        return $data->getValue($query_rs);
    }
    public function getChanges($userID,$fecha){
        $tablares="";
        $query = $this->getRegla(2);
        $format = $this->getFormat();
        $cond = sprintf(" where %s = %s and last_modified > %s",
            $this->getUserID(),
            GetSQLValueString($userID,"text"),
            GetSQLValueString($fecha,"text"));
        $query_rs=$query . $cond;
        $data = $this->data;
        $res = $data->getRSformat($query_rs,$format);
        $tablares = new table();
        $tablares->orden = $this->getOrden();
        $tablares->regs =$res;

        return $tablares;
    }
    public function getSQL($userID,$eventoID,$fecha) {
        $query_rs='error';
        $query = $this->getRegla($eventoID);
        $cond = sprintf(" where %s = %s and last_modified > %s",
            $this->getUserID(),
            GetSQLValueString($userID,"text"),
            GetSQLValueString($fecha,"text"));
        $query_rs = $query . $cond;
        $format = $this->getFormat();
        return $query_rs;
    }
    public function insertChanges($userID,$porden,$datos){
        $userField = $this->getUserID();
        $tabla = $this->getNombre();
        $orden = $porden;
        $plantilla= $this->getRegla(6);
        $formato = $this->getFormat();
        $fmtArray = split(',',$formato);
        $datArray = split(',',$datos);
        $datosFormato ='';
        for ($i=0; $i< count($fmtArray); $i++)
        {
            $temp = base64_decode($datArray[$i]);
            error_log('El valor de formato para:'.$temp.' es : '.$fmtArray[$i]);
            if ($fmtArray[$i]==0) $datosFormato = $datosFormato.$temp.",";
            else $datosFormato=$datosFormato."'".$temp."',";
        }
        $datosFormato= substr($datosFormato,0,-1);
        $query = sprintf($plantilla,
            $userField,
            $orden,
            $userID,
            $datosFormato);
        error_log('el comando insert es:'.$query);
        $data = $this->data;
        $res = true;
        if ($query == '') $res = true;
        else $res = $data->getCommand($query);
        return $res;
    }
}

class MetaData extends dataConn {

    public function validAccess($usuario,$clave) {
        $res=0;
        $query = sprintf("select idOperador,usuario, clave from operador where  usuario=%s and clave=%s",
            GetSQLValueString($usuario,"text"),
            GetSQLValueString($clave,"text"));
        error_log('valid access query:'.$query);
        $row_rs = $this->getValue($query);
        error_log('valid access: ya pase el query');
        if (is_null($row_rs)) {
            $res = 0;
            error_log('valid access no hay regs');
        }
        else {
            $res= $row_rs[0];
            error_log('valid access si hay regs');
        }
        error_log('valid access: ya pase la validacion:'.$res);
        return $res;
    }

    public function getApps($deviceID){
        $query = sprintf("SELECT a.appID, a.appNombre, a.appCompania, a.appVersion FROM App a,DispApp b WHERE a.appID = b.appID AND b.dispID = %s",
            GetSQLValueString($deviceID,"int"));
        $row_rs = $this->getRS($query);
        return $row_rs;
    }
    public function getMeta($deviceID,$appID){
        error_log('antes del valid access');
        $companiaID = $this->validAccess($deviceID,$appID);
        error_log('despues del valid access');
        $res = '0';
        if ($companiaID>0) {
            $res = new stdClass();

            $app = new table();
            $tablaID=
            $app->orden="appID,appNombre,appCompania,appVersion";
            $format="0,1,1,1";
            $query = sprintf("select %s from App where idCompania=%d and appID=%d",
                $app->orden,
                GetSQLValueString($companiaID,"int"),
                GetSQLValueString($appID,"int"));
            $app->regs = $this->getRSformat($query,$format);
            $res->app = $app;

            $tabla = new table();
            $tabla->orden="tablaID,tablaNombre,tablaNotes,appID,lastSync";
            $format="0,1,1,0,1";
            $query = sprintf("select %s from Tabla where appID=%d",
                $tabla->orden,GetSQLValueString($appID,"int"));
            $tabla->regs = $this->getRSformat($query,$format);
            $res->tabla =$tabla;

            $evento = new table();
            $evento->orden="eventoID,eventoNombre";
            $format="0,1";
            $query = sprintf("select %s from Evento",
                $evento->orden);
            $evento->regs = $this->getRSformat($query,$format);
            $res->evento =$evento;

            $grupo = new table();
            $grupo->orden="grupoID,appID,grupoNombre";
            $format="0,0,1";
            $query = sprintf("select %s from Grupo where appID=%d",
                $grupo->orden,
                GetSQLValueString($appID,"int"));
            $grupo->regs = $this->getRSformat($query,$format);
            $res->grupo =$grupo;

            $usuario = new table();
            $usuario->orden="usuarioID,grupoID,usuarioNombre,usuarioClave,usuarioTitulo";
            $format="0,0,1,1,1";
            $query = sprintf("select %s from Usuario where appID=%d",
                $usuario->orden,
                GetSQLValueString($appID,"int"));
            $usuario->regs = $this->getRSformat($query,$format);
            $res->usuario =$usuario;

            $regla = new table();
            $regla->orden="reglaID,tablaID,reglaSQL,eventoID,reglaNotas";
            $format="0,0,1,0,1";
            $query = sprintf("select %s from Regla where appID=%d",
                $regla->orden,GetSQLValueString($appID,"int"));
            $regla->regs = $this->getRSformat($query,$format);
            $res->regla =$regla;

            $parametro = new table();
            $parametro->orden="paramID,paramNombre,paramValue,appID,contentID";
            $format="0,1,1,0,0";
            $query = sprintf("select %s from Parametro where appID=%d",
                $parametro->orden,GetSQLValueString($appID,"int"));
            $parametro->regs = $this->getRSformat($query,$format);
            $res->parametro =$parametro;

            $contenido = new table();
            $contenido->orden="contentID,contentNombre";
            $format="0,1";
            $query = sprintf("select %s from Contenido",
                $contenido->orden);
            $contenido->regs = $this->getRSformat($query,$format);
            $res->contenido =$contenido;

            $estado = new table();
            $estado->orden="estadoID,estadoNombre";
            $format="0,1";
            $query = sprintf("select %s from Estado",
                $estado->orden);
            $estado->regs = $this->getRSformat($query,$format);
            $res->estado=$estado;

            $tipoproceso = new table();
            $tipoproceso->orden="tipoprocesoID,tipoprocesoNombre,tipoprocesoNotas";
            $proceso="0,1,1";
            $query = sprintf("select %s from TipoProceso",
                $tipoproceso->orden);
            $tipoproceso->regs = $this->getRSformat($query,$format);
            $res->tipoproceso =$tipoproceso;

            $proceso = new table();
            $proceso->orden="procesoID,estadoID,tipoprocesoID,appID,procesoChunk,procesoChunkTotal";
            $format="0,0,0,0,0,0";
            $query = sprintf("select %s from Proceso where appID=%d",
                $proceso->orden,
                GetSQLValueString($appID,"int"));
            $proceso->regs = $this->getRSformat($query,$format);
            $res->proceso =$proceso;

            $log = new table();
            $log->orden="logID,logtimestamp,procesoID,logValor,logResult";
            $format="0,1,0,1,1";
            $query = sprintf("select %s from Log where appID=%d",
                $log->orden,
                GetSQLValueString($appID,"int"));
            $log->regs = $this->getRSformat($query,$format);
            $res->log =$log;

            $global = new table();
            $global->orden="globalID,globalNombre,globalValue,globalNotes,contentID";
            $format="0,1,1,1,0";
            $query = sprintf("select %s from Global",
                $global->orden);
            $global->regs = $this->getRSformat($query,$format);
            $res->global =$global;

            $dispositivo = new table();
            $dispositivo->orden="dispID,dispNombre,dispSerie,dispNotas";
            $format="0,1,1,1";
            $query = sprintf("select %s from Dispositivo ",
                $dispositivo->orden);
            $dispositivo->regs = $this->getRSformat($query,$format);
            $res->dispositivo =$dispositivo;

        }
        else $res = 'sin acceso';
        return $res;
    }

    function getChanges($userID,$deviceID,$appID,$tablaID,$fecha){
        $query_rs="2";
        $companiaID = $this->validAccess($deviceID,$appID);
        $res="";
        $tabla = new TablaInternal($this,$appID,$tablaID);
        $tablares="";
        if ($companiaID>0) {
            $tablares = $tabla->getChanges($userID,$fecha);
        }
        else {
            $tablares='Sin Acceso';
        }
        return $tablares;
    }

    function postChanges($deviceID,$userID,$appID,$tablaID,$regs) {
        $companiaID = $this->validAccess($deviceID,$appID);
        $res="Ok";
        if ($companiaID>0) {
            $datos = json_decode($regs,true);
            $orden = $datos['orden'];
            $tabla = new TablaInternal($this,$appID,$tablaID);
            foreach($datos['regs'] as $mydata) {
                $res = $tabla->insertChanges($userID,$orden,$mydata);
            }
        }
        else {
            $res='Sin Acceso';
        }
        return $res;
    }
    function testSQL($deviceID,$userID,$appID,$tablaID,$eventoID,$fecha){
        $tabla = new TablaInternal($this,$appID,$tablaID);
        return $tabla->getSQL($userID,$eventoID,$fecha);
    }
}
?>