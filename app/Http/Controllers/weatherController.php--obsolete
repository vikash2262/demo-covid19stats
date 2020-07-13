<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateTime;

class weatherController extends Controller
{
    
    protected $get_countries_data = [];
    protected $get_covid_data = [];

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->get_covid_data = [];
        $this->get_countries_data = $this->getCountries();
    }

    public function index(){
        
        return view('weather',['get_countries_list' => $this->get_countries_data,'get_covid_data' => $this->get_covid_data]);
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'country' => 'required|string',
            'fromdate' => 'required|date',
            'todate' => 'required|date',
        ]);

        if($request){
            $request->flash();

            /*$post_from_date = ($request->input('fromdate').'T00:00:00Z');
            $post_to_date = ($request->input('todate').'T00:00:00Z');

            $this->get_covid_data = $this->getDataByCountry($request->input('country'),$post_from_date,$post_to_date);

            foreach($this->get_covid_data as $key=>$value){
                new DateTime($value->Date))->format('yyyy-mm-dd')
            }*/

            $post_from_date = ($request->input('fromdate'));
            $post_to_date = ($request->input('todate'));

            $this->get_covid_data = $this->getDataByCountry($request->input('country'),$post_from_date,$post_to_date);

            $this->get_covid_data = array_reverse($this->get_covid_data);
            //echo $post_from_date.' - '.$post_to_date;
            //unset($this->get_covid_data[0]);
            //dd($this->get_covid_data);
            foreach($this->get_covid_data as $key=>$value){
                $res_date = (new DateTime($value->Date))->format('yy-m-d');
                
                //echo $res_date.'<br>';

                if(!(($res_date >= $post_from_date) && ($res_date <= $post_to_date))){
                    unset($this->get_covid_data[$key]);
                }
            }
        }
        
        return view('weather',['get_countries_list' => $this->get_countries_data,'get_covid_data' => $this->get_covid_data]);
    }

    public function getCountries(){
        //$data = '[{"Country":"india","Slug":"india","ISO2":"SC"},{"Country":"sdsdsd","Slug":"sdsdsd","ISO2":"SC"}]';
        $data = file_get_contents('https://api.covid19api.com/countries');
        return json_decode($data);   
    }

    public function getDataByCountry($country_slug,$post_from_date,$post_to_date){
        //$data = '[{"Country":"India","CountryCode":"IN","Province":"","City":"","CityCode":"","Lat":"20.59","Lon":"78.96","Confirmed":697413,"Deaths":19693,"Recovered":424433,"Active":253287,"Date":"2020-07-01T00:00:00Z"},{"Country":"India","CountryCode":"IN","Province":"","City":"","CityCode":"","Lat":"20.59","Lon":"78.96","Confirmed":719664,"Deaths":20159,"Recovered":439934,"Active":259571,"Date":"2020-07-06T00:00:00Z"},{"Country":"India","CountryCode":"IN","Province":"","City":"","CityCode":"","Lat":"20.59","Lon":"78.96","Confirmed":767296,"Deaths":21120,"Recovered":1221,"Active":767296,"Date":"2020-07-08T00:00:00Z"}]';
        $query_string = "?from=".$post_from_date."&to=".$post_to_date;
        //dd('https://api.covid19api.com/live/country/'.$country_slug.$query_string);
        //$data = file_get_contents('https://api.covid19api.com/country/'.$country_slug.$query_string);
        
        $data = file_get_contents('https://api.covid19api.com/total/country/'.$country_slug);
        return json_decode($data);   

    }
}
