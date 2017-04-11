<?php
require_once "mercadopago.php";
class MercadoPagoClass{
	private $client_id;
	private $client_secret;
	private $titulo;
	private $cantidad;
	private $moneda;
	private $precio;
	private $credentials;
	private $categoria;

	function MercadoPagoClass($sandbox=false){
		$this->credentials = parse_ini_file(dirname(__FILE__)."/credentials.ini");
		$this->moneda='COP';
		$this->credentials = parse_ini_file(dirname(__FILE__)."/credentials.ini");
		$this->client_id=$this->credentials["CLIENT_ID"];
		$this->client_secret=$this->credentials["CLIENT_SECRET"];
		$this->categoria='Evento';
		$this->cantidad=0;
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

	public function generarBotonPago(){
		$preference_data = array(
		    "items" => array(
		        array(
		            "title" => $this->titulo,
		            "currency_id" => $this->moneda,
		            "category_id" => $this->categoria,
		            "quantity" => $this->cantidad,
		            "unit_price" => $this->precio
		        )
		    ),
		    "back_urls" => array(
				"success" => "https://www.success.com",
				"failure" => "http://www.failure.com",
				"pending" => "http://www.pending.com"
			),
		);
		$mp = new MP($this->client_id, $this->client_secret);
		$preference = $mp->create_preference($preference_data);
		if($sandbox){
			$html='<a href="'.$preference["response"]["init_point"].'" name="MP-Checkout" class="orange-ar-m-sq-arall">Pagar</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>';
		}else{
			$html='<a href="'.$preference["response"]["sandbox_init_point"].'" name="MP-Checkout" class="orange-ar-m-sq-arall">Pagar</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>';
		}
		return $html;
		
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
