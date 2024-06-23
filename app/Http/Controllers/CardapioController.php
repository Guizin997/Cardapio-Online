<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CardapioController extends Controller
{
    public function index() {
        $produtos = Product::all();
        return view('index', [
            'produtos' => $produtos
        ]);
    }


    public function login(){
        return view('login.login');
    }


    public function auth(Request $request)
    {
        // Validar os dados do formulário
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Verificar se há erros de validação
        if ($validator->fails()) {
            // Se a validação falhar, redirecionar de volta com os erros
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lógica para autenticar o usuário (exemplo simples)
        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('cardapio.index');
        } else {
            return redirect()->back()->with('error', 'Nome de usuário ou senha incorretos.')->withInput();
        }
    }


    public function store(Request $request)
    {
        // Validar os dados do formulário usando Validator::make
        $validator = Validator::make($request->all(), [
            'product-image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar imagem até 2MB
            'product-name' => 'required|string|max:255',
            'product-price' => 'required|numeric|min:0',
            'product-description' => 'required|string',
        ]);

        // Verificar se há erros de validação
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obter extensão da imagem
        $extension = $request->file('product-image')->getClientOriginalExtension();

        // Gerar um nome único e seguro para a imagem usando SHA-256 hash
        $imageName = hash('sha256', time() . Str::random(40)) . '.' . $extension;

        // Salvar imagem na pasta public
        $request->file('product-image')->move(public_path('images/products'), $imageName);

        // Salvar dados do produto no banco de dados
        $product = new Product();
        $product->name = $request->input('product-name');
        $product->price = $request->input('product-price');
        $product->description = $request->input('product-description');
        $product->image = 'images/products/' . $imageName; // Salva o caminho da imagem na public
        $product->save();

        return redirect()->back()->with('success', 'Produto adicionado com sucesso!');
    }


    public function logout()
    {
        Auth::logout(); //
    
        return redirect('/');
    }

}
