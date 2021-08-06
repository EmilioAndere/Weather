<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function forecast($coords){
        $cliente = curl_init();
        curl_setopt($cliente, CURLOPT_URL, "https://dark-sky.p.rapidapi.com/$coords?lang=en&units=auto");
        curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cliente, CURLOPT_HTTPHEADER, ['x-rapidapi-host: dark-sky.p.rapidapi.com', 'x-rapidapi-key: 30c426dcf4msh0b3bcb8b2e50cdap173137jsn01a3937ab9e2']);
        $current = curl_exec($cliente);
        curl_close($cliente);

        return $current;
    }

    public function current($coords,$date,$hours){
        $cliente = curl_init();
        curl_setopt($cliente, CURLOPT_URL, "https://dark-sky.p.rapidapi.com/$coords,$date".'T'.$hours);
        curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cliente, CURLOPT_HTTPHEADER, ['x-rapidapi-host: dark-sky.p.rapidapi.com', 'x-rapidapi-key: 30c426dcf4msh0b3bcb8b2e50cdap173137jsn01a3937ab9e2']);
        $current = curl_exec($cliente);
        curl_close($cliente);

        return $current;
    }

    public function climate($type, $name){
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL, "http://localhost:8001/api/$type");
        curl_setopt($client, CURLOPT_HEADER, 0);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $resp = json_decode(curl_exec($client));
        curl_close($client);
        foreach ($resp as $re){
            if($re->nombre == $name){
                $cliente = curl_init();
                curl_setopt($cliente, CURLOPT_URL, "https://dark-sky.p.rapidapi.com/$re->lat,$re->lng?lang=en&units=auto");
                curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($cliente, CURLOPT_HTTPHEADER, ['x-rapidapi-host: dark-sky.p.rapidapi.com', 'x-rapidapi-key: 30c426dcf4msh0b3bcb8b2e50cdap173137jsn01a3937ab9e2']);
                $current = curl_exec($cliente);
                curl_close($cliente);
                echo $current;
            }

        }

        //return $resp;
    }

}
