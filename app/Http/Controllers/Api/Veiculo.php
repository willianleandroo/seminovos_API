<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Veiculo extends Controller
{

	public function index()
	{
		return ['status'	=>	true];
		exit;

	//URL DE DETELHES DO VEÍCULO /codveiculo
	$url = "https://seminovos.com.br/";

	//PEGANDO TODO O CONTEÚDO DA $url
	$urlData = file_get_contents($url);

	//EXPLODE PARA PEGAR O CONTEÚDO A PARTIR DO PRIMEIRO ANÚNCIO DA LISTA
	$var = explode('<meta itemprop="productID" content="', $urlData);

	// TRANFORMANDO CADA DADO QUE VENHA DEPOIS DE "> EM ARRAY
	$car = explode('">', $var[1]);

	// EXPLODE NOS ACESSORIOS
	$accessoriesExplode1 = explode('<span class="description-print">', $var[1]);

	// CONTANDO O ARRAY DOS ACESSORIOS POIS A ÚLTIMA KEY É O ÚLTIMO ACESSORIO
	$lastKeyArray = count($accessoriesExplode1);

	$acessories = [];
	
	// var_dump($x);
	// exit;

	// ADICIONANDO OS ACESSORIOS NO ARRAY DO MESMO
	for ($i=1; $i < $lastKeyArray; $i++) { 

		$accessoriesExplode2 = explode('<', $accessoriesExplode1[$i]);
		array_push($acessories, $accessoriesExplode2[0]);
	}
	

	$carCod = $car[0];
	$brand = explode('<', $car[17]);
	$model = explode('<', $car[19]);
	$year_model = explode('<', $car[67+1]);
	$version = explode('<', $car[60+1]);
	$milageFromOdometer = explode('<', $car[71+1]);
	$price = explode('<', $car[8]);
	$color = explode('<', $car[87+1]);
	$plaque = explode('<', $car[91+1]);
	$shift = explode('<', $car[75+1]);
	$fuel = explode('<', $car[83+1]);
	$doors = explode('<', $car[79+1]);
	$changeCar = explode('<', $car[95+1]);


	/*var_dump($year_model);
	exit;*/
	

	// 4cod = explode('', $car[98]);
	$carData = [
		'cod'			=>	$carCod,
		'marca'			=>	$brand[0],
		'modelo'		=>	$model[0],
		'ano_modelo'	=>	$year_model[0],
		'versao'		=>	$version[0],
		'preco'			=>	$price[0],
		'kms_rodados'	=>	$milageFromOdometer[0],
		'cor'			=>	$color[0],
		'placa'			=>	$plaque[0],
		'cambio'		=>	$shift[0],
		'combustivel'	=>	$fuel[0],
		'portas'		=>	$doors[0],
		'troca'			=>	$changeCar[0],
		'acessorios'	=>	$acessories
		];

		echo json_encode($carData);
		 

	}
}
