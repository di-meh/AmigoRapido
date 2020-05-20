$(document).ready(function () {
	//DEBUG COnfirmation

	console.log('pays dep : ', $('#pays-menu').val());

	// FIN DEBUG Confirmation




	var dptDest = [false, false, null, null];
	var today = new Date();

	$('.ui.checkbox')
	.checkbox();



	/* PARTIE DÉPART */
	console.log('\nI. dptDest : ', dptDest, '\n');
	$("#pays").dropdown({
		clearable: true,
		allowAdditions: true,
		onChange: function (value, text, $selectedItem) {
			// Changer le dropdown des villes en fonction des pays
			var divVille = document.getElementById('villes-menu');
			loadDropdownVille(value, divVille);

		}
	});

	$("#paysInput").change(function () {
		$('#villes').dropdown({
			"clearable": true,
			allowAdditions: true,
			onChange: function (value, text, $selectedItem) {
				// Changer le dropdown des rues en fonction des villes
				var divVille = document.getElementById('rues-menu');
				loadDropdownRue(value, divVille);

			}
		});
		$('#villes').dropdown('clear');
		$('#rues').dropdown('clear');
		var dropdownVille = document.getElementById('dropdown-ville');
		dropdownVille.style.display = "";

		checkEtatInputDeptRtr($('#paysInput'), $('#pays'), $('#pays-menu .item'), $('#checkEtatPaysDpt'));
	});

	$("#villeInput").change(function () {
		$('#rues').dropdown('clear');
		$('#rues').dropdown({
			clearable: true,
			allowAdditions: true
		});
		var dropdownVille = document.getElementById('dropdown-rues');
		dropdownVille.style.display = "";

		checkEtatInputDeptRtr($('#villeInput'), $('#villes'), $('#villes-menu .item'), $('#checkEtatVilleDpt'));
	});

	$("#ruesInput").change(function () {

		checkEtatInputDeptRtr($('#ruesInput'), $('#rues'), $('#rues-menu .item'), $('#checkEtatRueDpt'));

		if ($("#ruesInput").val() !== '' && $("#villeInput").val() !== '' && $("#paysInput").val() !== '') {
			var adresseFull = $("#ruesInput").val() + ', ' + $("#villeInput").val() + ', ' + $("#paysInput").val();
			console.log('on a adresseFull : ', adresseFull);


			var ret = new Promise((resolve, reject) => {
				var adrReccup = chercherAdresse(adresseFull, false);

				return resolve(adrReccup);
				// console.log('on a reccup l obj : ', adrReccup);
			}).then((adr) => {
				console.log("on réccupère : ", adr);
				console.log("on avait : ", adresseFull);

				var adresseCompo = adr["home"] + " " + adr["street"] + ", " + adr["city"] + ", " + adr["country"];

				console.log("adresseCompo : ", adresseCompo);

				if (adresseFull === adresseCompo) {
					console.log("l'adresse est dans la BD");

					$('#labelDeptOK').css("display", "");
					$('#labelDeptPasOK').css("display", "none");

					dptDest[0] = true;
					dptDest[2] = adresseFull;
					return true;
				} else {
					console.log("l'adresse n'est pas dans la BD, il faut l'ajouter");

					ajoutLieuBD(adr, adresseCompo);

					dptDest[0] = false;
					dptDest[2] = null;
					return false;
				}
			}).then(() => {
				console.log('\nII. dptDest : ', dptDest, '\n');
				if (verifEstPx()) {
					return true;
				}
				return false;
			});
		} else {
			console.log("Un des champs est vide");
			$('#labelDestOK').css("display", "none");
			$('#labelDestPasOK').css("display", "none");

			dptDest[0] = false;
			dptDest[2] = null;
		}

	});

	/* PARTIE ARRIVÉE */
	$("#paysDest").dropdown({
		clearable: true,
		allowAdditions: true,
		onChange: function (value, text, $selectedItem) {
			// Changer le dropdown des villes en fonction des pays
			var divVilleDest = document.getElementById('villes-menuDest');
			loadDropdownVille(value, divVilleDest);
		}
	});

	$("#paysInputDest").change(function () {
		$('#villesDest').dropdown({
			clearable: true,
			allowAdditions: true,
			onChange: function (value, text, $selectedItem) {
				// Changer le dropdown des rues en fonction des villes
				var divVilleDest = document.getElementById('rues-menuDest');
				loadDropdownRue(value, divVilleDest);
			}
		});
		$('#villesDest').dropdown('clear');
		$('#ruesDest').dropdown('clear');
		var dropdownVille = document.getElementById('dropdown-villeDest');
		dropdownVille.style.display = "";
		checkEtatInputDeptRtr($('#paysInputDest'), $('#paysDest'), $('#pays-menuDest .item'), $('#checkEtatPaysAri'));
	});

	$("#villeInputDest").change(function () {
		$('#ruesDest').dropdown('clear');
		$('#ruesDest').dropdown({
			clearable: true,
			allowAdditions: true
		});
		var dropdownVilleDest = document.getElementById('dropdown-ruesDest');
		dropdownVilleDest.style.display = "";
		checkEtatInputDeptRtr($('#villeInputDest'), $('#villesDest'), $('#villes-menuDest .item'), $('#checkEtatVilleAri'));
	});

	$("#ruesInputDest").change(function () {
		checkEtatInputDeptRtr($('#ruesInputDest'), $('#ruesDest'), $('#rues-menuDest .item'), $('#checkEtatRueAri'));



		if ($("#ruesInputDest").val() !== '' && $("#villeInputDest").val() !== '' && $("#paysInputDest").val() !== '') {
			var adresseFull = $("#ruesInputDest").val() + ', ' + $("#villeInputDest").val() + ', ' + $("#paysInputDest").val();
			console.log('on a adresseFull : ', adresseFull);


			var ret = new Promise((resolve, reject) => {
				var adrReccup = chercherAdresse(adresseFull, false);

				return resolve(adrReccup);
			}).then((adr) => {
				console.log("on réccupère : ", adr);
				console.log("on avait : ", adresseFull);

				var adresseCompo = adr["home"] + " " + adr["street"] + ", " + adr["city"] + ", " + adr["country"];

				console.log("adresseCompo : ", adresseCompo);

				if (adresseFull === adresseCompo) {
					console.log("l'adresse est dans la BD");

					$('#labelDestOK').css("display", "");
					$('#labelDestPasOK').css("display", "none");

					dptDest[1] = true;
					dptDest[3] = adresseFull;
					return true;
				} else {
					console.log("l'adresse n'est pas dans la BD, il faut l'ajouter");

					ajoutLieuBD(adr, adresseCompo);

					dptDest[1] = false;
					dptDest[3] = null;
					return false;
				}
			}).then(() => {
				console.log('\nIII. dptDest : ', dptDest, '\n');
				if (verifEstPx()) {
					return true;
				}
				return false;
			});
		} else {
			console.log("Un des champs est vide");
			$('#labelDestOK').css("display", "none");
			$('#labelDestPasOK').css("display", "none");

			dptDest[1] = false;
			dptDest[3] = null;
		}
	});


	$('#date_depart')
	.calendar({
		minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1),
		ampm: false,
		text: {
			days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
			months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
			monthsShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
			today: 'Aujourd\'hui',
			now: 'Maintenant'
		}
	});

	function verifEstPx() {
		console.log('\n\n\nSalt\n\n\n');
		if (dptDest[0] == true && dptDest[1] == true) {
			console.log('\n\n\ncoucou I\n\n\n');
			console.log("dptDest[0]", dptDest[2]);
			console.log("dptDest[1]", dptDest[3]);

			$.post("ajax/calcul.php", {
				depart: dptDest[2],
				arrivee: dptDest[3]
			})
			.done(function (data) {
				console.log(data);

				var tmpPx = data.split('-');

				if (tmpPx[1] != null && tmpPx[1] > 0) {
					 $('#champPrix').val($('#champPrix').val() + tmpPx[1]);
				}

				$("#champPrixInformations").empty();
				$("#champPrixInformations").append("Nous vous conseillons une fourchette de prix allant de ", tmpPx[0], "€ à ", tmpPx[2], "€");
			});
		} else {
			console.log('\n\n\ncoucou II\n\n\n');
			return false;
		}
	}

	function envoieInfos() {
		console.log("ceci est un appel fonction");
	}
});

function loadDropdownVille(pays, div, ) {
	$.post("ajax/adresse.php", {
		pays: pays
	})
	.done(function (data) {
		var options = "";
		jQuery.each(JSON.parse(data), function (i, val) {
			options = options + '<div class="item" data-value="' + val['nom_ville'] + '">' + val['nom_ville'] + '</div>';
		});
		div.innerHTML = options;
	});
}

function loadDropdownRue(ville, div) {
	$.post("ajax/adresse.php", {
		ville: ville
	})
	.done(function (data) {
		var options = "";
		jQuery.each(JSON.parse(data), function (i, val) {
			options = options + '<div class="item" data-value="' + val['num_rue'] + ' ' + val['nom_lieu'] + '">' + val['num_rue'] + ' ' + val['nom_lieu'] + '</div>';
		});
		div.innerHTML = options;
	});
}

function checkEtatInputDeptRtr(input, dropdown, lieuMenu, iconInput) {
	var lieu = input.val();
	var EstDedans = false;
	lieuMenu.each(function () {
		if (lieu === $(this).attr('data-value')) {
			EstDedans = true;
		}
	});

	if (EstDedans) {

		console.log('textDate : ', $('#textDate').val(), '\n');

		console.log('La rue existe deja dans la bd');
		dropdown.css("border", "solid rgba(0,217,0,1.00) 2px");


		iconInput.removeClass().addClass("fas fa-check");
		iconInput.css("color", "rgba(0,217,0,1.00)");
	} else {
		console.log('La rue n est pas dans la BD');
		dropdown.css("border", "solid rgba(232,184,24,1.00) 2px");
		iconInput.removeClass().addClass("fas fa-question");
		iconInput.css("color", "rgba(232,184,24,1.00)");
	}
}

function chercherAdresse(adresse, bLL) {
	var reccupObj = null;
	return new Promise((resolve, reject) => {
		var t = $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address=' + adresse + '&key=AIzaSyDK3l80CD5NKh7rJ3cxr8xEfbKnyNkAPfU', function (data) {
			console.log('datas : ', data);

			if (data.status == "ZERO_RESULTS") {
				console.log("status : ", data.status);
				return null;
			} else {
				console.log("status : ", data.status);
				console.log("data results : ", data.results[0]);

				var obj = getAddressObject(data.results[0].address_components);

				console.log('type : ', typeof (obj));

				if (bLL) {
					obj['ll'] = data.results[0].geometry.location;
				} else {
					console.log("obj est : ", obj);
					reccupObj = obj;
				}
				console.log("obj est : ", obj);
				return resolve(obj);
			}
		});
	}).then(function (o) {
		console.log('reccupObj : ', o);
		return o;
	});
}

function getAddressObject(address_components) {
	var ShouldBeComponent = {
		home: ["street_number"],
		postal_code: ["postal_code"],
		street: ["street_address", "route", "accounting", "airport", "amusement_park", "aquarium", "art_gallery", "atm", "bakery", "bank", "bar", "beauty_salon", "bicycle_store", "book_store", "bowling_alley", "bus_station", "cafe", "campground", "car_dealer", "car_rental", "car_repair", "car_wash", "casino", "cemetery", "church", "city_hall", "clothing_store", "convenience_store", "courthouse", "dentist", "department_store", "doctor", "drugstore", "electrician", "electronics_store", "embassy", "fire_station", "florist", "funeral_home", "furniture_store", "gas_station", "grocery_or_supermarket", "gym", "hair_care", "hardware_store", "hindu_temple", "home_goods_store", "hospital", "insurance_agency", "jewelry_store", "laundry", "lawyer", "library", "light_rail_station", "liquor_store", "local_government_office", "locksmith", "lodging", "meal_delivery", "meal_takeaway", "mosque", "movie_rental", "movie_theater", "moving_company", "museum", "night_club", "painter", "park", "parking", "pet_store", "pharmacy", "physiotherapist", "plumber", "police", "post_office", "primary_school", "real_estate_agency", "restaurant", "roofing_contractor", "rv_park", "school", "secondary_school", "shoe_store", "shopping_mall", "spa", "stadium", "storage", "store", "subway_station", "supermarket", "synagogue", "taxi_stand", "tourist_attraction", "train_station", "transit_station", "travel_agency", "university", "veterinary_care", "zoo", "establishment"],
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
		country: ["country"]
	};

	var address = {
		home: "",
		street: "",
		city: "",
		country: ""
	};
	address_components.forEach(component => {
		for (var shouldBe in ShouldBeComponent) {
			if (ShouldBeComponent[shouldBe].indexOf(component.types[0]) !== -1) {
				if (shouldBe === "country") {
					address[shouldBe] = component.long_name;
				} else {
					address[shouldBe] = component.long_name;
				}
			}
		}
	});
	return address;
}

function ajoutLieuBD(adresseTbl, adresseC) {
	return new Promise((resolve, reject) => {
		var adrReccup = chercherAdresse(adresseC, true);
		return resolve(adrReccup);
	}).then((adr) => {
		console.log("II. on réccupère : ", adr);

		console.log("adrLL : ", adr.ll.lat, adr.ll.lng);

		$.ajax({
			method: "POST",
			url: "index.php?module=deposer&action=ajoutNvLieuBD",
			data: {
				home: adr["home"],
				street: adr["street"],
				city: adr["city"],
				country: adr["country"],
				lat: adr.ll.lat,
				lng: adr.ll.lng
			}
		})
		.done(function () {
			alert("Insertion faite :)");
			$('#labelDestOK').css("display", "");
			$('#labelDestPasOK').css("display", "none");
		})
		.fail(function () {
			alert("Erreur :(");
		});
	});
}