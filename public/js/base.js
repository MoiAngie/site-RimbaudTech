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
