<?php
require_once('metadata.php');

class instructor{
    public $id;
    public $usuario;
    public $nombre;
    public $clave;
    public function __construct($pId,$pUsuario,$pNombre,$pClave)
    {
        $this->id = $pId;
        $this->usuario = $pUsuario;
        $this->nombre = $pNombre;
        $this->clave= $pClave;
    }
}
class local {
    public $id;
    public $nombre;
    public $distrito;
    public function __construct($pId,$pNombre,$pDistrito)
    {
        $this->id = $pId;
        $this->nombre = $pNombre;
        $this->distrito = $pDistrito;
    }
}

function getLocales(){
    $row_rs = '';
    require_once('Connections/baseboca.php');
    $cn= new MetaData($hostname_baseboca,$database_baseboca,$username_baseboca,$password_baseboca);
    $row_rs= $cn->getLocales();
    return $row_rs;
}
function getInstructor($usuario,$clave){
    $row_rs = '';
    require_once('Connections/baseboca.php');
    $cn= new MetaData($hostname_baseboca,$database_baseboca,$username_baseboca,$password_baseboca);
    $res= $cn->validAccess($usuario,$clave);
    return $res;
}
function getHorarios($idInstructor,$idLocal){
    $row_rs = '';
    require('Connections/baseboca.php');
    $cn= new MetaData($hostname_baseboca,$database_baseboca,$username_baseboca,$password_baseboca);
    $row_rs= $cn->getHorarios($idInstructor,$idLocal);
    return $row_rs;
}
function getAlumnado($idInstructor,$idLocal){
    $row_rs = '';
    require('Connections/baseboca.php');
    $cn= new MetaData($hostname_baseboca,$database_baseboca,$username_baseboca,$password_baseboca);
    $row_rs= $cn->getAlumnado($idInstructor,$idLocal);
    return $row_rs;
}
function getValores($idInstructor,$idLocal){
    $row_rs = '';
    require('Connections/baseboca.php');
    $cn= new MetaData($hostname_baseboca,$database_baseboca,$username_baseboca,$password_baseboca);
    $row_rs= $cn->getValores($idInstructor,$idLocal);
    return $row_rs;
}
function getTablas($idInstructor,$idLocal){
    error_log('getTablas');
    $res = new stdClass();
    $res->Horarios = getHorarios($idInstructor,$idLocal);
    $res->Alumnos = getAlumnado($idInstructor,$idLocal);
    $res->Valores = getValores($idInstructor,$idLocal);
    return $res;
}
?>
