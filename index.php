<?php

header('Content-Type: application/json');

require_once "banco/BancoFactory.php";
require_once "extracao/Extracao.php";

try {
	
    $codigo = $_GET['codigo'];
    
    $banco = BancoFactory::obterInstancia($codigo);
    
    switch ($codigo) {
    	case 'A':
    		$arquivo = 'txt/A.txt';
    		break;

    	case 'B':
    		$arquivo = 'txt/B.txt';
    		break;
        
    }
	
	$dadosFormatados = Extracao::extrairDadosArquivo($banco, $arquivo);
	
	http_response_code(200);
	echo json_encode($dadosFormatados);

} catch (Exception $e) {
	http_response_code(404);
    echo json_encode(array('erro' => $e->getMessage()));
}


?>