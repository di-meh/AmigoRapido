$(document).ready(function() {
  var today = new Date();
  $(".ui.checkbox").checkbox();
  $("#checkboxCoupon").checkbox({
    onChecked: function() {
      //cacher le date + mettre estAuto à 1
      $("#dateCoupon").transition("fade up");
      $("input[name=estAuto]").val("1");
    },
    onUnchecked: function() {
      $("#dateCoupon").transition("fade up")();
      $("input[name=estAuto]").val("0");
    }
  });

  $("#dateCoupon").calendar({
    type: "date",
    minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
    ampm: false,
    text: {
      days: ["D", "L", "M", "M", "J", "V", "S"],
      months: [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Decembre"
      ],
      monthsShort: [
        "Jan",
        "Fev",
        "Mar",
        "Avr",
        "Mai",
        "Juin",
        "Juil",
        "Aou",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ],
      today: "Aujourd'hui",
      now: "Maintenant"
    }
  });
  $("#emaildrop").dropdown({
    // minValues: 3,
    // clearable: true
  });
  // $("#emaildrop").change(function() {
  //     console.log("FUCK");
  // });
  $("#inputPourcentageCoupon").dropdown({
    clearable: true
  });

  // $("#formRecherchUser").submit(function () {
  //   // $.ajax({
  //   //   url: "index.php?module=admin&action=afficherUtilisateur",
  //   //   type: "POST",
  //   //   data: {
  //   //     emailUser: $("#emaildrop").val()
  //   //   },
  //   //   success: function() {
  //   //     console.log("SEXEEEIZJDIJZDJ");
  //   //   }
  //   // });
  // });

  $("#trajetsButton").click(function() {});
  $("#delUser").click(function() {
    if (
      confirm(
        "Êtes-vous sûr.e de vouloir supprimer cet utilisateur définitivement de la base de données ?"
      )
    ) {
      confirm("Sûr.e et certain.e ?");
    }
  });
  $("#delTrajet").click(function() {
    if (
      confirm(
        "Êtes-vous sûr.e de vouloir supprimer ce trajet définitivement de la base de données ?"
      )
    ) {
      confirm("Sûr.e et certain.e ?");
    }
  });
});
