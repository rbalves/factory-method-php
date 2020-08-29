<?php

class Utils{

	public static function formatarData($data, $formato, $separador) {

		switch ($formato) {
			case 'DDMMAAAA':
				return substr($data, 0, 2) . $separador . substr($data, 2, 2) . $separador . substr($data, 4);

			case 'AAAAMMDD':
				return substr($data, 0, 4) . $separador . substr($data, 4, 2) . $separador . substr($data, 6);

			case 'MMAAAA':
				return substr($data, 0, 2) . $separador . substr($data, 2);

			default:
				throw new Exception("Formato de data '${formato}' não encontrado");
		}
	}

	public static function formatarHora($hora, $formato, $separador) {

		switch ($formato) {
			case 'HHMMSS':
				return substr($hora, 0, 2) . $separador . substr($hora, 2, 2) . $separador . substr($hora, 4);

			case 'HHMM':
				return substr($hora, 0, 2) . $separador . substr($hora, 2);

			default:
				throw new Exception("Formato de hora não encontrado");
		}
	}

	public static function formatarValorMonetario($valor, $tamanho) {

		$reais = intval(substr($valor, 0, $tamanho - 2));
		$centavos = substr($valor, -2);

		return $reais . "." . $centavos;
	}

}

?>