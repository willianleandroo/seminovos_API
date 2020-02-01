<?php


	//URL SEM FILTROS
	$url = "https://seminovos.com.br/carro";

	//PEGANDO TODO O CONTEÚDO DA $url
	$urlData = file_get_contents($url); 

	//EXPLODE PARA PEGAR O CONTEÚDO A PARTIR DO PRIMEIRO ANÚNCIO DA LISTA
	$var = explode('<meta itemprop="productID" content="', $urlData);

	//
	$lastKeyArray = count($var);

	$allCars = [];
	
	for ($i=1; $i < $lastKeyArray; $i++) { 

		$umCarro = explode('">', $var[$i]);

		$carCod = $umCarro[0];
		$brand = explode('<', $umCarro[5]);
		$model = explode('<', $umCarro[6]);
		$milageFromOdometer = explode('<', $umCarro[9]);
		$price = explode('<', $umCarro[11]);
		$versionExplode1 = explode('<span>VERSÃO: ', $umCarro[31]);
		$version = explode(' <', $versionExplode1[1]);
		$year_modelExplode1 = explode('</i>', $umCarro[34]);
		$year_model = explode('<', $year_modelExplode1[1]);
		$urlDetailsExplode1 = explode('meta itemprop="url" content="', $price[2]);
		$urlDetails = explode('?', $urlDetailsExplode1[1]);

		$oneCar = [
		'cod'			=>	$carCod,
		'marca'			=>	$brand[0],
		'modelo'		=>	$model[0],
		'kms_rodados'	=>	$milageFromOdometer[0],
		'preco'			=>	$price[0],
		'versao'		=>	$version[0],
		'ano_modelo'	=>	$year_model[0],
		'url'			=>	$urlDetails[0]
		];

		array_push($allCars, $oneCar);
		
	
	
	}

	$allCarsJSON = json_encode($allCars);
	echo $allCarsJSON;










?>