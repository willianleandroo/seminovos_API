<?php

// registrosPagina=10

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Veiculos extends Controller
{
	//URL SEM FILTROS
    CONST URL = "https://seminovos.com.br/carros";
    CONST URL_FILTER = "https://seminovos.com.br/carros/";

    public function index($registrosPagina)
    {	
    	$url = Veiculos::URL.'?registrosPagina='.$registrosPagina;
    	$filters = '';
    	return json_encode($this->createCarsJSON($filters, $url));
    }

    public function indexFilter($filters, $registrosPagina)
    {	
    	$url = Veiculos::URL_FILTER.$filters.'?registrosPagina='.$registrosPagina;
    	return json_encode($this->createCarsJSON($filters, $url));
    }

    public function createCarsJSON($filters, $url)
   	{

	   	//PEGANDO TODO O CONTEÚDO DA $url
		$urlData = file_get_contents($url.$filters);
	

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

		return $allCars;


   	}
}
