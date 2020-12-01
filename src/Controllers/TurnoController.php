<?php

namespace Controllers;
use Middlewares\Auth;
use Components\GenericResponse;

use Enum\UserRole;
use Enum\mascotaTipo;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Models\Mascota;
use Models\Turno;

class TurnoController{
    /*public function getAll(Request $request, Response $response, $args){
        try{
            $rta = Mesa::get();
            $response->getBody()->write(GenericResponse::obtain(true, "Listado", $rta));

        } catch (\Exception $e) {
            $response->getBody()->write(GenericResponse::obtain(false, $e->getMessage(), null));
            $response->withStatus(500);
        }

        return $response;
    }
    public function getOne(Request $request, Response $response, $args){
        try{
            $rta = Mesa::find($args['id']);
            if(empty($rta)){
                throw new \Exception("La mesa no existe");
            }
            $response->getBody()->write(GenericResponse::obtain(true, "Item solicitado", $rta));
        } catch (\Exception $e) {
            $response->getBody()->write(GenericResponse::obtain(false, $e->getMessage(), null));
            $response->withStatus(500);
        }

        return $response;
    }*/

    public function addOne(Request $request, Response $response, $args){
        try{
            $turno = new Turno;

            $turno->idTipo = strtoupper($request->getParsedBody()['tipo']) ?? '';
            $turno->fecha = $request->getParsedBody()['fecha'] ?? '';


            if(!Mascota::where('id', '=', $turno->idTipo)->exists()){
                throw new \Exception("La mascota no esta registrada");
            }
            $date = strtotime($turno->fecha); 
            $fecha = new \DateTime();
            $fecha->setTimestamp($date);
            $turno->fecha = $fecha;
            $rta = $turno->save();
            $response->getBody()->write(GenericResponse::obtain(true, $rta, null));

        } catch (\Exception $e) {
            $response->getBody()->write(GenericResponse::obtain(false, $e->getMessage(), $turno));
            $response->withStatus(500);
        }
    
        return $response;

    }

    //paso por x-www-form-urlencoded
    /*public function updateOne(Request $request, Response $response, $args){
        try{
            $mesa = Mesa::find($args['id']);

            $mesa->codigo = trim($request->getParsedBody()['codigo']) ?? $mesa->codigo;
            if(strlen($mesa->codigo)!=5){
                throw new \Exception("El codigo debe tener 5 caracteres");
            }

            $rta = $mesa->save();
            $response->getBody()->write(GenericResponse::obtain(true, "Modificado exitosamente", $rta));


        } catch (\Exception $e) {
            $response->getBody()->write(GenericResponse::obtain(false, $e->getMessage(), $mesa));
            $response->withStatus(500);
        }
        return $response;
    }
    public function deleteOne(Request $request, Response $response, $args){
        try{
            $mesa = Mesa::find($args['id']);
            $rta = false;
            if($mesa){
                $rta = $mesa->delete();
            }else{
                throw new \Exception("La mesa no se encontro");
            }

        } catch (\Exception $e) {
            $response->getBody()->write(GenericResponse::obtain(false, $e->getMessage(), null));
            $response->withStatus(500);
        }
        return $response;
    }

*/
}







