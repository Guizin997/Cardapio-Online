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
    const id = parentButton.getAttribute("data-id")
    // Adiciona ao carrinho passando a URL da imagem
    addToCart(id, img, name, price);
  }
});




//FUNÇÃO PARA ADICIONAR NO CARRINHO
function addToCart(id, img, name, price) {
  const hasItem = cart.find(item => item.id === id);

  if (hasItem) {
    hasItem.quantity += 1;
  } else {

    cart.push({
      id,
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

        <button class="remove-from-cart-btn bg-red-500 py-2 px-4 rounded text-white" data-name="${item.name}">
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
  if (!isOpen) {
    Toastify({
      text: "Ops, o Restaurante está fechado!",
      duration: 3000,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "right", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        background: "#ef4444",
      },
      onClick: function () { } // Callback after click
    }).showToast();
    return
  }
  // Verifica se há itens no carrinho
  if (cart.length === 0) {
    return;
  }

  // Verifica se o nome do usuário está preenchido
  const userName = document.getElementById('user-name').value.trim();
  if (userName === "") {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Por favor, digite seu nome!',
    });
    return;
  }

  // Seleciona os elementos de rádio e endereços
  const deliveryRadio = document.getElementById('delivery-radio');
  const pickupRadio = document.getElementById('pickup-radio');
  const addressInput = document.getElementById('address');
  const addressWarning = document.getElementById('address-warn');

  // Verifica se é para entrega ou retirada
  let orderDetails = "";
  if (deliveryRadio.checked) {
    // Verifica se o endereço está preenchido para entrega
    const deliveryAddressValue = addressInput.value.trim();
    if (deliveryAddressValue === "") {
      addressWarning.classList.remove("hidden");
      return;
    }
    orderDetails = `Endereço de entrega: ${deliveryAddressValue}`;
  } else if (pickupRadio.checked) {
    orderDetails = "Pedido para retirada na loja";
  } else {
    // Caso nenhum método de entrega esteja selecionado
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Selecione uma opção de entrega (Entrega ou Retirada)!',
    });
    return;
  }

  // Confirmação do pedido
  Swal.fire({
    title: "Confirmar Pedido",
    html: `Nome: ${userName}<br>${orderDetails}<br><br>Confirma o pedido?`,
    showCancelButton: true,
    confirmButtonText: `Confirmar`,
    cancelButtonText: `Cancelar`,
    icon: 'question',
  }).then((result) => {
    if (result.isConfirmed) {
      // Monta a mensagem do pedido para enviar via WhatsApp
      const cartItemsFormatted = cart.map((item) => {
        return `${item.name} - Quantidade: ${item.quantity} - Preço unitário: R$ ${item.price.toFixed(2)}`;
      }).join("\n");

      const message = encodeURIComponent(`Pedido de ${userName}:\n\n${cartItemsFormatted}\n\n${orderDetails}`);
      const phone = "+558894155531";

      // Abre a janela do WhatsApp com a mensagem do pedido
      window.open(`http://wa.me/${phone}?text=${message}`, "_blank");

      // Limpa o carrinho e fecha o modal
      cart = [];
      addressInput.value = "";
      cartModal.style.display = "none";
      readCartModal();

      // Feedback de sucesso
      Swal.fire({
        title: "Pedido realizado com sucesso!",
        text: "Acompanhe seu pedido pelo WhatsApp!",
        imageUrl: "https://i.ibb.co/M8Z78yM/sapiens.png",
        imageWidth: 400,
        imageHeight: 300,
        imageAlt: "Custom image",
        icon: 'success',
      });
    }
  });
});




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


const deliveryCheckbox = document.getElementById('delivery-checkbox');
const pickupCheckbox = document.getElementById('pickup-checkbox');
const deliveryAddress = document.getElementById('delivery-address');
const pickupAddress = document.getElementById('pickup-address');

// Mostra o campo de endereço de entrega quando o checkbox de entrega é selecionado
document.addEventListener('DOMContentLoaded', function () {
  const deliveryRadio = document.getElementById('delivery-radio');
  const pickupRadio = document.getElementById('pickup-radio');
  const deliveryAddress = document.getElementById('delivery-address');
  const pickupAddress = document.getElementById('pickup-address');

  // Mostra o campo de endereço de entrega quando o radio de entrega é selecionado
  deliveryRadio.addEventListener('change', function () {
    if (deliveryRadio.checked) {
      deliveryAddress.style.display = 'block';
      pickupAddress.style.display = 'none';
    }
  });

  // Mostra o campo de endereço da loja quando o radio de retirada é selecionado
  pickupRadio.addEventListener('change', function () {
    if (pickupRadio.checked) {
      pickupAddress.style.display = 'block';
      deliveryAddress.style.display = 'none';
    }
  });
});