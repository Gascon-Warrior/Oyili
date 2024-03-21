let teamItem = document.querySelectorAll(".team-item");
let bgContainers = document.querySelectorAll(".bg-container");

//Récupère la largeur d'un element pour définir sa hauteur
function adjustContainerHeight() {
  bgContainers.forEach((container) => {
    var containerWidth = container.offsetWidth;
    container.style.height = containerWidth + "px";
  });
}
// Rappel de la fonction pour ajuster la hauteur au chargement
window.addEventListener("load", adjustContainerHeight);
// Rappel de la fonction pour ajuster la hauteur au redimmensionnement de la fenetre
window.addEventListener("resize", adjustContainerHeight);

//************************************************************************************ */

let loisir = document.querySelector(".loisir");
let travail = document.querySelector(".travail");
let container = document.querySelector(".imgContainer");
let all = document.querySelectorAll(".team-item");
let containers = document.querySelectorAll(".imgContainer");

loisir.addEventListener("click", function () {
  travail.classList.remove("bg-black", "text-white");
  travail.classList.add("text-black");
  loisir.classList.remove("text-white");
  loisir.classList.add("bg-black", "text-white");

  all.forEach((card) => {
    let bgWrap = card.querySelector(".bg-wrap");
    bgWrap.classList.add("animate-slide-left");
    bgWrap.classList.remove("animate-slide-right");
  });
});

travail.addEventListener("click", function () {
  loisir.classList.remove("bg-black", "text-white");
  loisir.classList.add("text-black");

  travail.classList.remove("text-white");
  travail.classList.add("bg-black", "text-white");

  all.forEach((card) => {
    let bgWrap = card.querySelector(".bg-wrap");
    bgWrap.classList.add("animate-slide-right");
    bgWrap.classList.remove("animate-slide-left");
  });
});

//************************************************************************************ */

let teamItems = document.querySelectorAll(".team-item");
let hauteurPage = document.body.scrollHeight;
var pageOverlay = document.getElementById("pageOverlay");

teamItems.forEach((teamItem) => {
  let itemWrap = teamItem.querySelector(".item-wrap");
  let bio = teamItem.querySelector(".bio");
  let btnClose = teamItem.querySelector(".btn-wrap");
  let bgContainer = teamItem.querySelector(".bg-container");
  //Affiche le texte de presentation, l'overlay et le bouton pour fermer
  itemWrap.addEventListener("click", function () {
    bio.style.opacity = 1;
    btnClose.style.opacity = 1;
    pageOverlay.style.height = hauteurPage + "px";
    bgContainer.style.zIndex = "50";
  });
  //Masque le texte de presentation, l'overlay et le bouton pour fermer
  btnClose.addEventListener("click", function () {
    bio.style.opacity = 0;
    btnClose.style.opacity = 0;
    pageOverlay.style.height = "0";
    bgContainer.style.zIndex = "auto";
  });
});

//************************************************************************************ */

let bgWraps = document.querySelectorAll(".bg-wrap");
let bgNormals = document.querySelectorAll(".bg-normal");
let bgAlts = document.querySelectorAll(".bg-alt");

let btnTravail = document.querySelector("#travail");
let btnLoisir = document.querySelector("#loisir");

document.addEventListener("DOMContentLoaded", function () {
  var teamItems = document.querySelectorAll(".team-item");
  //Affiche la bio a gauche pour les elements en bout de ligne
  teamItems.forEach(function (item, index) {
    var bio = item.querySelector(".bio");

    // Vérifie si l'index de l'élément est un multiple de trois (0, 3, 6, etc.)
    if ((index + 1) % 3 === 0) {
      bio.style.right = "100%";
      bio.style.left = "auto";
    }
  });
});
