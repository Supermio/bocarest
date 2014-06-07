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
    require_once('Connections/baseboca.php');
    $query = "select now()";
    $cn= new MetaData($hostname_baseboca,$database_baseboca,$username_baseboca,$password_baseboca);
    $row_rs= $cn->getLocales();
    return $row_rs;
}
function getInstructor($usuario,$clave){
    require_once('Connections/baseboca.php');
    $query = "select now()";
    $cn= new MetaData($hostname_baseboca,$database_baseboca,$username_baseboca,$password_baseboca);
    $row_rs= $cn->validAccess($usuario,$clave);
    return $row_rs;
}

class horario {
    public $id;
}
class table {
	public $orden;
	public $regs=array();
}

class tablein {
	public $nombre;
	public $orden;
	public $regs = array();
}

class App {
 public $appID;
 public $appNombre;
 public $appCompania;
 public $appVersion;
 public function __construct($pappID,$pappNombre,$pappCompania,$pappVersion)
    {
        $this->appID = $pappID;
        $this->appNombre = $pappNombre;
        $this->appCompania = $pappCompania;
        $this->appVersion = $pappVersion;
    }
};

class Tabla {
 public $tablaId;
 public $tablaNombre;
 public $tablaNotes;
 public $appID;
 public $lastSync;
 public function __construct($ptablaId,$ptablaNombre,$ptablaNotes,$pappID,$plastSync)
    {
        $this->tablaId= $ptablaId;
        $this->tablaNombre = $ptablaNombre;
        $this->tablaNotes = $ptablaNotes;
        $this->appID = $pappID;
        $this->lastSync = $plastSync;
    }
};

class Regla {
 public $reglaID;
 public $tablaID;
 public $reglaSQL;
 public $eventoID;
 public $reglaNotas;
};

class Evento {
 public $eventoID;
 public $eventoNombre;
};

class Grupo {
 public $grupoID;
 public $appID;
 public $grupoNombre;
};
class Parametro {
 public $paramID;
 public $paramNombre;
 public $paramValue;
 public $appID;
 public $contentID;
};

class Contenido {
 public $contentID;
 public $contentNombre;
};

class Estado {
 public $estadoID;
 public $estadoNombre;
};

class Proceso {
 public $procesoID;
 public $estadoID;
 public $tipoprocesoID;
 public $appID;
 public $procesoChunk;
 public $procesoChunkTotal;
};

class TipoProceso {
 public $tipoprocesoID;
 public $tipoprocesoNombre;
 public $tipoprocesoNotas;
};

class Log {
 public $logId;
 public $logtimestamp;
 public $procesoID;
 public $logValor;
 public $logResult;
};

class gGlobal {
 public $globalID;
 public $globalNombre;
 public $globalValue;
 public $globalNotes;
 public $contentID;
};

class Dispositivo {
 public $dispID;
 public $dispNombre;
 public $dispSerie;
 public $dispNotas;
};

?>
