@extends('welcome')

@section('content')
    <div class="container">
        <h1>Adicionar Registro Financeiro</h1>
        <form action="{{ route('financial.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="type">Tipo</label>
                <select name="type" id="type" class="form-control">
                    <option value="" placeholder="Selecione um tipo">Selecione um tipo</option>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
            </div>

            <div class="form-group" id="source-field" style="display:none;">
                <label for="source">Fonte de Entrada</label>
                <select name="source" id="source" class="form-control">
                    @foreach ($entranceSources as $source)
                        <option value="{{ $source }}">{{ ucfirst($source) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="category-field" style="display:none;">
                <label for="category">Categoria de Saída</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($exitCategories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Montante</label>
                <input type="number" name="amount" id="amount" class="form-control" step="0.01">
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>

    <script>
        // Mostrar/ocultar campos de acordo com o tipo selecionado (entrada ou saída)
        document.getElementById('type').addEventListener('change', function() {
            if (this.value == 'entrada') {
                document.getElementById('source-field').style.display = 'block';
                document.getElementById('category-field').style.display = 'none';
            } else {
                document.getElementById('source-field').style.display = 'none';
                document.getElementById('category-field').style.display = 'block';
            }
        });
    </script>
@endsection
