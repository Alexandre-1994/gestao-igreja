@extends('welcome')

@section('content')
    <h1>{{ isset($membro) ? 'Editar Membro' : 'Novo Membro' }}</h1>

    <form action="{{ isset($membro) ? route('membros.update', $membro->id) : route('membros.store') }}" method="POST">
        @csrf
        @if(isset($membro))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $membro->nome ?? old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Gênero</label>
            <select class="form-select" id="genero" name="genero" required>
                <option value="Masculino" {{ (isset($membro) && $membro->genero == 'Masculino') ? 'selected' : '' }}>Masculino</option>
                <option value="Feminino" {{ (isset($membro) && $membro->genero == 'Feminino') ? 'selected' : '' }}>Feminino</option>
                <option value="Outro" {{ (isset($membro) && $membro->genero == 'Outro') ? 'selected' : '' }}>Outro</option>
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="batizado" name="batizado" value="1" {{ (isset($membro) && $membro->batizado) ? 'checked' : '' }}>
            <label class="form-check-label" for="batizado">Batizado</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="confirmado" name="confirmado" value="1" {{ (isset($membro) && $membro->confirmado) ? 'checked' : '' }}>
            <label class="form-check-label" for="confirmado">Confirmado</label>
        </div>

        <div class="mb-3">
            <label for="regiao" class="form-label">Região</label>
            <input type="text" class="form-control" id="regiao" name="regiao" value="{{ $membro->regiao ?? old('regiao') }}" required>
        </div>

        <div class="mb-3">
            <label for="paroquia" class="form-label">Paróquia</label>
            <input type="text" class="form-control" id="paroquia" name="paroquia" value="{{ $membro->paroquia ?? old('paroquia') }}" required>
        </div>

        <div class="mb-3">
            <label for="estado_civil" class="form-label">Estado Civil</label>
            <select class="form-select" id="estado_civil" name="estado_civil" required>
                <option value="Solteiro" {{ (isset($membro) && $membro->estado_civil == 'Solteiro') ? 'selected' : '' }}>Solteiro</option>
                <option value="Casado" {{ (isset($membro) && $membro->estado_civil == 'Casado') ? 'selected' : '' }}>Casado</option>
                <option value="União Estável" {{ (isset($membro) && $membro->estado_civil == 'União Estável') ? 'selected' : '' }}>União Estável</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="funcao" class="form-label">Função na Igreja</label>
            <input type="text" class="form-control" id="funcao" name="funcao" value="{{ $membro->funcao ?? old('funcao') }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($membro) ? 'Atualizar' : 'Cadastrar' }}</button>
        <a href="{{ route('membros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection