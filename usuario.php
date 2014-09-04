<?php
require("datamodel.php");

/**
 * Created by PhpStorm.
 * User: victormanuel
 * Date: 03/06/14
 * Time: 04:04 AM
 */
class usuario{
    function __construct(){
    header('Access-Control-Allow-Origin: *'); //Here for all /say
    }
    function get(){
        return "supermio";
    }
    function getLocales(){
        return getLocales();
    }
    function getInstructor($usuario,$clave){
        return getInstructor($usuario,$clave);
    }
    function getHorarios($idInstructor,$idLocal){
        return getHorarios($idInstructor,$idLocal);
    }
    function getAlumnado($idInstructor,$idLocal){
        return getAlumnado($idInstructor,$idLocal);
    }
    function getTablas($idInstructor,$idLocal){
        return getTablas($idInstructor,$idLocal);
    }
}
