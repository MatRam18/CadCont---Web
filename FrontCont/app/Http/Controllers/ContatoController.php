<?php

namespace App\Http\Controllers;

use App\Models\contato;
use Illuminate\Http\Request;

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
                'reservas' => [],
                'message' => 'Erro ao carregar as reservas. Tente novamente mais tarde.'
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(contato $contato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contato $contato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contato $contato)
    {
        //
    }
}
