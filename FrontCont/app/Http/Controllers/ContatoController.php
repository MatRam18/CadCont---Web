<?php

namespace App\Http\Controllers;

use App\Models\contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContatoController extends Controller
{
    private $urlApi = 'http://localhost:8001/api/contato';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get($this->urlApi);

        if ($response->failed()) {
            return view('homepage.index', [
                'contato' => [],
                'message' => 'Erro ao carregar os contatos. Tente novamente mais tarde.'
            ]);
        }

        $data = $response->json();

        if (isset($data['success']) && !$data['success']) {
            return view('homepage.index', [
                'contato' => [],
                'message' => $data['message'] ?? 'Erro ao carregar os contatos. Tente novamente mais tarde.'
            ]);
        }

        return view('homepage.index', [
            'contato' => $data['data'] ?? [],
            'message' => $data['message'] ?? ''
        ]);
    }

    public function create()
    {
        return view('contato.newcontact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Requisição de criação de contato recebida.', $request->only('nome', 'idade', 'telefone', 'email'));

        $response = Http::post($this->urlApi, $request->only('nome', 'idade', 'telefone', 'email'));

        Log::info('Resposta da API externa:', [
            'status' => $response->status(),
            'successful' => $response->successful(),
            'body' => $response->body(),
            'json' => $response->json()
        ]);

        if ($response->successful()) {
            return view('newcontact.index', [
                'success' => 'Contato criado com sucesso!',
                'error' => '' // Garante que a variável 'error' esteja sempre definida
            ]);
        }

        $data = $response->json();
        $errorMessage = $data['message'] ?? 'Erro ao criar o contato. Tente novamente mais tarde.';

        return view('newcontact.index', [
            'success' => '', // Garante que a variável 'success' esteja sempre definida
            'error' => $errorMessage
        ]);
    }

    public function edit($id)
    {
        $response = Http::get("{$this->urlApi}/{$id}");
        $contato = $response->json()['data'] ?? null;

        if (!$contato) {
            return redirect()->route('contato.index')->with('error', 'Contato não encontrado');
        }

        return view('contato.edit', compact('contato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contatoExistente = Http::get("{$this->urlApi}/{$id}")->json();

        $dadosParaAtualizar = [
            'Nome' => $request->input('Nome') ?? ($contatoExistente['data']['Nome'] ?? null),
            'email' => $request->input('email') ?? ($contatoExistente['data']['email'] ?? null),
            'idade' => $request->input('idade') ?? ($contatoExistente['data']['idade'] ?? null),
            'telefone' => $request->input('telefone') ?? ($contatoExistente['data']['telefone'] ?? null),
        ];

        // Remove campos nulos ou vazios para evitar sobrescrever com valores indesejados na API externa
        $dadosParaAtualizar = array_filter($dadosParaAtualizar, function($value) { return $value !== null; });

        $response = Http::put("{$this->urlApi}/{$id}", $dadosParaAtualizar);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Contato atualizado com sucesso!']);
        }

        $data = $response->json();
        $errorMessage = $data['message'] ?? 'Erro ao atualizar o contato. Tente novamente mais tarde.';

        return response()->json(['success' => false, 'message' => $errorMessage], $response->status());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = Http::delete("{$this->urlApi}/{$id}");

        if ($response->successful()) {
            return redirect()->route('contato.index')->with('success', 'Contato deletado com sucesso');
        }
        
        $data = $response->json();
        $errorMessage = $data['message'] ?? 'Erro ao deletar o contato. Tente novamente mais tarde.';

        return redirect()->route('contato.index')->with('error', $errorMessage);
    }
}
