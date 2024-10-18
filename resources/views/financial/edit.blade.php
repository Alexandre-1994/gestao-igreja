@extends('welcome')

@section('content')
<div class="container">
    <h1>Editar Registro Financeiro</h1>
    <form  method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">Tipo</label>
            <select name="type" id="type" class="form-control">
                <option value="entrada" {{ $financialRecord->type == 'entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="saida" {{ $financialRecord->type == 'saida' ? 'selected' : '' }}>Saída</option>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Montante</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" value="{{ $financialRecord->amount }}">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" class="form-control">{{ $financialRecord->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection
