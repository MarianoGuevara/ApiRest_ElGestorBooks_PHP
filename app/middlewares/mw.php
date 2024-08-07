<?php
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
class ConfirmarPerfil
{
    private $perfil;
    private $perfil2 = null;

    public function __construct($perfil, $perfil2=null)
    {
        $this->perfil = $perfil;
        $this->perfil2 = $perfil2;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $cookie = $request->getCookieParams();
        if(isset($cookie['JWT'])){
            $token = $cookie['JWT'];
            {
                try 
                {
                    AutentificadorJWT::VerificarToken($token); 
                    $datos = AutentificadorJWT::ObtenerData($token);
                    if($datos->rol == $this->perfil || $datos->rol == $this->perfil2){
                        return $handler->handle($request);
                    }
                    else{
                        throw new Exception('Usted no es un usuario autorizado');
                    }
                }
                catch (Exception $e) {
                    throw new Exception('Token invalido');
                }    
            }
        }
        return $handler->handle($request);
    }
}