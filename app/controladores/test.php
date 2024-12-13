<?php
// require_once '../bbdd/AccesoDatos.php';

class TestController {
	public function test1($request, $response, $args)
	{
		$objAccesoDatos = AccesoDatos::obtenerInstancia();
		$consulta = $objAccesoDatos->prepararConsulta("INSERT INTO test (a,b,c) VALUES (:a1, :a2, :a3)");
		$consulta->bindValue(':a1', 12, PDO::PARAM_INT);
		$consulta->bindValue(':a2', 3, PDO::PARAM_INT);
		$consulta->bindValue(':a3', 5, PDO::PARAM_INT);
		$consulta->execute();
		$resultado =  $objAccesoDatos->obtenerUltimoId();

		$payload = json_encode($resultado);
		$response->getBody()->write($payload);
		return $response->withHeader('Content-Type', 'application/json');
	}

}