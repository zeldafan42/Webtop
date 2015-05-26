<?php
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
	echo "<option disabled selected> --select Contry--</option>";
	foreach($countries as $country)
	{
		echo "<option value=\"".$country."\">".$country."</option>";
	}
	echo "</select>";
	
	echo "<div id=\"weatherCities\"></div>";
	echo "<div id=\"weatherResult\"></div>";
	
?>