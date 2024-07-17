@extends('welcome')

@section('content')
<div class="container">
    <h1>Painel do Utilizador</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total de Membros</h5>
                    <p class="card-text">{{ $totalMembros }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Homens</h5>
                    <p class="card-text">{{ $homens }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mulheres</h5>
                    <p class="card-text">{{ $mulheres }}</p>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('membros.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <select name="genero" class="form-control">
                    <option value="">Todos os Gêneros</option>
                    <option value="Masculino" {{ request('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ request('genero') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="Outro" {{ request('genero') == 'Outro' ? 'selected' : '' }}>Outro</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="paroquia" class="form-control" placeholder="Paróquia" value="{{ request('paroquia') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="regiao" class="form-control" placeholder="Região" value="{{ request('regiao') }}">
            </div>
            {{-- <div class="col-md-2">
                <input type="number" name="idade_min" class="form-control" placeholder="Idade Mínima" value="{{ request('idade_min') }}">
            </div> --}}
            {{-- <div class="col-md-2">
                <input type="number" name="idade_max" class="form-control" placeholder="Idade Máxima" value="{{ request('idade_max') }}">
            </div> --}}
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('membros.index') }}" class="btn btn-secondary">Limpar</a>
                
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Gênero</th>
                <th>Paróquia</th>
                <th>Região</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membros as $membro)
            <tr>
                <td>{{ $membro->nome }}</td>
                <td>{{ $membro->genero }}</td>
                <td>{{ $membro->paroquia }}</td>
                <td>{{ $membro->regiao }}</td>
                <td>
                    <a href="{{ route('membros.edit', $membro->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('membros.destroy', $membro->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este membro?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $membros->links() }}
</div>
@endsection