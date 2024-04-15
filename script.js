// script.js
let cart = [];
let total = 0;

function addToCart(itemName, itemPrice) {
  cart.push({ name: itemName, price: itemPrice });
  total += itemPrice;

  updateCart();
}

function updateCart() {
  const cartList = document.getElementById('cart-list');
  const totalElement = document.getElementById('total');

  // Clear existing items
  cartList.innerHTML = '';

  // Populate cart list
  cart.forEach(item => {
    const listItem = document.createElement('li');
    listItem.textContent = `${item.name} - $${item.price.toFixed(2)}`;
    cartList.appendChild(listItem);
  });

  // Update total
  totalElement.textContent = `Total: $${total.toFixed(2)}`;
}
