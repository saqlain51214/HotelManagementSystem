<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testApi extends Controller
{
    public function testApi(Type $var = null)
    {
        
        $url = "https://bitpay.com/api/rates";
        $json = json_decode(file_get_contents($url));
        dd($json);
        $dollar = $btc = 0;
            foreach($json as $obj){
                echo '1 bitcoin = $'. $obj->rate .' '. $obj->name .' ('. $obj->code .')<br>';
            }
    }
}
