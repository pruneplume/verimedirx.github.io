
let userdata = {
    user_id: localStorage.getItem( 'user_id') || "null",
    user_number: localStorage.getItem( 'user_number') || "null",
    user_email: localStorage.getItem( 'user_email') || "null",
    valid: localStorage.getItem( 'valid') || "null",
    timeout: localStorage.getItem( 'timeout') || "null"
};



console.log("user_id: %s", userdata.user_id);
if (userdata.user_id === null) {
    document.getElementById("user_id").innerHTML = userdata.user_id;
} else {
  document.getElementById("user_id").innerHTML = '<a href="sign_up.html" class="nav_link" id = "user_id">Sign Up</a>';
}



// Cart Menu- Add to cart
const AddCart = document.querySelectorAll(".add_cart, .add_cart_2");
const quantity = document.querySelectorAll(".add_quantity");
AddCart.forEach((button) => {
  button.addEventListener("click", () => {
    const product_number = button.getAttribute("product_number");
    const product_name = button.getAttribute("product_name");
    const product_image = button.getAttribute("product_image");
    const product_price= button.getAttribute("product_price");
    const add_quantity = quantity[0].value || 1;;
    const cart_item = {product_number,product_name,product_image,product_price, quantity: add_quantity};
    const cart = JSON.parse(localStorage.getItem('cart_temp')) || null;
    cart.push(cart_item);
    localStorage.setItem("cart_temp",JSON.stringify(cart));
  });
});