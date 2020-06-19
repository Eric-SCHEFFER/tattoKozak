// ===== GESTION DE L'AFFICHAGE DU MENU BURGER =====

// ========== FONCTIONS ==========


// ===== AFFICHE OU MASQUE LE MENU, AU CLIC DU BURGER =====
function appuiIconeBurger() {
   oMenu.className = "menuBurger"; // On affecte une class au menu
   let oPos = window.getComputedStyle(oMenu, null).getPropertyValue("left"); // recup valeur de left (style)

 // On décale le menu pour le faire apparaitre ou disparaitre, selon son état
   if (oPos === "-150px") {
      oMenu.style.left = "0px";
      oNavbar.style.overflow = "visible"; // Pour que le menu sorte de la navbar
      oBody.style.overflow = "hidden"; // plus de scroll
      oBody.style['pointer-events'] = "none"; // On désactive le clic partout
      oBurger.style['pointer-events'] = "initial"; // On réactive le clic pour le burger
      oMenu.style['pointer-events'] = "initial"; // On réactive le clic pour le Menu
      oBody2.style.visibility = "visible"; // On active la div body2 qui assombrit l'écran
      
      // Les transitions d'ouverture
      oburgerBarre1.style.transform = "rotate(45deg)";
      oburgerBarre1.style.top = "22px";
      oburgerBarre2.style.left = "80px";
      oburgerBarre3.style.transform = "rotate(-45deg)";
      oburgerBarre3.style.top = "22px";
      oBody2.style['background-color'] = "rgba(0, 0, 0, .5)"; // On assombrit l'écran
      // Bizarre, la transition ne fonctionne qu'une fois
   }
   // Sinon, on bascule sur celle du grand écran (le menu se referme)
   else {
      closeMenuBurger();
   }
}



// ===== MASQUE LE MENU BURGER =====
function closeMenuBurger() {
   oNavbar.style.overflow = "hidden";
   oBody.style.overflow = "auto";
   oBody.style['pointer-events'] = "initial"; // On réactive le clic partout
   oBody2.style['background-color'] = "initial"; // On ré-eclairci l'écran

   // Les transitions de fermeture
   oMenu.style.left = "-150px";
   oburgerBarre1.style.transform = "rotate(0)";
   oburgerBarre1.style.top = "14px";
   oburgerBarre2.style.left = "10px";
   oburgerBarre3.style.transform = "rotate(0)";
   oburgerBarre3.style.top = "32px";
   setTimeout(closeMenuBurgerSuite, 300); // Attends la fin de la transition avant de virer la class
   // ============== //
   
}
function closeMenuBurgerSuite() {
   oMenu.className = "menu";
   oBody2.style.visibility = "hidden"; // On désactive la div body2 pour ré-eclaircir l'écran
}





// ====================== PROGRAMME PRINCIPAL =========================

let oMenu = document.getElementById("menuId");
let oBurger = document.getElementById("burger");
let oNavbar = document.getElementById("nav");
let oburgerBarre1 = document.getElementById("burgerBarre1");
let oburgerBarre2 = document.getElementById("burgerBarre2");
let oburgerBarre3 = document.getElementById("burgerBarre3");
let oBody = document.getElementById("bodyId");
let oBody2 = document.getElementById("body2");


// ==== ON ECOUTE SI ON CLIQUE SUR LE BURGER ====
document.getElementById("burger").addEventListener("click", appuiIconeBurger);


// ==== ON DETECTE LE CLIC AILLEURS QUE SUR LE BURGER, POUR FERMER LE MENUBURGER ====
document.addEventListener('click', function (event) {
   let onCliqueDedans = oBurger.contains(event.target);
   if (!onCliqueDedans && oMenu.className === "menuBurger") {
      closeMenuBurger();
   }
});

