

// Mobile Nav
const hamburger = document.querySelector(".hamburger");
const Nav = document.querySelector(".mob_nav");

hamburger.addEventListener("click", () => {
  Nav.classList.toggle("mob_hidden");
});

// Cart Menu- Add to cart
const AddCart = document.querySelectorAll(".add_cart");

AddCart.forEach((button) => {
  button.addEventListener("click", () => {
    const id = button.getAttribute("data-id");
    const title = button.getAttribute("data-title");
    const image = button.getAttribute("data-image");
    const  price= button.getAttribute("data-price");

    const cartItem = {id,title,image,price};
    const cart = JSON.parse(localStorage.getItem('cart'))|| [];
    cart.push(cartItem);
    localStorage.setItem("cart",JSON.stringify(cart));
  });
});
