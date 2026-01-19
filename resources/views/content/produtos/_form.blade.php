<div class="row">
    <div class="col-md-12 mb-3">
        <label for="imagem" class="form-label">Imagem do Produto</label>
        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
        @if(isset($produto) && $produto->imagem)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $produto->imagem) }}" alt="Imagem do produto" class="img-thumbnail" width="150">
            </div>
        @endif
    </div>
    <div class="col-md-6 mb-3">
        <label for="nome" class="form-label">Nome do Produto <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $produto->nome ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $produto->sku ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="codigo_barra" class="form-label">Código de Barras</label>
        <input type="text" class="form-control" id="codigo_barra" name="codigo_barra" value="{{ old('codigo_barra', $produto->codigo_barra ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $produto->marca ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <input type="text" class="form-control" id="categoria" name="categoria" value="{{ old('categoria', $produto->categoria ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="classificacao_tinta" class="form-label">Classificação Tinta</label>
        <input type="text" class="form-control" id="classificacao_tinta" name="classificacao_tinta" value="{{ old('classificacao_tinta', $produto->classificacao_tinta ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="volume" class="form-label">Volume</label>
        <input type="text" class="form-control" id="volume" name="volume" value="{{ old('volume', $produto->volume ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="unidade_padrao" class="form-label">Unidade Padrão</label>
        <select class="form-select" id="unidade_padrao" name="unidade_padrao">
            <option value="">Selecione...</option>
            <option value="L" {{ (old('unidade_padrao', $produto->unidade_padrao ?? '') == 'L') ? 'selected' : '' }}>Litros (L)</option>
            <option value="ml" {{ (old('unidade_padrao', $produto->unidade_padrao ?? '') == 'ml') ? 'selected' : '' }}>Mililitros (ml)</option>
            <option value="KG" {{ (old('unidade_padrao', $produto->unidade_padrao ?? '') == 'KG') ? 'selected' : '' }}>Quilogramas (KG)</option>
            <option value="g" {{ (old('unidade_padrao', $produto->unidade_padrao ?? '') == 'g') ? 'selected' : '' }}>Hramas (g)</option>
            <option value="UN" {{ (old('unidade_padrao', $produto->unidade_padrao ?? '') == 'UN') ? 'selected' : '' }}>Unidade (UN)</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label d-block">&nbsp;</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" id="ativo" name="ativo" value="1" {{ old('ativo', $produto->ativo ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Ativo</label>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="custo" class="form-label">Custo (R$)</label>
        <input type="number" step="0.01" class="form-control" id="custo" name="custo" value="{{ old('custo', $produto->custo ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="valor_venda" class="form-label">Valor de Venda (R$)</label>
        <input type="number" step="0.01" class="form-control" id="valor_venda" name="valor_venda" value="{{ old('valor_venda', $produto->valor_venda ?? '') }}">
    </div>
    <div class="col-12 mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $produto->descricao ?? '') }}</textarea>
    </div>
</div>
