<?php

require 'vendor/autoload.php';

Flight::route('/', function(){
	$url = "http://api.elpais.com/ws/LoteriaNavidadPremiados?n=";
	$nums = ["53026:20","77822:20","50099:20","82771:20","92100:20","08179:20","00117:10","85664:20","54399:20","18916:5"];
	foreach ($nums as $num) {
		$numdata = explode(':', $num);
		$numero = (int)$numdata[0];
		$jugado = (int)$numdata[1];
		$json = file_get_contents($url.$numero);
		$json = str_replace("busqueda=", "", $json);
		$obj = json_decode($json);
		
		if(!$obj->error) echo $numero.': '.number_format(max($jugado * $obj->premio / 20, 0),2, ',','.')."€\n";
		else echo "$numero error\n";
		
	}
});

Flight::start();

