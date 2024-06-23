<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cardapio - Online</title>
</head>

<body>



    {{-- CABEÇALHO --}}
    <header class="w-full h-[420px] bg-zinc-900 bg-home bg-cover bg-center">
        <div class="w-full h-full flex flex-col justify-center items-center">
            <img src="{{ asset('assets/hamb-1.png') }}" alt="Logo"
                class="w-32 h-32 rounded-full shadow-lg hover:scale-110 duration-200">
            <h1 class="text-4xl mt-4 mb-2 font-bold text-white">Hamburgueria do VT</h1>

            <span class="text-white font-medium">Rua da tal, Multirao Russas</span>

            <div class="bg-green-600 px-4 py-1 rounded-lg mt-5" id="date-span">
                <span class="text-white font-medium">Seg á Dom - 18:00 as 20:00</span>
            </div>

        </div>
    </header>
    {{-- CABEÇALHO FIM --}}

    <h2 class="text-2xl md:text-3xl font-bold text-center mt-9 mb-6">
        Conheça nosso Menu
    </h2>

    @if (Auth::id() === 1)
        <div class="flex gap-4 items-center justify-center">
            <div class="flex items-center justify-center mb-6">
                <button
                    class="flex items-center gap-2 font-bold text-white bg-green-600 px-4 py-2 rounded-lg hover:bg-green-700"
                    id="open-modal-btn">
                    Adicione Produtos
                    <i class="fas fa-plus text-lg text-white"></i>
                </button>
            </div>
            <div class="flex items-center justify-center mb-6">
                <button
                    class="flex items-center gap-2 font-bold text-white bg-green-600 px-4 py-2 rounded-lg hover:bg-green-700"
                    id="open-modal-btn">
                    Adicione Bebidas
                    <i class="fas fa-plus text-lg text-white"></i>
                </button>
            </div>
        </div>
    @endif

    {{-- INICIO DO MENU --}}
    <div id="menu">
        <main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 md:gap-10 mx-auto max-w-7xl px-2 mb-16">

            {{-- PRODUTO ITEM --}}
            @foreach ($produtos as $p)
                <div class="flex gap-2">
                    <img src="{{ asset($p->image) }}" alt="Hamburguer Tal"
                        class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">

                    <div>
                        <p class="font-bold whitespace-nowrap">
                            {{ $p->name }}
                        </p>
                        <p class="text-sm">
                            {{ $p->description }}
                        </p>


                        <div class="flex items-center gap-3 mt-3">
                            <p class="font-bold text-lg">R$ {{ $p->price }}</p>
                            <button class="bg-gray-900 px-5 rounded add-to-cart-btn" data-name="{{ $p->name }}"
                                data-price="{{ $p->price }}" data-image="{{ asset($p->image) }}"
                                data-id="{{ $p->id }}">
                                <i class="fa fa-cart-plus text-lg text-white"></i>
                            </button>
                        </div>
                        @if (Auth::id() === 1)
                            <button class="bg-red-500 px-3 py-1 rounded text-white delete-product-btn">
                                Tirar do Cardapio
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
            {{-- FIM PRODUTO 1 --}}
        </main>

        <div class="mx-auto max-w-7xl px-2 my-2">
            <h2 class="font-bold text-3xl">
                Bebidas
            </h2>
        </div>

        {{-- GRID BEBIDAS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-7 md:gap-10 mx-auto max-w-7xl px-2 mb-16" id="menu">
            {{-- BEBIDA-1 --}}
            <div class="flex gap-2 w-full">
                <img src="{{ asset('/assets/refri-1.png') }}" alt="Coca-Lata"
                    class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">

                <div class="w-full">
                    <p class="font-bold">
                        Coca Lata
                    </p>
                    {{-- <p class="text-sm">
                        Um hambúrguer leve e saboroso com um pão macio e dourado, preparado com filé de frango grelhado.
                    </p> --}}

                    <div class="flex items-center gap-2 justify-between mt-3">
                        <p class="font-bold text-lg">R$ 6.00</p>
                        <button class="bg-gray-900 px-5 rounded add-to-cart-btn" data-name="Coca Lata" data-price="6.00"
                            data-image="{{ asset('/assets/refri-1.png') }}">
                            <i class="fa fa-cart-plus text-lg text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{-- FIM BEBIDA-1 --}}

            {{-- BEBIDA-2 --}}
            <div class="flex gap-2 w-full">
                <img src="{{ asset('/assets/refri-2.png') }}" alt="Coca-Lata"
                    class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">

                <div class="w-full">
                    <p class="font-bold">
                        Guarana Lata
                    </p>
                    {{-- <p class="text-sm">
                        Um hambúrguer leve e saboroso com um pão macio e dourado, preparado com filé de frango grelhado.
                    </p> --}}

                    <div class="flex items-center gap-2 justify-between mt-3">
                        <p class="font-bold text-lg">R$ 6.00</p>
                        <button class="bg-gray-900 px-5 rounded add-to-cart-btn" data-name="Guarana Lata"
                            data-price="6.00" data-image="{{ asset('/assets/refri-2.png') }}">
                            <i class="fa fa-cart-plus text-lg text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{-- FIM BEBIDA-2 --}}
        </div>
        {{-- FIM GRID BEBIDAS --}}

    </div>
    {{-- FIM DO MENU --}}


    {{-- MODAL DO CARRINHO --}}
    <div id="cart-modal" class="bg-black/60 w-full h-full fixed top-0 left-0 z-[99] items-center justify-center hidden">
        <div class="bg-white p-5 rounded-md min-w-[90%] md:min-w-[600px]">
            <h2 class="text-center font-bold text-2xl mb-2">
                Meu Carrinho
            </h2>

            {{-- OS ITENS DO CARRINH VAO FICAR AKI --}}
            <div id="cart-items" class="flex justify-between mb-2 flex-col"></div>
            {{-- FIM OS ITENS DO CARRINH VAO FICAR AKI --}}

            <p class="font-bold mt-4">Total: <span id="cart-total">0.00</span></p>

            {{-- Adicionando nome do usuário --}}
            <label for="user-name" class="font-bold">Nome<span class="text-red-500">*</span></label>
            <input type="text" name="user-name" id="user-name" placeholder="Digite seu nome completo"
                class="w-full border-2 p-1 rounded my-1">

            {{-- Checkbox para seleção de entrega ou retirada --}}
            <div class="flex items-center my-3">
                <input type="radio" id="delivery-radio" name="delivery-option" class="mr-2" value="delivery">
                <label for="delivery-radio">Entrega</label>
                <input type="radio" id="pickup-radio" name="delivery-option" class="ml-4 mr-2" value="pickup">
                <label for="pickup-radio">Retirada</label>
            </div>

            {{-- Campo para mostrar endereço de entrega ou loja --}}
            <div id="delivery-address" class="hidden" class="mb-2">
                <label for="address" class="font-bold">Endereço de Entrega<span
                        class="text-red-500">*</span></label>
                <input type="text" name="address" id="address" placeholder="Digite seu endereço completo"
                    class="w-full border-2 p-1 rounded my-1">
                <p class="text-red-500 hidden" id="address-warn">Digite seu endereço completo!</p>
            </div>
            <div id="pickup-address" class="hidden">
                <p class="font-bold">Endereço da Loja:</p>
                <p>Rua tal canto tal.</p>
            </div>

            <div class="flex items-center justify-between mt-5 w-full">
                <button id="close-modal-btn">Fechar</button>
                <button id="checkout-btn" class="bg-green-500 text-white px-4 py-1 rounded">Finalizar Pedido</button>
            </div>
        </div>
    </div>

    {{-- FIM MODAL CARRINHO --}}


    {{-- FOOTER DE CARRINHO --}}

    <footer class="w-full bg-red-500 py-2 fixed bottom-0 z-40 flex items-center justify-center">
        <button class="flex items-center gap-2 font-bold text-white" id="cart-btn">
            (<span id="cart-count">0</span>)
            Veja seu CARRINHO
            <i class="fa fa-cart-plus text-lg text-white"></i>
        </button>
    </footer>

    {{-- <footer class="w-full bg-green-600 py-2 fixed bottom-10 z-40 flex items-center justify-center">
            <button class="flex items-center gap-2 font-bold text-white" id="open-modal-btn">
                Adicione produtos
                <i class="fas fa-plus text-lg text-white"></i>
            </button>
        </footer> --}}


    {{-- FIM FOOTER DE CARRINHO --}}

    {{-- MODAL ADD PRODUTOS --}}
    <div id="add-product-modal"
        class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden bg-black bg-opacity-50 z-50">
        <!-- Modal conteúdo -->
        <div class="bg-white rounded-lg overflow-hidden w-full max-w-md mx-auto p-6">
            <!-- Título do Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Adicionar Novo Produto</h2>
                <!-- Botão para fechar o modal -->
                <button id="cancel-add-x-btn" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Formulário -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Campo de upload de imagem -->
                <div class="mb-4">
                    <label for="product-image" class="block text-sm font-medium text-gray-700">Imagem do
                        Produto</label>
                    <input type="file" id="product-image" name="product-image"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <!-- Campo Nome do Produto -->
                <div class="mb-4">
                    <label for="product-name" class="block text-sm font-medium text-gray-700">Nome do
                        Produto</label>
                    <input type="text" id="product-name" name="product-name"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Digite o nome do produto" required>
                </div>
                <!-- Campo Preço -->
                <div class="mb-4">
                    <label for="product-price" class="block text-sm font-medium text-gray-700">Preço do
                        Produto</label>
                    <input type="text" id="product-price" name="product-price"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Digite o preço do produto" required>
                </div>
                <!-- Campo Descrição -->
                <div class="mb-4">
                    <label for="product-description" class="block text-sm font-medium text-gray-700">Descrição do
                        Produto</label>
                    <textarea id="product-description" name="product-description"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        rows="4" placeholder="Digite a descrição do produto" required></textarea>
                </div>
                <!-- Botões -->
                <div class="flex justify-end">
                    <button type="button" id="cancel-add-product-btn"
                        class="mr-2 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md focus:outline-none">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none">
                        Adicionar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- FIM MODAL ADD --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalBtn = document.getElementById('open-modal-btn');
            const closeModal = document.getElementById('cancel-add-product-btn');
            const closeModalX = document.getElementById('cancel-add-x-btn');
            const modal = document.getElementById('add-product-modal');

            // Abrir modal
            openModalBtn.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            // Fechar modal
            closeModal.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            closeModalX.addEventListener("click", function() {
                modal.classList.add('hidden');
            })

            // Fechar modal ao clicar fora do conteúdo
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });



          
        })
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Produto adicionado no Cardápio',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    <script src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>
