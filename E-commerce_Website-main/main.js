

// Mobile Nav

const side_menu = document.querySelector(".side_menu");
const Nav = document.querySelector(".mob_nav");

side_menu.addEventListener("click", () => {
  Nav.classList.toggle(".display_none");
});


if (hamburger) {
  hamburger.addEventListener("click", () => {
    Nav.classList.toggle("display_none");
  });
};
