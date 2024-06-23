<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-80">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        <!-- Formulário de login -->
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Nome de Usuário</label>
                <input type="text" id="username" name="username"
                    class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('username') border-red-500 @enderror"
                    placeholder="Digite seu nome de usuário">
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Senha</label>
                <input type="password" id="password" name="password"
                    class="block w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror"
                    placeholder="Digite sua senha">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Entrar
            </button>
        </form>
        <!-- Mensagem de erro geral -->
        @if(session('error'))
            <p class="text-red-500 text-xs mt-4">{{ session('error') }}</p>
        @endif
    </div>
</body>

</html>
