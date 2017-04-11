<?php
require_once '../Httpfull/bootstrap.php';
require_once '../lib/mercadopago.php';
public class MercadoPagoClass(){
	private $public_key;
	private $access_token;

	private $client_id;
	private $client_secret;
	private $titulo;
	private $cantidad;
	private $moneda;
	private $precio;

	private $url;
	private $url_base;

	function MercadoPagoClass($public_key,$access_token){
		$this->url_base='https://api.mercadolibre.com/';
		$this->public_key=$public_key;
		$this->access_token=$access_token;
	}
	function MercadoPagoClass(){
		$this->url_base='https://api.mercadolibre.com/';
		$this->public_key='TEST-3b27375a-4a67-475f-8aba-a4b073447d80';
		$this->access_token='TEST-3121391224066490-041110-32520c86eaabce6c88e7998bbda9d195__LB_LC__-251651651';

		$this->moneda='COP';

	}
	public function getClientID(){
		return $this->client_id;
	}
	public function getClientSecret(){
		return $this->client_secret;
	}
	public function setClientID($client_id){
		$this->client_id=$client_id;
	}
	public function getTitulo(){
		return $this->titulo;
	}
	public function setTitulo($titulo){
		$this->titulo=$titulo;
	}
	public function getCantidad(){
		return $this->cantidad;
	}
	public function setCantidad($cantidad){
		if(is_numeric($cantidad)){
			$this->cantidad=$cantidad;
		}else{
			throw new Exception('La cantidad debe ser numerica.');
		}
	}
	public function getPrecio(){
		return $this->precio;
	}
	public function setPrecio($precio){
		if(is_numeric($precio)){
			$this->precio=$precio;
		}else{
			throw new Exception('El precio debe ser numerico.');
		}
	}
	public function getUrl(){
		return $this->url;
	}
	public function setUrl($url){
		$this->url=$url;
	}
	public function pagar(){

		$mp = new MP('3121391224066490', 'W0LtO8zTvGx5g4pMClbNR0eurpqLoUSS');
		$preference_data = array (
		    "items" => array (
		        array (
		            "title" => $this->titulo,
		            "quantity" => $this->cantidad,
		            "currency_id" => $this->moneda,
		            "unit_price" => $this->precio
		        )
		    )
		);


		$uri=$this->url_base.$this->url;
		try{
			$response = \Httpful\Request::get($uri)
			    ->expectsJson()
			    ->withXTrivialHeader('Just as a demo')
			    ->send();
 
		}catch(Exception $err){
			throw new Exception($err->getMessage());
		}
	}


}
?>
