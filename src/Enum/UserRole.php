<?php

namespace Enum;

//use MyCLabs\Enum\Enum;



class UserRole// extends Enum
{
    // Socio.
    const ADMIN = 1;
    const CLIENTE = 2;

    public static function IsValidArea($area)
    {
        switch ($area) {
            case "ADMIN":
                return true;
            case "CLIENTE":
                return true;
            default:
                return false;
        }
    }

    public static function GetDescription($role)
    {
        switch ($role) {
            case UserRole::ADMIN:
                return "ADMIN";
            case UserRole::CLIENTE:
                return "CLIENTE";
        }
    }

    public static function GetVal($role)
    {
        switch ($role) {
            case "ADMIN":
                return UserRole::ADMIN;
            case "CLIENTE":
                return UserRole::CLIENTE;
            default:
                return false;
        }
    }
}
