<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use File;

class ResourceController extends Controller
{


	private $resource = [  "inquirySource"=>"inquirySourceList",
						   "purposes"=>"purpose",
						   "countries"=>"countryList",
						   "houseTypes"=>"houseTypeList",
						   "roomTypes"=>"roomTypeList",
						   "bedTypes"=>"bedTypeList",
						   "China"=>"Country_State/China_StateList",
						   "United States"=>"Country_State/UnitedStates_StateList",
						   "United Kingdom"=>"Country_State/UnitedKingdom_StateList",
						   "countryCode"=>"phoneCountryCode",
						   "hotcountry" =>"hotCountryList",
						   "UnitedStates"=>["origin"=>"Country_State/UnitedStates_StateList",
											"Alabama"=>"State_City/AlabamaCityList",
											"Alaska"=>"State_City/AlaskaCityList",
											"Arizona" =>"State_City/ArizonaList",
											"Arkansas"=>"State_City/ArkansasCityList",
											"California"=>"State_City/CaliforniaCityList",
											"Colorado"=>"State_City/ColoradoCityList",
											"Connecticut"=>"State_City/ConnecticutCityList",
											"Delaware"=>"State_City/DelawareCityList",
											"Florida"=>"State_City/FloridaCityList",
											"Georgia"=>"State_City/GeorgiaCityList",
											"Hawaii"=>"State_City/HawaiiCityList",
											"Idaho"=>"State_City/IdahoCityList",
											"Illinois"=>"State_City/IllinoisCityList",
											"Indiana"=>"State_City/IndianaCityList",
											"Iowa"=>"State_City/IowaCityList",
											"Kansas"=>"State_City/KansasCityList",
											"Kentucky"=>"State_City/KentuckyCityList",
											"Louisiana"=>"State_City/LouisianaCityList",
											"Maine"=>"State_City/MaineCityList",
											"Maryland"=>"State_City/MarylandCityList",
											"Massachusetts"=>"State_City/MassachusettsCityList",
											"Michigan"=>"State_City/MichiganCityList",
											"Minnesota"=>"State_City/MinnesotaCityList",
											"Mississippi"=>"State_City/MississippiCityList",
											"Missouri"=>"State_City/MissouriCityList",
											"Montana"=>"State_City/MontanaCityList",
											"Nebraska"=>"State_City/NebraskaCityList",
											"Nevada"=>"State_City/NevadaCityList",
											"New_Hampshire"=>"State_City/New_HampshireCityList",
											"New_Jersey"=>"State_City/New_JerseyCityList",
											"New_Mexico"=>"State_City/New_MexicoCityList",
											"New_York"=>"State_City/New_YorkCityList",
											"North_Carolina"=>"State_City/North_CarolinaCityList",
											"North_Dakota"=>"State_City/North_DakotaCityList",
											"Ohio"=>"State_City/OhioCityList",
											"Oklahoma"=>"State_City/OklahomaCityList",
											"Oregon"=>"State_City/OregonCityList",
											"Pennsylvania"=>"State_City/PennsylvaniaCityList",
											"Rhode_Island"=>"State_City/Rhode_IslandCityList",
											"South_Carolina"=>"State_City/South_CarolinaCityList",
											"South_Dakota"=>"State_City/South_DakotaCityList",
											"Tennessee"=>"State_City/TennesseeCityList",
											"Texas"=>"State_City/TexasCityList",
											"Utah"=>"State_City/UtahCityList",
											"Vermont"=>"State_City/VermontCityList",
											"Virginia"=>"State_City/VirginiaCityList",
											"Washington"=>"State_City/WashingtonCityList",
											"West_Virginia"=>"State_City/West_VirginiaCityList",
											"Wisconsin"=>"State_City/WisconsinCityList",
											"Wyoming"=>"State_City/WyomingCityList"
											]
							];

	public function getlist($type){
		$restype = str_replace('_','.',$type);
		if(array_has($this->resource, $restype))
		{
			$resfilename = array_get($this->resource,$restype);
			if(is_array($resfilename))
				$resfilename = $resfilename["origin"];

			$content = File::get(storage_path('list/'.$resfilename));
			$content = preg_split("/\r\n|\n|\r/", $content);

			return response($content)
				->header('Cache-Control', 'max-stale[3600]')
				->header('Content-Type', 'json');
		}
		else 
			abort(400);
	}

	public function getCity($country, $state){
		$content = File::get(storage_path('list/State_City_Option/'. $state. 'CityListOption'));
		//$content = preg_split("/\r\n|\n|\r/", $content);
		// Log::info($content);
		return response($content)
				->header('Cache-Control', 'max-stale[3600]')
				->header('Content-Type', 'json');
	}
}
