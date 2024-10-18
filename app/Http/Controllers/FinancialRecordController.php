<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialRecordController extends Controller
{
    public function index(Request $request)
    {
        // Filtros
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $type = $request->input('type');

        // Busca inicial sem filtros
        $records = FinancialRecord::query();

        // Filtro por data de início e fim
        if ($startDate && $endDate) {
            $records->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Filtro por tipo (entrada ou saída)
        if ($type) {
            $records->where('type', $type);
        }

        $records = $records->get();

        // Cálculo total das entradas e saídas
        $totalOffers = $records->where('type', 'entrada')->sum('amount');
        $totalTithes = $records->where('type', 'dizimo')->sum('amount');
        $totalGeneralOffers = $records->where('type', 'saida')->sum('amount');

        return view('financial.index', compact('records', 'totalOffers', 'totalTithes', 'totalGeneralOffers'));
    }

    public function create()
    {
        // Definir fontes de entrada
        $entranceSources = ['dizimo', 'oferta', 'doacao', 'renda', 'projeto', 'outros'];

        // Definir categorias de saída
        $exitCategories = ['manutencao', 'eventos', 'salarios', 'outros'];

        // Passar essas informações para a view
        return view('financial.create', compact('entranceSources', 'exitCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'account_id' => 'required|exists:accounts,id',
            'date' => 'required|date',
        ]);

        FinancialRecord::create($request->all('type', 'amount', 'description'));
        $financialRecord = new FinancialRecord();
        $financialRecord->type = $request->type;
        $financialRecord->account_id = $request->account_id;
        $financialRecord->amount = $request->amount;
        $financialRecord->description = $request->description;
        $financialRecord->date = $request->date;
        if ($request->type == 'entrada') {
            $financialRecord->source = $request->source;
        } else {
            $financialRecord->category = $request->category;
        }
        return redirect()->route('financial.index')->with('success', 'Registro financeiro adicionado com sucesso.');
    }

    public function edit(FinancialRecord $financialRecord)
    {
        dd($financialRecord->toArray());
        return view('financial.edit', compact('financialRecord'));
    }

    public function update(Request $request, FinancialRecord $financialRecord)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $financialRecord->update($request->only('type', 'amount', 'description'));

        return redirect()->route('financial.index')->with('success', 'Registro financeiro atualizado com sucesso');
    }

    public function destroy(FinancialRecord $financialRecord)
    {
        $financialRecord->delete();

        return redirect()->route('financial.index')->with('success', 'Registro financeiro excluído com sucesso');
    }
}
