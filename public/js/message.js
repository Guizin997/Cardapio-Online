Toastify({
  text: "Produto adicionado no Cardapio",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "#63783D",
  },
  onClick: function () { } // Callback after click
}).showToast();


