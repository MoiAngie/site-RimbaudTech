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

/* Pour la chatbox */
window.$crisp=[];
window.CRISP_WEBSITE_ID="cc672de0-4ec8-4d94-88d0-6bc39ed6b8f3";
(function(){d=document;s=d.createElement("script");
s.src="https://client.crisp.chat/l.js";
s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
