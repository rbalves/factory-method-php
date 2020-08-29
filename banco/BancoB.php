<?php

class BancoB {
	private $formatoData;
	private $separadorData;
	private $formatoHora;
	private $separadorHora;
	private $parametros;
	private $caminhoCodigoParametro;

	public function __construct() {
		$this->formatoData = 'AAAAMMDD';
		$this->separadorData = '-';
		$this->formatoHora = 'HHMM';
		$this->separadorHora = ':';
		$this->caminhoCodigoParametro = array('inicio'=>0,'tamanho'=>1);
		$this->parametros = array(
			'0' => array(
				'descricao' => 'Informações pessoais',
				'atributos' => array(               
					array('atributo'=>'nome','inicio'=>1,'tamanho'=>30,'tipo'=>'string','descricao'=>'Nome'),            
					array('atributo'=>'nascimento','inicio'=>31,'tamanho'=>8,'tipo'=>'date','descricao'=>'Data de nascimento'),
				),
			),
			'1' => array(
				'descricao' => 'Endereço',
				'atributos' => array(	
					array('atributo'=>'rua','inicio'=>1,'tamanho'=>30,'tipo'=>'string','descricao'=>'Logradouro'),            
					array('atributo'=>'bairro','inicio'=>31,'tamanho'=>25,'tipo'=>'string','descricao'=>'Bairro'),                
				),
			),

		);
	}

	public function __set($atrib, $value){
        $this->$atrib = $value;
    }
  
    public function __get($atrib){
        return $this->$atrib;
    }

}

?>