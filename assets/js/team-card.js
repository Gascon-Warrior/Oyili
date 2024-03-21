document.addEventListener("DOMContentLoaded", function () {
  var hauteurPage = document.body.scrollHeight;
  var pageOverlay = document.getElementById("pageOverlay");
  var containers = document.querySelectorAll(".imgContainer"); // Assurez-vous que cette sélection est correcte

  containers.forEach(function (cont) {
    cont.addEventListener("click", function () {
      // Met à jour la hauteur de pageOverlay avec la hauteur totale de la page
      pageOverlay.style.height = hauteurPage + "px";

      // Remonte jusqu'au parent .teamCard commun
      let teamCard = cont.closest(".teamCard");
      // Sélectionne .imgWork et .bio à l'intérieur du teamCard spécifique
      let imgWork = teamCard.querySelector(".imgWork");
      let bio = teamCard.querySelector(".bio");
      let btnClose = teamCard.querySelector(".btnClose");

      // Vérifie si imgWork existe, puis ajoute ou supprime des classes
      if (imgWork) {
        imgWork.classList.add("z-70");
      }
      if (btnClose) {
        btnClose.classList.remove("hidden");
      }

      // Vérifie si bio existe, puis modifie ses classes pour le rendre visible
      if (bio) {
        bio.classList.remove("hidden");
        bio.classList.add("block");
      }
    });
  });
});

// Gestionnaire d'événements pour btnClose
document.querySelectorAll(".btnClose").forEach(function (btn) {
  btn.addEventListener("click", function () {
    // Cache le pageOverlay en réinitialisant la hauteur
    pageOverlay.style.height = "0";

    // Remonte jusqu'au parent .teamCard commun
    let teamCard = btn.closest(".teamCard");

    // Sélectionne .imgWork, .bio, et .btnClose à l'intérieur du teamCard spécifique
    let imgWork = teamCard.querySelector(".imgWork");
    let bio = teamCard.querySelector(".bio");

    // Réinitialise les classes de imgWork, bio, et btnClose pour revenir à l'état initial
    if (imgWork) {
      imgWork.classList.remove("z-70");
    }
    if (bio) {
      bio.classList.add("hidden");
      bio.classList.remove("block");
    }
    btn.classList.add("hidden");
  });
});
