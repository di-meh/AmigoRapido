<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter des adresses</title>
</head>

<body>
	<form action="">
		<input type="text" style="width: 100%" name="adresse" id="adresse" placeholder="Adresse">
		<button onClick="ajouterAdresse();" type="button">Ajouter</button>
	</form>
	<p id="output"></p>

	<?php 
	$host_name = 'db5000192667.hosting-data.io';
	$database = 'dbs187492';
	$user_name = 'dbu307082';
	$password = 's2kSE$F21mN1';
	$connect = mysqli_connect( $host_name, $user_name, $password, $database );
	
//	if (isset($_POST["querry"])) {
//		$numeroRue = htmlspecialchars($_POST["rue"]);
//		$adresse = htmlspecialchars($_POST["lieu"]);
//		$ville = htmlspecialchars($_POST["ville"]);
//		$pays = htmlspecialchars($_POST["pays"]);
//		$latitude = htmlspecialchars($_POST["lat"]);
//		$longitude = htmlspecialchars($_POST["lng"]);
//		$req = "INSERT INTO `lieu`(`id_lieu`, `num_rue`, `nom_lieu`, `nom_ville`, `nom_pays`, `latitude`, `longitude`) VALUES (DEFAULT,'$numeroRue','$adresse','$ville','$pays',$latitude,$longitude)";
//		mysqli_query( $connect, $req );
//	}	
	?>
</body>
<script>
	function ajouterAdresse() {
		var inputAdr = document.getElementById( 'adresse' ).value;
		$.getJSON( 'https://maps.googleapis.com/maps/api/geocode/json?address=' + inputAdr + '&key=AIzaSyDK3l80CD5NKh7rJ3cxr8xEfbKnyNkAPfU', function ( data ) {
			if ( data.status == "ZERO_RESULTS" ) {
				document.getElementById( 'output' ).innerHTML = data.status;
			} else {
				var obj = getAddressObject( data.results[ 0 ].address_components );
				$.post( "maps.php", {
					querry: "done",
					rue: obj.home,
					lieu: obj.street,
					ville: obj.city,
					pays: obj.country,
					lat: data.results[ 0 ].geometry.location.lat,
					lng: data.results[ 0 ].geometry.location.lng
				} );
			}
			console.log( obj );
		} );
	}

	function getAddressObject( address_components ) {
		var ShouldBeComponent = {
			home: [ "street_number" ],
			postal_code: [ "postal_code" ],
			street: [ "street_address", "route", "accounting", "airport", "amusement_park", "aquarium", "art_gallery", "atm", "bakery", "bank", "bar", "beauty_salon", "bicycle_store", "book_store", "bowling_alley", "bus_station", "cafe", "campground", "car_dealer", "car_rental", "car_repair", "car_wash", "casino", "cemetery", "church", "city_hall", "clothing_store", "convenience_store", "courthouse", "dentist", "department_store", "doctor", "drugstore", "electrician", "electronics_store", "embassy", "fire_station", "florist", "funeral_home", "furniture_store", "gas_station", "grocery_or_supermarket", "gym", "hair_care", "hardware_store", "hindu_temple", "home_goods_store", "hospital", "insurance_agency", "jewelry_store", "laundry", "lawyer", "library", "light_rail_station", "liquor_store", "local_government_office", "locksmith", "lodging", "meal_delivery", "meal_takeaway", "mosque", "movie_rental", "movie_theater", "moving_company", "museum", "night_club", "painter", "park", "parking", "pet_store", "pharmacy", "physiotherapist", "plumber", "police", "post_office", "primary_school", "real_estate_agency", "restaurant", "roofing_contractor", "rv_park", "school", "secondary_school", "shoe_store", "shopping_mall", "spa", "stadium", "storage", "store", "subway_station", "supermarket", "synagogue", "taxi_stand", "tourist_attraction", "train_station", "transit_station", "travel_agency", "university", "veterinary_care", "zoo", "establishment" ],
			region: [
				"administrative_area_level_1",
				"administrative_area_level_2",
				"administrative_area_level_3",
				"administrative_area_level_4",
				"administrative_area_level_5"
			],
			city: [
				"locality",
				"sublocality",
				"sublocality_level_1",
				"sublocality_level_2",
				"sublocality_level_3",
				"sublocality_level_4"
			],
			country: [ "country" ]
		};

		var address = {
			home: "",
			street: "",
			city: "",
			country: ""
		};
		address_components.forEach( component => {
			for ( var shouldBe in ShouldBeComponent ) {
				if ( ShouldBeComponent[ shouldBe ].indexOf( component.types[ 0 ] ) !== -1 ) {
					if ( shouldBe === "country" ) {
						address[ shouldBe ] = component.long_name;
					} else {
						address[ shouldBe ] = component.long_name;
					}
				}
			}
		} );
		return address;
	}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</html>