<?php
	if(isset($_POST['country']))
	{
		$svcEp = 'http://www.webservicex.net/globalweather.asmx?WSDL';
		
		$client = new SoapClient($svcEp);
		
		$params = array();
		
		$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
		
		$params['CountryName'] = $country;
		
		$res = $client->GetCitiesByCountry($params);
		
		$citySelect = simplexml_load_string($res->GetCitiesByCountryResult);
		
		$i = 0;
		$cities = array();
		
		foreach ($citySelect->Table as $selOpt)
		{
			$ctr = (string) $selOpt->City;
			if(!in_array($ctr, $cities))
			{
				$cities[$i] = $ctr;
				$i++;
			}
		}
		
		sort($cities);
		
		echo "<select onChange=\"fetchWeather(this.value)\">";
		echo "<option disabled selected> --select City--</option>";
		foreach($cities as $city)
		{
			echo "<option value=\"".$city.",".$country."\">".$city."</option>";
		}
		echo "</select>";
	}
	if(isset($_POST['city'], $_POST['wCountry']))
	{
		$svcEp = 'http://www.webservicex.net/globalweather.asmx?WSDL';
	
		$client = new SoapClient($svcEp);
	
		$params = array();
	
		$params['CountryName'] = $_POST['wCountry'];
		$params['CityName'] = $_POST['city'];
	
		$res = $client->GetWeather($params);
		
		
		
		$toConvert = $res->GetWeatherResult;
		
		$converted = str_replace("utf-16", "utf-8",$toConvert);
		
		if($toConvert != "Data Not Found")
		{
			$weather = simplexml_load_string($converted);
			
			if(isset($weather->Time))
			{
				echo "<p>Zeit: ".$weather->Time."</p>";
			}
			
			if(isset($weather->Temperature))
			{
				echo "</br><p>Temperatur: ".$weather->Temperature."</p>";
			}
			
			if(isset($weather->SkyConditions))
			{
				switch((string) $weather->SkyConditions)
				{
					case " clear":
						echo "<img src=\"res/clear.png\"/>";
						break;
						
					case " mostly clear":
						echo "<img src=\"res/mostlyclear.png\"/>";
						break;

					case " partly cloudy":
						echo "<img src=\"res/partlycloudy.png\"/>";
						break;
		
					case " mostly cloudy":
						echo "<img src=\"res/mostlycloudy.png\"/>";
						break;
						
					case " overcast":
						echo "<img src=\"res/cloudy.png\"/>";
						break;
						
					case " fair":
						echo "<img src=\"res/clear.png\"/>";
						break;
						
					default:
						break;
				}
			}
			//var_dump($weather);
		}
		else
		{
			echo "<p id=\"weatherError\">Could not find corresponding data</p>";
		}
	}
	if(isset($_POST['getCountries']))
	{
		$svcEp = 'http://www.webservicex.net/globalweather.asmx?WSDL';
		
		$client = new SoapClient($svcEp);
		
		$params = array();
		
		$params['CountryName'] = '';
		
		$res = $client->GetCitiesByCountry($params);
		
		$countrySelect = simplexml_load_string($res->GetCitiesByCountryResult);
		
		$i = 0;
		$countries = array();
		
		foreach ($countrySelect->Table as $selOpt)
		{
			$ctr = (string) $selOpt->Country;
			if(!in_array($ctr, $countries))
			{
				$countries[$i] = $ctr;
				$i++;
			}
		}
		
		sort($countries);
		
		echo "<select onChange=\"fetchCities(this.value)\">";
		echo "<option disabled selected> --select Country--</option>";
		foreach($countries as $country)
		{
			echo "<option value=\"".$country."\">".$country."</option>";
		}
		echo "</select>";
	}
?>