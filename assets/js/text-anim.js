document.addEventListener("DOMContentLoaded", function () {
    const contactText = document.getElementById("contactText");
  
    contactText.addEventListener("mouseenter", function () {
      const letters = contactText.querySelectorAll(".char");
  
      letters.forEach((letter, index) => {
        letter.style.animation = "animBtnContact 0.5s steps(6) infinite";
        letter.style.animationDelay = `${index * 0.0833}s`;
      });
    });
  
    contactText.addEventListener("mouseleave", function () {
      const letters = contactText.querySelectorAll(".char");
  
      letters.forEach((letter) => {
        letter.style.animation = "none";
      });
    });
  });
  

  document.addEventListener("DOMContentLoaded", function () {
    const contactText = document.getElementById("contactTextFooter");
  
    contactText.addEventListener("mouseenter", function () {
      const letters = contactText.querySelectorAll(".char");
  
      letters.forEach((letter, index) => {
        letter.style.animation = "animBtnContact 0.5s steps(6) infinite";
        letter.style.animationDelay = `${index * 0.0833}s`;
      });
    });
  
    contactText.addEventListener("mouseleave", function () {
      const letters = contactText.querySelectorAll(".char");
  
      letters.forEach((letter) => {
        letter.style.animation = "none";
      });
    });
  });
  