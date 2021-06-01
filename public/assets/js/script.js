$(document).ready(function () {
  // Faire disparaitre le footer au scroll

  $(window).scroll(() => {
    $("#footerCop").attr("id", "noFooter");
    if ($(window).scrollTop() == 0) {
      $("#noFooter").attr("id", "footerCop");
    }
  });

  // Au click sur les infos on fait aussi disparaitre le footer
  $("#fuckBtn").click(() => {
    $("#footerCop").toggleClass("hideFooter");
  });

  // CARROUSEL

  let carrousel = $("#carrousel"), // on cible le bloc du carrousel
    img = $("#carrousel img"), // on cible les images contenues dans le carrousel
    indexImg = img.length - 1, // on définit l'index du dernier élément
    i = 0, // on initialise un compteur
    currentImg = img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
  let carrouselDot = $("#carrousel i");
  let currentDot = carrouselDot.eq(i);

  img.css("display", "none"); // on cache les images
  currentImg.css("display", "block"); // on affiche seulement l'image courante

  currentDot.removeClass("far");
  currentDot.addClass("fas");

  carrousel.append(
    '<div class="controls"> <span class="prev"><i class="fas fa-angle-left"></i></span> <span class="next"><i class="fas fa-angle-right"></i></span> </div>'
  );

  $(".next").click(function () {
    // image suivante

    i++; // on incrémente le compteur

    if (i <= indexImg) {
      img.css("display", "none"); // on cache les images
      currentImg = img.eq(i); // on définit la nouvelle image
      currentImg.css("display", "block"); // puis on l'affiche
      carrouselDot.removeClass("fas");
      carrouselDot.addClass("far");
      currentDot = carrouselDot.eq(i);
      currentDot.addClass("fas");
    } else {
      i = -1;
    }
  });

  $(".prev").click(function () {
    // image précédente

    i--; // on décrémente le compteur, puis on réalise la même chose que pour la fonction "suivante"

    if (i >= 0) {
      img.css("display", "none");
      currentImg = img.eq(i);
      currentImg.css("display", "block");

      //
      carrouselDot.removeClass("fas");
      carrouselDot.addClass("far");
      currentDot = carrouselDot.eq(i);
      currentDot.addClass("fas");
    } else {
      i = indexImg + 1;
    }
  });

  function slideImg() {
    setTimeout(function () {
      // on utilise une fonction anonyme

      if (i < indexImg) {
        // si le compteur est inférieur au dernier index
        i++; // on l'incrémente
      } else {
        // sinon, on le remet à 0 (première image)
        i = 0;
      }

      img.css("display", "none");

      currentImg = img.eq(i);
      currentImg.css("display", "block");
      carrouselDot.removeClass("fas");
      carrouselDot.addClass("far");
      currentDot = carrouselDot.eq(i);
      currentDot.addClass("fas");

      slideImg(); // on oublie pas de relancer la fonction à la fin
    }, 7500); // on définit l'intervalle à 7000 millisecondes (7s)
  }

  slideImg(); // enfin, on lance la fonction une première fois

  //   SUITE
});
