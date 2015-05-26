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
	
			var_dump($weather);
		}
		else
		{
			echo "<p id=\"weatherError\">Could not find corresponding data</p>";
		}
	}
?>