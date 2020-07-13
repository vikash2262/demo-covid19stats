<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class covid19Controller extends Controller
{
    protected $get_covid_data = [];

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->get_covid_data = $this->getIndiaCovidData();
    }

    public function index(){
        return view('index',['get_covid_data' => $this->get_covid_data->statewise]);
    }

    public function getIndiaCovidData(){
        $data = file_get_contents('https://api.covid19india.org/data.json');
        return json_decode($data);   
    }
}
