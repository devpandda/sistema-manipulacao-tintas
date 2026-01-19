<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $cliente->nome ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="cpf_cnpj" class="form-label">CPF/CNPJ <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="{{ old('cpf_cnpj', $cliente->cpf_cnpj ?? '') }}" required maxlength="18">
    </div>
    <div class="col-md-6 mb-3">
        <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone ?? '') }}" required maxlength="15">
    </div>
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $cliente->email ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep', $cliente->cep ?? '') }}" maxlength="9">
    </div>
    <div class="col-md-6 mb-3">
        <label for="logradouro" class="form-label">Logradouro</label>
        <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ old('logradouro', $cliente->logradouro ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="numero" class="form-label">Número</label>
        <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero', $cliente->numero ?? '') }}">
    </div>
    <div class="col-md-8 mb-3">
        <label for="complemento" class="form-label">Complemento</label>
        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento', $cliente->complemento ?? '') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="bairro" class="form-label">Bairro</label>
        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro', $cliente->bairro ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado">
            <option value="">Selecione...</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <select class="form-select" id="cidade" name="cidade">
            <option value="">Selecione um estado primeiro</option>
        </select>
    </div>
</div>

@section('page-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Masks
        const cpfCnpjInput = document.getElementById('cpf_cnpj');
        const telefoneInput = document.getElementById('telefone');
        const cepInput = document.getElementById('cep');

        const maskCpfCnpj = (value) => {
            value = value.replace(/\D/g, "");
            if (value.length <= 11) {
                return value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
            } else {
                return value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
            }
        };

        const maskPhone = (value) => {
            value = value.replace(/\D/g, "");
            if (value.length <= 10) {
                return value.replace(/(\d{2})(\d{4})(\d{4})/g, "(\$1) \$2-\$3");
            } else {
                return value.replace(/(\d{2})(\d{5})(\d{4})/g, "(\$1) \$2-\$3");
            }
        };

        const maskCep = (value) => {
             return value.replace(/\D/g, "").replace(/^(\d{5})(\d{3})/, "\$1-\$2");
        }

        if (cpfCnpjInput) {
            cpfCnpjInput.addEventListener('input', (e) => {
                e.target.value = maskCpfCnpj(e.target.value);
            });
            // Apply mask on load if value exists
            if (cpfCnpjInput.value) {
                cpfCnpjInput.value = maskCpfCnpj(cpfCnpjInput.value);
            }
        }
        if (telefoneInput) {
             telefoneInput.addEventListener('input', (e) => {
                e.target.value = maskPhone(e.target.value);
            });
            if (telefoneInput.value) {
                telefoneInput.value = maskPhone(telefoneInput.value);
            }
        }
         if (cepInput) {
             cepInput.addEventListener('input', (e) => {
                e.target.value = maskCep(e.target.value);
            });
             if (cepInput.value) {
                cepInput.value = maskCep(cepInput.value);
            }
        }

        // State / City Logic
        const estadoSelect = document.getElementById('estado');
        const cidadeSelect = document.getElementById('cidade');
        const oldEstado = "{{ old('estado', $cliente->estado ?? '') }}";
        const oldCidade = "{{ old('cidade', $cliente->cidade ?? '') }}";

        // Load States
        fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
            .then(response => response.json())
            .then(states => {
                states.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.sigla;
                    option.text = state.sigla; 
                    if (oldEstado === state.sigla) {
                        option.selected = true;
                    }
                    estadoSelect.appendChild(option);
                });
                
                // If existing state, load cities
                if (oldEstado) {
                    loadCities(oldEstado);
                }
            });

        estadoSelect.addEventListener('change', function() {
            const uf = this.value;
            loadCities(uf);
        });

        function loadCities(uf) {
            cidadeSelect.innerHTML = '<option value="">Carregando...</option>';
            if (!uf) {
                 cidadeSelect.innerHTML = '<option value="">Selecione um estado primeiro</option>';
                 return;
            }
            
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
                .then(response => response.json())
                .then(cities => {
                    cidadeSelect.innerHTML = '<option value="">Selecione...</option>';
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.nome;
                        option.text = city.nome;
                        if (oldCidade === city.nome) {
                            option.selected = true;
                        }
                        cidadeSelect.appendChild(option);
                    });
                });
        }
    });
</script>
@endsection