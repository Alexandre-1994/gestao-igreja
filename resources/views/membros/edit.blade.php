@extends('welcome')

@section('content')
<div class="container">
    <h1>Editar Membro</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('membros.update', $membro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $membro->nome) }}" required>
        </div>

        <div class="form-group">
            <label for="genero">Gênero</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="Masculino" {{ old('genero', $membro->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Feminino" {{ old('genero', $membro->genero) == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                <option value="Outro" {{ old('genero', $membro->genero) == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="batizado" name="batizado" value="1" {{ old('batizado', $membro->batizado) ? 'checked' : '' }}>
            <label class="form-check-label" for="batizado">Batizado</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="confirmado" name="confirmado" value="1" {{ old('confirmado', $membro->confirmado) ? 'checked' : '' }}>
            <label class="form-check-label" for="confirmado">Confirmado</label>
        </div>

        <div class="form-group">
            <label for="regiao">Região</label>
            <input type="text" class="form-control" id="regiao" name="regiao" value="{{ old('regiao', $membro->regiao) }}" required>
        </div>

        <div class="form-group">
            <label for="paroquia">Paróquia</label>
            <input type="text" class="form-control" id="paroquia" name="paroquia" value="{{ old('paroquia', $membro->paroquia) }}" required>
        </div>

        <div class="form-group">
            <label for="estado_civil">Estado Civil</label>
            <select class="form-control" id="estado_civil" name="estado_civil" required>
                <option value="Solteiro" {{ old('estado_civil', $membro->estado_civil) == 'Solteiro' ? 'selected' : '' }}>Solteiro</option>
                <option value="Casado" {{ old('estado_civil', $membro->estado_civil) == 'Casado' ? 'selected' : '' }}>Casado</option>
                <option value="União Estável" {{ old('estado_civil', $membro->estado_civil) == 'União Estável' ? 'selected' : '' }}>União Estável</option>
            </select>
        </div>

        <div class="form-group">
            <label for="funcao">Função</label>
            <input type="text" class="form-control" id="funcao" name="funcao" value="{{ old('funcao', $membro->funcao) }}">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('membros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection