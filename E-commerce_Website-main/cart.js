

let cart = JSON.parse(localStorage.getItem("cart_temp")) || [];
let cartTotal = 0;
let count = 0;

function displayCartItems() {

  const CartItems = document.querySelector(".order_table-item");
  count = 0;

  CartItems.innerHTML = "";
  
  if (cart.length == null ) {
    CartItems.innerHTML = "<p class=\"order_table_item\">Your cart is empty.</p>";
  } else {
    cart.forEach((item) => {
      count += 1;
      const cartItem = document.createElement("div");
      cartItem.className = "order_table_item";
      cartItem.innerHTML = `
      <p class="">${count}</p>
      <p class="product_name">${item.product_name}</p>
      <img src="${item.product_image}" alt="${item.product_name}" class="order_item_img" />
      <p class="">${item.quantity}</p>
      <p class="product_price">${item.product_price}</p>
      <button class="cart_delete add_cart_2" onclick="deleteCartItem(${cart.indexOf(item)})">Delete</button>
      `;
      CartItems.appendChild(cartItem);
      cartTotal += item.product_price * item.quantity;
    });
  }
  document.querySelector(".cart_total").textContent = `Total: $${cartTotal.toFixed(2)}`;
}


displayCartItems();


function check_out() {

  cartTotal = cart.reduce((sum, item) => sum + (Number.parseFloat(item.product_price) || 0) * item.quantity, 0);

  if (cart.length === 0) {
    alert('Your cart is empty.');
    return;
  }

  const cart_data = {
    user_number: userdata.user_number,
    user_id: userdata.user_id,
    cart: cart
  };

  fetch( 'cart.php', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json'
    },
    body: JSON.stringify(cart_data)
  })
  .then( response => response.json())
  .then( data => {
    console.log('Response:', data);
    // Store the received data

    if (data.success) {
      localStorage.removeItem('cart');
      globalThis.location.href = "order_finish.html?user_id=" + userdata.user_id + "&user_number=" + encodeURIComponent(userdata.user_number) + "&user_email=" + userdata.user_email + "&valid=" + userdata.valid + "&timeout=" + userdata.timeout;
    } else {
      alert(data.error || 'Failed to save the cart.');
    }
  })
  .catch(error => console.error( 'cart fetch Error:', error));

}

function deleteCartItem(index) {
  cart.splice(index, 1);
  localStorage.setItem("cart_temp", JSON.stringify(cart));
  displayCartItems();
}