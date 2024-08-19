const buttonsWrapper = document.querySelector(".map");
const slides = document.querySelector(".avis-carousel");

buttonsWrapper.addEventListener("click", e => {
  if (e.target.nodeName === "BUTTON") {
    Array.from(buttonsWrapper.children).forEach(item =>
      item.classList.remove("active")
    );
    
    if (e.target.classList.contains("first")) {
      slides.style.transform = "translateX(-0%)";
      e.target.classList.add("active");
    } else if (e.target.classList.contains("second")) {
      slides.style.transform = "translateX(-100%)";
      e.target.classList.add("active");
    }
  }
});

setInterval(() => {
  const activeButton = document.querySelector(".map button.active");
  const nextButton = activeButton.nextElementSibling || buttonsWrapper.firstElementChild;
  nextButton.click();
}, 5000); // 3 seconds

// Get modal element
const modal = document.getElementById("avis-modal");
// Get open modal button
const openModalBtn = document.getElementById("open-modal-btn");
// Get close button
const closeBtn = document.getElementsByClassName("close")[0];

// Listen for open click
openModalBtn.addEventListener("click", () => {
    modal.style.display = "block";
});

// Listen for close click
closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Listen for outside click
window.addEventListener("click", (e) => {
    if (e.target == modal) {
        modal.style.display = "none";
    }
});
