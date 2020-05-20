/*
 * Script du module 'vehicule'
 * Description : "Contient les scrits nécessaire pour faire fonctionner FomanticUI"
 * Créé le 29/11/2019 16:16
 * Last edit : hh:ss 
 */

$(document).ready(function () {

	$('.ui.selection.dropdown')
		.dropdown({
			clearable: true
		});

	// Bouton pour l'upload des documents
	$('.btnPc').click(function () {
		$('.pc').click();
	});

	$('.btnCg').click(function () {
		$('.cg').click();
	});

	$(".pc").change(function () {
		$('.btnPc').addClass("positive");
	});

	$(".cg").change(function () {
		$('.btnCg').addClass("positive");
	});

	// Boutons pour la gestion du formulaire
	$('#btnSubmit').click(function () {
		var voiture = $('#voiture').val();
		var couleur = $('#couleur').val();
		var immatriculation = $('#immatriculation').val().toUpperCase();
		if (voiture.length != 0 && couleur.length != 0 && immatriculation.length != 0) { // Tous les champs sont remplis
			// On vérifie la plaque d'immatriclation
			if (checkImmatriculation(immatriculation)) { // La plaque d'immatriculation est au bon format
				// Vérification
				var pcError = false;
				var cgError = false;
				var pc = $('#pc').val();
				var cg = $('#cg').val();

				if (pc.length == 0) {
					pcError = true;
					$('body')
						.toast({
							title: 'Erreur permis de conduire',
							class: 'error',
							displayTime: 'auto',
							showProgress: 'top',
							classProgress: 'orange',
							message: 'Veuillez renseigner un permis de conduire au format <code>.jpg</code>, <code>.jpeg</code> et <code>.png</code>.'
						});
				}
				if (cg.length == 0) {
					cgError = true;
					$('body')
						.toast({
							title: 'Erreur carte grise',
							class: 'error',
							displayTime: 'auto',
							showProgress: 'top',
							classProgress: 'orange',
							message: 'Veuillez renseigner une carte grise au format <code>.jpg</code>, <code>.jpeg</code> et <code>.png</code>.'
						});
				}

				if (!pcError && !cgError) {
					var extPc = $('#pc').val().split('.').pop().toLowerCase();
					var extCg = $('#cg').val().split('.').pop().toLowerCase();

					if ($.inArray(extPc, ['png', 'jpg', 'jpeg']) == -1) {
						cgError = true;
						$('body')
							.toast({
								title: 'Erreur permis de conduire',
								class: 'error',
								displayTime: 'auto',
								showProgress: 'top',
								classProgress: 'orange',
								message: 'Le format <code>.' + extPc + '</code> de votre permis de conduire n\'est pas accepté ! Veuillez ajouter un fichier au format <code>.jpg</code>, <code>.jpeg</code> et <code>.png</code>.'
							});
					}
					if ($.inArray(extCg, ['png', 'jpg', 'jpeg']) == -1) {
						cgError = true;
						$('body')
							.toast({
								title: 'Erreur permis de conduire',
								class: 'error',
								displayTime: 'auto',
								showProgress: 'top',
								classProgress: 'orange',
								message: 'Le format <code>.' + extCg + '</code> de votre carte grise n\'est pas accepté ! Veuillez ajouter un fichier au format <code>.jpg</code>, <code>.jpeg</code> et <code>.png</code>.'
							});
					}
					if (!pcError && !cgError) {
						$('#btnSubmit').css('display', 'none');
						$('#btnLoading').css('display', '');
						$('#formVoitureUpdate').submit();
					}
				}

			} else { // La plaque d'immatriculation est au mauvais format
				$('body')
					.toast({
						title: 'Erreur immatriculation !',
						class: 'error',
						displayTime: 'auto',
						showProgress: 'top',
						classProgress: 'orange',
						message: 'La format de votre plaque d\'immatriculation est incorrect ! Il doit se présenter dans le format suivant : <code>XX-000-XX</code>'
					});
			}
		} else { // Erreur : tous les champs ne sont pas remplis
			$('body')
				.toast({
					title: 'Oups !',
					class: 'error',
					displayTime: 'auto',
					showProgress: 'top',
					classProgress: 'orange',
					message: 'Avant de pouvoir procéder à l\'ajout de votre véhicule, veillez à remplir tous les champs !'
				});
		}


	});


	// Upload de la photo de la voiture
	$('#uploadImageVoiture').click(function () {
		$('#inputPhotoVoiture').click();
	});

	$('#btnSavePhoto').click(function () {
		var img = $('#inputPhotoVoiture').val();
		if (img.length != 0) {
			var extImg = $('#inputPhotoVoiture').val().split('.').pop().toLowerCase();
			if ($.inArray(extImg, ['png', 'jpg', 'jpeg']) == -1) {
				$('body')
					.toast({
						title: 'Erreur de format',
						class: 'error',
						displayTime: 'auto',
						showProgress: 'top',
						classProgress: 'orange',
						message: 'Le format <code>.' + extImg + '</code> de image n\'est pas accepté ! Veuillez ajouter un fichier au format <code>.jpg</code>, <code>.jpeg</code> et <code>.png</code>.'
					});
			} else {
				$('#formulaireUploadPhoto').submit();
			}
		} else {
			$('body')
				.toast({
					title: 'Oups !',
					class: 'warning',
					displayTime: 'auto',
					showProgress: 'top',
					classProgress: 'orange',
					message: 'Il n\'y a aucune modification à sauvegarder'
				});
		}
	});

	$('#btnSupprVoiture').click(function() {
		$('#modalSupprVoiture').modal('show');
	});
	
	$('#confirmDeleteVoiture').click(function() {
		window.location.href = 'index.php?module=vehicule&action=delete';
	});


});

function checkImmatriculation(plaque) {
	var estValide = false;
	const regex = /[A-Z][A-Z](?:\-)[0-9][0-9][0-9](?:\-)[A-Z][A-Z]/;
	const str = plaque;
	let m;

	if ((m = regex.exec(str)) !== null) {
		m.forEach((match, groupIndex) => {
			estValide = true;
		});
	}
	return estValide;
}
