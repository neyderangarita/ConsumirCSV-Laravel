<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsumirSpotifyController extends Controller
{


    public function index()
    {


		try {

	        //Consumir los datos desde el CSV.
	    	$feed1 = 'https://spotifycharts.com/regional/global/daily/latest/download';
	    	$feed2 = 'https://spotifycharts.com/regional/ec/daily/latest/download';

			$keys = array();
			$newArray = array();

			
			// Function to convert CSV into associative array
			function csvToArray($file, $delimiter) { 

			  if (($handle = fopen($file, 'r')) !== FALSE) { 
			    $i = 0; 
			    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
			      for ($j = 0; $j < count($lineArray); $j++) { 
			        $arr[$i][$j] = $lineArray[$j]; 
			      } 
			      $i++; 
			    } 
			    fclose($handle); 
			  } 
			  return $arr; 
			} 
			 
			// convertira array a CSV
			$data1 = csvToArray($feed1, ',');
			$data2 = csvToArray($feed2, ',');

			// Unir los dos array
			$union = array_merge($data1, $data2);

			$count = count($union) - 1;
			$labels = array_shift($union);  
			 
			foreach ($labels as $label) {
			  $keys[] = $label;
			}
			 
			$keys[] = 'id';
			 
			for ($i = 0; $i < $count; $i++) {
			  $union[$i][] = $i;
			}
			 
			for ($j = 0; $j < $count; $j++) {
			  $d = array_combine($keys, $union[$j]);
			  $newArray[$j] = $d;
			}

			return json_encode($newArray);

		}
        catch (\Exception $e) {  

        	return response()->view('errors.custom', [], 500);
        }


    }

}
