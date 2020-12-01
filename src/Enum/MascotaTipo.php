<?php

namespace Enum;

//use MyCLabs\Enum\Enum;



class MascotaTipo// extends Enum
{
    // Socio.
    const PERRO = 1;
    const GATO = 2;
    const HURON = 2;

    public static function IsValid($tipo)
    {
        switch ($tipo) {
            case "PERRO":
                return true;
            case "GATO":
                return true;
            case "HURON":
                return true;
            default:
                return false;
        }
    }

    public static function GetDescription($tipo)
    {
        switch ($tipo) {
            case MascotaTipo::PERRO:
                return "PERRO";
            case MascotaTipo::GATO:
                return "GATO";
            case MascotaTipo::HURON:
                return "HURON";
            }
    }

    public static function GetVal($tipo)
    {
        switch ($tipo) {
            case "PERRO":
                return MascotaTipo::PERRO;
            case "GATO":
                return MascotaTipo::GATO;
            case "HURON":
                return MascotaTipo::HURON;
            default:
                return false;
        }
    }
}
