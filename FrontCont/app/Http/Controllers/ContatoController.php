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
        try {
            $dados = $request->only('Nome', 'idade', 'telefone', 'email');
            
            Log::info('Dados recebidos do formulário:', $dados);

            if (empty($dados)) {
                Log::error('Nenhum dado recebido do formulário');
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum dado recebido do formulário'
                ], 400);
            }

            Log::info('Enviando requisição para API:', [
                'url' => $this->urlApi,
                'dados' => $dados
            ]);

            $response = Http::post($this->urlApi, $dados);

            Log::info('Resposta da API:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contato criado com sucesso!'
                ]);
            }

            $data = $response->json();
            $statusCode = $response->status();
            
            Log::error('Erro na API:', [
                'status' => $statusCode,
                'response' => $data
            ]);

            return response()->json([
                'success' => false,
                'message' => $data['message'] ?? 'Erro ao criar o contato. Tente novamente mais tarde.'
            ], $statusCode);

        } catch (\Exception $e) {
            Log::error('Erro ao processar requisição:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor. Por favor, tente novamente mais tarde.'
            ], 500);
        }
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
