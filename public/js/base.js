



      /* Fonction qui permet l'apparition du bouton responsive de la navbar */
      function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        } else {
          x.className = "topnav";
        }
      }

/* pour le collapse des articles*/

      var coll = document.getElementsByClassName("collapsible");
      var i;

      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.maxHeight){
            content.style.maxHeight = null;
          } else {
            content.style.maxHeight = content.scrollHeight + "px";
          }
        });
      }

      /* pour le back to top */
      // le btn s'affiche dès que l'utilisateur a scrollé de 100px
      window.onscroll = function() {scrollFunction()};

      function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      // Action on-click pour retour au top
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }

/*  pour le preloader */

//$(document).ready(function(){
  // $('.loader').fadeOut(5000);
//});

//var preloader =
//document.getElementById("preloader");

//window.addEventListener('load', function()
//{
  //preloader.style.display = 'none';
//})
