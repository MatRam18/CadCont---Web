<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Exibe a tela de login
    public function showLogin()
    {
        if (Session::has('firebase_user')) {
            return redirect('/homepage');
        }
        return view('login.index');
    }

    // Realiza o login do usuário
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $apiKey = env('FIREBASE_API_KEY');

        $response = Http::post("https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key={$apiKey}", [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true
        ]);

        if ($response->successful()) {
            $data = $response->json();
            Session::put('firebase_user', [
                'idToken' => $data['idToken'],
                'email' => $data['email'],
                'uid' => $data['localId'],
            ]);
            return redirect('/homepage');
        }

        return redirect()->back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    // Exibe a tela de cadastro
    public function showRegisterForm()
    {
        if (Session::has('firebase_user')) {
            return redirect('/homepage');
        }
        return view('cadastro.index');
    }

    // Realiza o cadastro do usuário e salva nome no Firestore
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
        ]);

        $apiKey = env('FIREBASE_API_KEY');

        $response = Http::post("https://identitytoolkit.googleapis.com/v1/accounts:signUp?key={$apiKey}", [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true
        ]);

        if ($response->successful()) {
            $data = $response->json();
            Session::put('firebase_user', [
                'idToken' => $data['idToken'],
                'email' => $data['email'],
                'uid' => $data['localId'],
            ]);

            // Salva o nome no Firestore
            $firestoreUrl = env('FIREBASE_FIRESTORE_URL') . '/users/' . $data['localId'];
            Http::patch($firestoreUrl, [
                'fields' => [
                    'name' => ['stringValue' => $request->name],
                    'photo' => ['stringValue' => ''],
                ]
            ]);

            return redirect('/homepage');
        }

        return redirect()->back()->withErrors(['email' => 'Erro ao cadastrar. Talvez o e-mail já esteja em uso.']);
    }

    // Realiza o logout do usuário
    public function logout()
    {
        Session::forget('firebase_user');
        return redirect('/');
    }

    // Exemplo de proteção de página
    public function protectedPage()
    {
        if (!Session::has('firebase_user')) {
            return redirect('/login');
        }
        // ...retorne a view protegida...
    }

    // Exibe a tela de recuperação de senha
    public function showForgotPasswordForm()
    {
        if (Session::has('firebase_user')) {
            return redirect('/homepage');
        }
        return view('forgotpassword.index');
    }

    // Envia o email de redefinição de senha via Firebase
    public function sendResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $apiKey = env('FIREBASE_API_KEY');

        $response = Http::post("https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key={$apiKey}", [
            'requestType' => 'PASSWORD_RESET',
            'email' => $request->email,
        ]);

        if ($response->successful()) {
            return back()->with('status', 'Link de redefinição enviado para o seu email.');
        }

        $error = $response->json('error.message') ?? 'Erro ao enviar o link.';
        return back()->withErrors(['email' => $error]);
    }
}