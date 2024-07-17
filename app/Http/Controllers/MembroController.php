<?php

namespace App\Http\Controllers;

use App\Models\Membro;
use Illuminate\Http\Request;

class MembroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalMembros = Membro::count();
        $homens = Membro::where('genero', 'Masculino')->count();
        $mulheres = Membro::where('genero', 'Feminino')->count();

        $membros = Membro::query();

        // Filtros (implementaremos a seguir)
        // ...
        if ($request->filled('genero')) {
            $membros->where('genero', $request->genero);
        }

        if ($request->filled('paroquia')) {
            $membros->where('paroquia', 'like', '%' . $request->paroquia . '%');
        }

        if ($request->filled('regiao')) {
            $membros->where('regiao', 'like', '%' . $request->regiao . '%');
        }

        // Para filtrar por idade, precisamos adicionar um campo 'data_nascimento' ao modelo Membro
        if ($request->filled('idade_min') && $request->filled('idade_max')) {
            $membros->whereRaw(
                'TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN ? AND ?',
                [$request->idade_min, $request->idade_max]
            );
        }

        $membros = $membros->paginate(10);

        return view('membros.index', compact('membros', 'totalMembros', 'homens', 'mulheres'));
        // $membros = Membro::all();
        // return view('membros.index', compact('membros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('membros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'genero' => 'required|in:Masculino,Feminino,Outro',
            'batizado' => 'boolean',
            'confirmado' => 'boolean',
            'regiao' => 'required|max:255',
            'paroquia' => 'required|max:255',
            'estado_civil' => 'required|in:Solteiro,Casado,União Estável',
            'funcao' => 'nullable|max:255',
        ]);
        Membro::create($validatedData);
        return redirect()->route('membros.index')->with('success', 'Membro cadastrado com sucesso!');
        $membro = Membro::create($request->all());
        return redirect()->route('membros.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membro $membro)
    {
        return view('membros.edit', compact('membro'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Membro $membro)
    {
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'genero' => 'required|in:Masculino,Feminino,Outro',
            'batizado' => 'boolean',
            'confirmado' => 'boolean',
            'regiao' => 'required|max:255',
            'paroquia' => 'required|max:255',
            'estado_civil' => 'required|in:Solteiro,Casado,União Estável',
            'funcao' => 'nullable|max:255',
        ]);

        $membro->update($validatedData);

        return redirect()->route('membros.index')
            ->with('success', 'Membro atualizado com sucesso!');
    }

    public function destroy(Membro $membro)
    {
        $membro->delete();

        return redirect()->route('membros.index')->with('success', 'Membro excluído com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $membro->delete();
    //     return redirect()->route('membros.index');
    // }
}
