<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nome" class="form-label">Nome da Máquina <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $maquina->nome ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $maquina->marca ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $maquina->modelo ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="numero_serie" class="form-label">Número de Série</label>
        <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{ old('numero_serie', $maquina->numero_serie ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status">
            <option value="Disponível" {{ (old('status', $maquina->status ?? '') == 'Disponível') ? 'selected' : '' }}>Disponível</option>
            <option value="Em Manutenção" {{ (old('status', $maquina->status ?? '') == 'Em Manutenção') ? 'selected' : '' }}>Em Manutenção</option>
            <option value="Em Uso" {{ (old('status', $maquina->status ?? '') == 'Em Uso') ? 'selected' : '' }}>Em Uso</option>
            <option value="Inativo" {{ (old('status', $maquina->status ?? '') == 'Inativo') ? 'selected' : '' }}>Inativo</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="capacidade" class="form-label">Capacidade</label>
        <input type="text" class="form-control" id="capacidade" name="capacidade" value="{{ old('capacidade', $maquina->capacidade ?? '') }}" placeholder="Ex: 50L, 100KG">
    </div>
     <div class="col-md-4 mb-3">
        <label class="form-label d-block">&nbsp;</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" id="ativo" name="ativo" value="1" {{ old('ativo', $maquina->ativo ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Ativo</label>
        </div>
    </div>
    <div class="col-12 mb-3">
        <label for="observacoes" class="form-label">Observações</label>
        <textarea class="form-control" id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $maquina->observacoes ?? '') }}</textarea>
    </div>
</div>
