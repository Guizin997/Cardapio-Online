<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionais para o modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">Admin Dashboard</div>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                id="open-modal-btn">Adicionar Produto</button>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container mx-auto mt-8">
        <!-- Tabela de Produtos -->
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Imagem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Preço</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Descrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Linhas da tabela aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal para adicionar produto -->
    <div id="modal" class="modal">
        <div class="modal-content bg-white rounded-lg shadow-md p-4 mx-auto">
            <span class="close">&times;</span>
            <h2 class="text-2xl font-bold mb-4">Adicionar Produto</h2>
            <form id="add-product-form">
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">URL da Imagem</label>
                    <input type="text" id="image" name="image"
                        class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        placeholder="URL da imagem">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nome</label>
                    <input type="text" id="name" name="name"
                        class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        placeholder="Nome do produto">
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Preço</label>
                    <input type="text" id="price" name="price"
                        class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        placeholder="Preço do produto">
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descrição</label>
                    <textarea id="description" name="description"
                        class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        rows="4" placeholder="Descrição do produto"></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Adicionar Produto
                </button>
            </form>
        </div>
    </div>

    <!-- Scripts para o modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Abre o modal ao clicar no botão "Adicionar Produto"
            document.getElementById('open-modal-btn').addEventListener('click', function () {
                document.getElementById('modal').style.display = 'block';
            });

            // Fecha o modal ao clicar no botão de fechar
            document.getElementsByClassName('close')[0].addEventListener('click', function () {
                document.getElementById('modal').style.display = 'none';
            });

            // Fecha o modal ao clicar fora da área do modal
            window.onclick = function (event) {
                if (event.target == document.getElementById('modal')) {
                    document.getElementById('modal').style.display = 'none';
                }
            };

            // Lógica para enviar o formulário de adicionar produto (a ser implementado)
            document.getElementById('add-product-form').addEventListener('submit', function (event) {
                event.preventDefault();
                // Aqui você pode adicionar a lógica para enviar os dados do formulário via AJAX ou outra forma
                // Exemplo: fetch('/adicionar-produto', {
                //     method: 'POST',
                //     body: new FormData(this)
                // }).then(response => {
                //     if (response.ok) {
                //         // Produto adicionado com sucesso, pode atualizar a tabela ou fechar o modal, etc.
                //     }
                // }).catch(error => {
                //     console.error('Erro ao adicionar produto:', error);
                // });
            });
        });
    </script>
</body>

</html>
