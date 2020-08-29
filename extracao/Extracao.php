<?php

require_once "Utils.php";

class Extracao {

	public static function validarArquivo($arquivo) {
		if (!file_exists($arquivo)) {
            throw new Exception("Arquivo '${arquivo}' não encontrado");
        }

        $tipoArquivo = strtolower(pathinfo($arquivo,PATHINFO_EXTENSION));

        if($tipoArquivo != "txt") {
			throw new Exception("Tipo de arquivo inválido! Apenas .txt é aceito.");
		}

        if (filesize($arquivo) == 0){
		    throw new Exception("Arquivo vazio");
		}
	}

	public static function extrairDadosArquivo($banco, $arquivo) {

		Extracao::validarArquivo($arquivo);

        $linhasFormatadas = array();

        $file_handle = fopen($arquivo, "r");

		while (!feof($file_handle)) {

			$linha = fgets($file_handle);

			$linhaFormatada = Extracao::extrairDadosLinha($banco, $linha);

			if (count($linhaFormatada)) {
				array_push($linhasFormatadas, $linhaFormatada);
			}

		}

		fclose($file_handle);

		return $linhasFormatadas;

	}

	public static function extrairDadosLinha($banco, $linha) {
		
		$tipo_registro = substr($linha, $banco->caminhoCodigoParametro['inicio'], $banco->caminhoCodigoParametro['tamanho']);

		if (!array_key_exists($tipo_registro, $banco->parametros)) {
		    throw new Exception("Arquivo inválido! Tipo de parametro '${tipo_registro}' não encontrado");
		}

		$parametros = $banco->parametros[$tipo_registro];

		$retorno = array();

		if ($tipo_registro != '') {
			foreach ($parametros['atributos'] as $atributo) {
				switch ($atributo['tipo']) {
					case 'date':
						$retorno[$atributo['atributo']] = trim(Utils::formatarData(substr($linha, $atributo['inicio'], $atributo['tamanho']), $banco->formatoData, $banco->separadorData));
						break;

					case 'time':
						$retorno[$atributo['atributo']] = trim(Utils::formatarHora(substr($linha, $atributo['inicio'], $atributo['tamanho']), $banco->formatoHora, $banco->separadorHora));
						break;

					case 'double':
						$retorno[$atributo['atributo']] = trim(Utils::formatarValorMonetario(substr($linha, $atributo['inicio'], $atributo['tamanho']), $atributo['tamanho']));
						break;
					default:
						$retorno[$atributo['atributo']] = trim(substr($linha, $atributo['inicio'], $atributo['tamanho']));
						break;
				}
			}
		}

		return $retorno;
	}
}

?>