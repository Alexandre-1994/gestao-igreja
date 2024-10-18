@extends('welcome')

@section('content')
    <div class="container">
        <h1>Registros Financeiros</h1>

        <!-- Filtros -->
        <form method="GET" action="{{ route('financial.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="start_date">Data Inicial</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">Data Final</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="type">Tipo</label>
                    <select name="type" class="form-control">
                        <option value="">Todos</option>
                        <option value="entrada" {{ request('type') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                        <option value="saida" {{ request('type') == 'saida' ? 'selected' : '' }}>Saída</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Resumo -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Entradas:</h5>
                        <p class="card-text">{{ $totalOffers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Dízimos:</h5>
                        <p class="card-text">{{ $totalTithes }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Saídas:</h5>
                        <p class="card-text">{{ $totalGeneralOffers }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botão para adicionar um novo registro -->
        <a href="{{ route('financial.create') }}" class="btn btn-primary mb-3">Adicionar Registro</a>

        <!-- Tabela de registros -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Montante</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->type }}</td>
                        <td>{{ $record->amount }}</td>
                        <td>{{ $record->description }}</td>
                        <td>{{ $record->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('financial.edit', $record->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('financial.destroy', $record->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<Script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (confirm('Tem certeza que deseja excluir este registro?')) {
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this)
                }).then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</Script>
