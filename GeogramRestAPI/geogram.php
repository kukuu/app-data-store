
<?php 
	// Author: Alexander Adu-Sarkodie
	//Simple quick Single Page PHP Web REST API
	//Retrieving images from Instagram based on geolocation parameters
	// Longitudes and Latitudes
		//***********************
		//***********************
		//***********************
				//Phase 2 to include:
				//::Modularisation
				//: Caching
				//: Styling
				//Error handling
				//Make request over AJAX
				//: Microservice
		//***********************
		//***********************
		//***********************
	//: Notes!!!!
	//Check if location has been submitted, if not then we submit:
	//Google Maps API:
	//https://maps.googleapis.com
		//:     /maps
		//:			/api
		//: 		/geocode
		//:			/json
		//:			?address=disneyland,ca

	// 	algorthm begins!
	if(!empty($_GET['location'])){
		//$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address'.$_GET['location'];
		//remove space  (%20)in URL string by wrapping $_GET['location'] in url_encode
		$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address'.urlencode($_GET['location']);

		// pass this as argument to file_get_content. Store into a variable i.e $maps_json
		$maps_json = file_get_contents($maps_url);

		// to be able to use the json this needs to be passed into  php array using json_decode
		//set the decode function to true so that the json is decoded into an array instead of into an object
		$maps_array = json_decode($maps_json,true);

		//Build coordinates: and pass on to instagram:
		//we pass the above stored variable $maps_array  as parameters (argument) to the  decoded array and store
		//into 2 variables $lat and $lng. Following the document order hierarchy
		$lat = $maps_array['result'][0]['geometry']['location']['lat'];
		$lng = $maps_array['result'][0]['geometry']['location']['lng'];

		//Instagram SEARCH API:
		// https://api.instagram.com
		//  /v1/media/search
		//  ?lat=
		//	&lng=
		//	&client_id=
		// Use your own client_id key. Register at instagram!
		$instagram_url = 'https://api.instagram.com/v1/media/search?=lat'.$lat.'$lng='.$lng.'$client_id=59cd273f121d4139b97a8a027a993ddf';

		//now we pass this URL to the php file_get_contents function to get a json and decode it into PHP array as previous
		$instagram_json = file_get_contents($instagram_url );
		$instagram_array = json_decode($instagram_json, true);

	}

?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>Instagram geogram API - Alexander Adu-Sarkodie</title>
	</head>
	<body>
		<!--serve on localhost://geogram.php-->
		<form action="">
			<input type="text" name="location" />
			<button type="submit">Submit</button>
			<br />

			<!--we build php template to loop through the algoritm  and return the images
				Wrap the loop in a conditional loop ( if clause) to first check if the API call has (successful) images before loading-->

			<?php
				//foreach ($instagram_array['data'] as  $image) {
					# code...
				//	echo '<img src="'.$image['images']['low_resolution']['url']'" alt=""' />;
				//}

				if (!empty($instagram_array)) {
					# code...
					foreach ($instagram_array['data'] as  $image) {
						# code...
						echo '<img src="'.$image['images']['low_resolution']['url'].'" alt=""' />;
					}
				}
			?>

		</form>
	</body>
</html>