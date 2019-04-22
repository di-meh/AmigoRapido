$(document).ready(function(){
	
	$('#carburant').dropdown({
		onChange: function () {
			$('.ui.dropdown#version').dropdown('clear');
		}
	}); 
	
	$('#categorie').dropdown({
	onChange: function (nomCategorie, text, $selectedItem) {
			$('.ui.dropdown#marque').dropdown('clear');

			var nomCategorie = nomCategorie;
				$.ajax({
					url:"ajax/marque.php",
					method: "POST",
					data:{nomCategorie:nomCategorie},
					dataType:"html",
					success: function(data){
						$('#marque-menu').html(data);

					},
				
				});
			
			
			
		},
	}); 
	 
	 	$('#modele').dropdown({
	 	allowAdditions: true,
		onChange: function (nomModele, text, $selectedItem) {
			$('.ui.dropdown#energie').dropdown('clear');
			
			var nomModele = nomModele;
			
			
			
			
			
			
			$.ajax({
				url:"ajax/carburant.php",
				method: "POST",
				data:{nomModele:nomModele},
				dataType:"html",
				success: function(data){
					$('#energie-menu').html(data);
				

				},
            
			});

			
			
		}
	}); 
	 
	 	$('#marque').dropdown({
	 		allowAdditions: true,
				
				onChange: function (nomMarque, text, $selectedItem) {
						$('.ui.dropdown#modele').dropdown('clear');
						$('.ui.dropdown#version').dropdown('clear');
						var nomCategorie = $('.ui.dropdown#categorie').dropdown('get value');
						var nomMarque = nomMarque;
						
						$.ajax({
							url:"ajax/modele.php",
							method: "POST",
							data:{nomMarque:nomMarque,
								  nomCategorie:nomCategorie		
							},
							dataType:"html",
							success: function(data){
								$('#modele-menu').html(data);

							},
					

						});
					
					
				}
            
	}); 
	
	
	
		$('#version').dropdown({
			allowAdditions: true,
		
	}); 
	 
	 		$('#etat').dropdown({
		onChange: function () {

		}
	}); 
	 

	 		$('#categorieR').dropdown({
		 onChange: function () {
          var categories = $('.ui.dropdown#categorieR').dropdown('get value');
          $('.ui.dropdown#marqueR').dropdown('clear');

              $.ajax({
                url:"ajax/marque.php",
                method: "POST",
                data:{
                    categories:categories   
                },
                dataType:"html",
                success: function(data){

                   $('#marqueR-menu').html(data);

                },
            

              });

             
        }
	}); 
	 
		$('#modeleR.dropdown').dropdown();

	 
	 	$('#marqueR').dropdown({
		 onChange: function () {
            var categories = $('.ui.dropdown#categorieR').dropdown('get value');
            var marques = $('.ui.dropdown#marqueR').dropdown('get value');
              
            $.ajax({
                url:"ajax/modele.php",
                method: "POST",
                data:{marques:marques,
                  categories:categories   
                },
                dataType:"html",
                success: function(data){
                  $('#modeleR-menu').html(data);
                },

             });   
          }
	}); 

	 		 	$('#carburantR').dropdown({
		onChange: function () {

		}
	}); 

});



