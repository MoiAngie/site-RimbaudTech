/* Fonction qui permet l'apparition du bouton responsive de la navbar */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}


/* pour le back to top */

document.addEventListener('DOMContentLoaded', function () {
          window.onscroll = function (ev) {
              document.getElementById("cRetour").className = (window.pageYOffset > 100) ? "cVisible" :
                  "cInvisible";
          };
      });

      $('#sidebarCollapse').click(function (e) {
          e.preventDefault();
          $('#sidebar').toggleClass('active');
      })

      function openModal() {
          document.getElementById("modal").style.top = "0px";
      }

      function closeModal() {
          document.getElementById("modal").style.top = "-780px";
      }


/* pour le collapse des articles  */

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

/*  pour le preloader */

$(document).ready(function(){
   $('.loader').fadeOut(5000);
});
