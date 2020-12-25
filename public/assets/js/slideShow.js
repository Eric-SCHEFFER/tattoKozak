

   let slideIndex = 1;
   showSlides(slideIndex);

   // Next/previous controls
   function plusSlides(n) {
      showSlides(slideIndex += n);
   }

   // Thumbnail image controls
   function currentSlide(n) {
      showSlides(slideIndex = n);
   }

   function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("realisation-image");
      let bullets = document.getElementsByClassName("bullet");
      if (n > slides.length) { slideIndex = 1 }
      if (n < 1) { slideIndex = slides.length }
      for (i = 0; i < slides.length; i++) {
         slides[i].style.display = "none";
      }
      for (i = 0; i < bullets.length; i++) {
         bullets[i].className = bullets[i].className.replace(" actif", "");
      }
      slides[slideIndex - 1].style.display = "block";
      bullets[slideIndex - 1].className += " actif";
   }






