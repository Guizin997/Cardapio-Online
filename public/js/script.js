const menu = document.getElementById("menu");
const cartBtn = document.getElementById("cart-btn");
const cartModal = document.getElementById("cart-modal");
const cartItemsContainer = document.getElementById("cart-items");
const cartTotal = document.getElementById("cart-total");
const checkoutBtn = document.getElementById("checkout-btn");
const closeModalBtn = document.getElementById("close-modal-btn");
const cartCounter = document.getElementById("cart-count");
const addressInput = document.getElementById("address");
const addressWarning = document.getElementById("address-warn");

let cart = [];

//ABRIR O MODAL
cartBtn.addEventListener('click', function () {
  readCartModal()
  cartModal.style.display = "flex"
})


//FECHAR CLICANDO FORA
cartModal.addEventListener('click', function (e) {
  if (e.target === cartModal) {
    cartModal.style.display = "none"
  }
})


closeModalBtn.addEventListener('click', function () {
  cartModal.style.display = "none"
})


menu.addEventListener('click', function (e) {
  let parentButton = e.target.closest(".add-to-cart-btn");

  if (parentButton) {
    const name = parentButton.getAttribute('data-name');
    const price = parseFloat(parentButton.getAttribute('data-price'));
    const img = parentButton.getAttribute("data-image");

    // Adiciona ao carrinho passando a URL da imagem
    addToCart(img, name, price);
  }
});




//FUNÇÃO PARA ADICIONAR NO CARRINHO
function addToCart(img, name, price) {
  const hasItem = cart.find(item => item.name === name);

  if (hasItem) {
      hasItem.quantity += 1;
  } else {
    
      cart.push({
          img,
          name,
          price,
          quantity: 1,
      });
  }

  readCartModal();
}




function readCartModal() {
  cartItemsContainer.innerHTML = "";
  let total = 0;

  cart.forEach(item => {

    const cartItemElement = document.createElement("div");

    cartItemElement.classList.add("flex", "justify-between", "mb-4", "flex-col")

    cartItemElement.innerHTML = `
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <img height="60px" width="60px" src="${item.img}" alt="${item.name}" class="rounded-full">
            <div class="ml-4">
                <p class="font-bold">${item.name}</p>
                <p>Quantidade: ${item.quantity}</p>
                <p class="font-medium mt-2">R$ ${item.price.toFixed(2)}</p>
            </div>
        </div>

        <button class="remove-from-cart-btn" data-name="${item.name}">
            Remover
        </button>
    </div>
`;



    total += item.price * item.quantity



    cartItemsContainer.appendChild(cartItemElement)
  })

  cartTotal.textContent = total.toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL"
  })

  cartCounter.innerHTML = cart.length

}



//DELETE CART
cartItemsContainer.addEventListener("click", function (e) {
  if (e.target.classList.contains("remove-from-cart-btn")) {
    const name = e.target.getAttribute("data-name")

    removeItemCart(name)
  }
})

function removeItemCart(name) {
  const index = cart.findIndex(item => item.name === name);


  if (index !== -1) {
    const item = cart[index];
    if (item.quantity > 1) {
      item.quantity -= 1;
      readCartModal()
      return;
    } else {
      cart.splice(index, 1)
      readCartModal()
    }
  }
}


addressInput.addEventListener('input', function (e) {
  let inputValue = e.target.value;

  if (inputValue !== "") {
    addressWarning.classList.add("hidden")
  }
  //

})

//FINALIZAR PEDIDO
checkoutBtn.addEventListener('click', function () {

  const isOpen = checkOpenRestaurant();

  // if (!isOpen) {
  //   Toastify({
  //     text: "Ops, o Restaurante está fechado!",
  //     duration: 3000,
  //     close: true,
  //     gravity: "top", // `top` or `bottom`
  //     position: "right", // `left`, `center` or `right`
  //     stopOnFocus: true, // Prevents dismissing of toast on hover
  //     style: {
  //       background: "#ef4444",
  //     },
  //     onClick: function () { } // Callback after click
  //   }).showToast();
  //   return
  // }

  if (cart.length === 0) {
    return;
  }
  if (addressInput.value === "") {
    addressWarning.classList.remove("hidden")
    // addressInput.classList.add('border', 'border-[red]');
    return;
  }

  //ENVIAR PARA O ZIPZOP
  const cartItemsFormatted = cart.map((item) => {
    return `${item.name} - Quantidade: ${item.quantity} - Preço unitário: ${item.price}`;
  }).join("\n");

  const message = encodeURIComponent(cartItemsFormatted);
  const phone = "+558894155531";

  window.open(`http://wa.me/${phone}?text=${message} Endereço: ${addressInput.value}`, "_blank");

  cart = [];
  addressInput.value = "";
  readCartModal()


})



function checkOpenRestaurant() {
  const data = new Date();
  const hora = data.getHours();
  return hora >= 18 && hora < 20 //true -> open
}

const spanItem = document.getElementById("date-span");
const isOpen = checkOpenRestaurant()

if (isOpen) {
  spanItem.classList.remove('bg-red-500')
  spanItem.classList.add('bg-green-600')
} else {
  spanItem.classList.remove('bg-green-600')
  spanItem.classList.add('bg-red-500')
}


