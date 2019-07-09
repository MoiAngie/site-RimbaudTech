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
