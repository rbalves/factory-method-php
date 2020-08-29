<?php

require_once "BancoA.php";
require_once "BancoB.php";

class BancoFactory {

	public static function obterInstancia($codigoBanco) {
		
		switch ($codigoBanco) {
			case 'A':
				return new BancoA();
			
			case 'B':
				return new BancoB();

			default:
				throw new Exception("Código de banco '${codigoBanco}' inexistente");
		}

	}

}

?>