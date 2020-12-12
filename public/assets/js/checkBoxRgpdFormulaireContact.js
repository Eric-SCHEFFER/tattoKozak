window.onload = () => {
   let caseACocher = document.getElementById("accordDonneesPerso");
   let boutonSubmit = document.getElementById("contact_envoyer");

   caseACocher.checked = false;
   boutonSubmit.disabled = true;

   // Bascule: Active/désactive le bouton submit selon que la case d'acceptation de collecte des données est cochée ou non.
   caseACocher.addEventListener('change', function () {
      if (this.checked) {
         boutonSubmit.className = "buttonEnabled";
         //document.getElementById("contact_envoyer").setAttribute("enabled", "enabled");
         boutonSubmit.disabled = false;

      } else {
         boutonSubmit.className = "buttonDisabled";
         boutonSubmit.disabled = true;


      }
   });
   boutonSubmit.addEventListener('click', function () {
      alert("clic sur envoyer");

   });

}
