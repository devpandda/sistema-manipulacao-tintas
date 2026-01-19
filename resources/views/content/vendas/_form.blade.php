<div class="row">
  <!-- Client & Date -->
  <div class="col-md-6 mb-3">
    <label for="id_cliente" class="form-label">Cliente <span class="text-danger">*</span></label>
    <select class="form-select select2" id="id_cliente" name="id_cliente" required>
      <option value="">Selecione um cliente...</option>
      @foreach ($clientes as $cliente)
        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nome }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6 mb-3">
    <label for="data_venda" class="form-label">Data da Venda <span class="text-danger">*</span></label>
    <input type="datetime-local" class="form-control" id="data_venda" name="data_venda" value="{{ date('Y-m-d\TH:i') }}"
      required>
  </div>
  <div class="col-12 mb-3">
    <label for="descricao" class="form-label">Descrição (Título/Ref)</label>
    <input type="text" class="form-control" id="descricao" name="descricao"
      placeholder="Ex: Venda Balcão - Cliente Preferencial">
  </div>

  <hr class="my-3">

  <!-- Product Adder -->
  <h5 class="mb-3">Adicionar Produtos</h5>
  <div class="col-md-5 mb-3">
    <label for="produto_selector" class="form-label">Produto</label>
    <select class="form-select select2" id="produto_selector">
      <option value="">Buscar produto...</option>
      @foreach ($produtos as $produto)
        <option value="{{ $produto->id_produto }}" data-price="{{ $produto->valor_venda }}"
          data-image="{{ $produto->imagem ? asset('storage/' . $produto->imagem) : '' }}">{{ $produto->nome }} (R$
          {{ number_format($produto->valor_venda, 2, ',', '.') }})</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2 mb-3">
    <label for="qty_selector" class="form-label">Qtd.</label>
    <input type="number" class="form-control" id="qty_selector" value="1" min="0.01" step="0.01">
  </div>
  <div class="col-md-3 mb-3 d-flex align-items-end">
    <div class="form-check form-switch mb-2">
      <input class="form-check-input" type="checkbox" id="manipular_check">
      <label class="form-check-label" for="manipular_check">Manipular (Víncular Máquina/Fórmula)</label>
    </div>
  </div>
  <div class="col-md-2 mb-3 d-flex align-items-end">
    <button type="button" class="btn btn-primary w-100" id="btn_add_item"><i class="ri-add-line me-1"></i>
      Adicionar</button>
  </div>

  <!-- Manipulation Area (Hidden by default) -->
  <div class="col-12 mb-3" id="manipulation_panel" style="display: none;">
    <div class="card bg-lighter p-3">
      <h6>Configuração de Manipulação</h6>
      <div class="row">
        <div class="col-md-4 mb-2">
          <label class="form-label">Máquina <span class="text-danger">*</span></label>
          <select class="form-select" id="maquina_selector">
            <option value="">Selecione...</option>
            @foreach ($maquinas as $maquina)
              <option value="{{ $maquina->id_maquina }}">{{ $maquina->nome }} - {{ $maquina->status }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4 mb-2">
          <label class="form-label">Cód. Fórmula <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="formula_input" placeholder="Ex: A-102">
        </div>
      </div>

      <!-- Ingredients Adder -->
      <div class="row mt-3">
        <h6 class="text-secondary">Adicionar Ingredientes (Corantes/Aditivos)</h6>
        <div class="col-md-4 mb-2">
          <label class="form-label">Ingrediente</label>
          <select class="form-select" id="ing_produto_selector">
            <option value="">Selecione...</option>
            @foreach ($produtos as $produto)
              <!-- Store batches in data attribute -->
              <option value="{{ $produto->id_produto }}" data-nome="{{ $produto->nome }}"
                data-batches='{{ json_encode($produto->estoque) }}'>{{ $produto->nome }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4 mb-2">
          <label class="form-label">Lote (Estoque)</label>
          <select class="form-select" id="ing_lote_selector" disabled>
            <option value="">Selecione o produto primeiro...</option>
          </select>
        </div>
        <div class="col-md-2 mb-2">
          <label class="form-label">Qtd. Usada</label>
          <input type="number" class="form-control" id="ing_qty_selector" placeholder="0.00" step="0.0001">
        </div>
        <div class="col-md-2 mb-2 d-flex align-items-end">
          <button type="button" class="btn btn-outline-primary w-100" id="btn_add_ingrediente">Add Ing.</button>
        </div>
      </div>

      <!-- List of ingredients for current item -->
      <div class="row" id="current_ingredients_list" style="display: none;">
        <div class="col-12">
          <table class="table table-sm table-bordered bg-white">
            <thead>
              <tr>
                <th>Ingrediente</th>
                <th>Lote</th>
                <th>Qtd.</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody id="ingredients_tbody"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Items Table -->
  <div class="col-12 mb-3">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered" id="itens_table">
        <thead class="table-light">
          <tr>
            <th>Produto</th>
            <th>Qtd.</th>
            <th>Valor Unit.</th>
            <th>Total</th>
            <th>Detalhes (Man.)</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          <!-- JS will populate -->
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="text-end">Total Geral:</th>
            <th colspan="3" id="grand_total">R$ 0,00</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <input type="hidden" name="status" value="Finalizada">
  <input type="hidden" name="observacoes" value="">

  <div class="col-12 mt-3">
    <button type="submit" class="btn btn-success btn-lg">Finalizar Venda</button>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // --- MAIN ITEM VARIABLES ---
    const btnAdd = document.getElementById('btn_add_item');
    const tableBody = document.querySelector('#itens_table tbody');
    const grandTotalEl = document.getElementById('grand_total');
    let itemCount = 0;

    // --- MANIPULATION VARIABLES ---
    const manCheck = document.getElementById('manipular_check');
    const manPanel = document.getElementById('manipulation_panel');

    const ingProdSel = document.getElementById('ing_produto_selector');
    const ingLoteSel = document.getElementById('ing_lote_selector');
    const ingQtyInp = document.getElementById('ing_qty_selector');
    const btnAddIng = document.getElementById('btn_add_ingrediente');
    const ingTbody = document.getElementById('ingredients_tbody');
    const ingListDiv = document.getElementById('current_ingredients_list');

    // Store current ingredients temporarily before adding to main list
    let currentIngredients = [];

    // Toggle Manipulation Panel
    manCheck.addEventListener('change', function() {
      manPanel.style.display = this.checked ? 'block' : 'none';
      if (!this.checked) {
        // Clear ingredients if unchecked
        currentIngredients = [];
        renderIngredients();
      }
    });

    // Populate Batches when Ingredient Product is selected
    ingProdSel.addEventListener('change', function() {
      const option = this.options[this.selectedIndex];
      ingLoteSel.innerHTML = '<option value="">Selecione o lote...</option>';
      ingLoteSel.disabled = true;

      if (this.value) {
        const batches = JSON.parse(option.getAttribute('data-batches') || '[]');
        if (batches.length > 0) {
          ingLoteSel.disabled = false;
          batches.forEach(b => {
            const opt = document.createElement('option');
            opt.value = b.id_estoque;
            opt.text = `Lote: ${b.lote} (Valid: ${b.validade || 'N/A'}) - Qtd: ${b.quantidadeatual}`;
            ingLoteSel.appendChild(opt);
          });
        } else {
          const opt = document.createElement('option');
          opt.text = "Sem estoque disponível";
          ingLoteSel.appendChild(opt);
        }
      }
    });

    // Add Ingredient to Temporary List
    btnAddIng.addEventListener('click', function() {
      const prodId = ingProdSel.value;
      const loteId = ingLoteSel.value;
      const qty = parseFloat(ingQtyInp.value);

      if (!prodId || !loteId || isNaN(qty) || qty <= 0) {
        return alert('Preencha todos os campos do ingrediente corretamente.');
      }

      const prodName = ingProdSel.options[ingProdSel.selectedIndex].getAttribute('data-nome');
      const loteText = ingLoteSel.options[ingLoteSel.selectedIndex].text;

      currentIngredients.push({
        id_produto: prodId,
        id_estoque: loteId,
        quantidade: qty,
        nome_produto: prodName,
        nome_lote: loteText
      });

      renderIngredients();

      // Reset Inputs
      ingProdSel.value = '';
      ingLoteSel.innerHTML = '<option value="">Selecione o produto primeiro...</option>';
      ingLoteSel.disabled = true;
      ingQtyInp.value = '';
    });

    function renderIngredients() {
      ingTbody.innerHTML = '';
      if (currentIngredients.length > 0) {
        ingListDiv.style.display = 'block';
        currentIngredients.forEach((ing, index) => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
                    <td>${ing.nome_produto}</td>
                    <td>${ing.nome_lote}</td>
                    <td>${ing.quantidade}</td>
                    <td><button type="button" class="btn btn-xs btn-outline-danger" onclick="removeIngredient(${index})">X</button></td>
                `;
          ingTbody.appendChild(tr);
        });
      } else {
        ingListDiv.style.display = 'none';
      }
    }

    // Expose remove function globally for onclick
    window.removeIngredient = function(index) {
      currentIngredients.splice(index, 1);
      renderIngredients();
    }

    // Add Main Item
    btnAdd.addEventListener('click', function() {
      const prodSel = document.getElementById('produto_selector');
      const qtyInp = document.getElementById('qty_selector');

      const prodId = prodSel.value;
      if (!prodId) return alert('Selecione um produto');

      const prodName = prodSel.options[prodSel.selectedIndex].text.split(' (R$')[0];
      const price = parseFloat(prodSel.options[prodSel.selectedIndex].getAttribute('data-price'));
      const imageSrc = prodSel.options[prodSel.selectedIndex].getAttribute('data-image');
      const qty = parseFloat(qtyInp.value);

      if (qty <= 0) return alert('Quantidade inválida');

      const total = price * qty;
      const isManipulated = manCheck.checked;

      // Manipulation Data
      let manDetails = '';
      let manInputs = '';

      if (isManipulated) {
        const maqSel = document.getElementById('maquina_selector');
        const formInp = document.getElementById('formula_input');
        const maqId = maqSel.value;
        const formCode = formInp.value;

        if (!maqId || !formCode) return alert('Selecione a máquina e informe a fórmula.');
        // Enforce at least one ingredient if manipulated (based on user error)
        if (currentIngredients.length === 0) return alert(
          'Adicione pelo menos um ingrediente para a manipulação.');

        manDetails =
          `<span class="badge bg-warning">Manipulado</span><br><small>Máq: ${maqSel.options[maqSel.selectedIndex].text}<br>Fórm: ${formCode}</small>`;
        manInputs = `
                <input type="hidden" name="itens[${itemCount}][manipulado]" value="1">
                <input type="hidden" name="itens[${itemCount}][id_maquina]" value="${maqId}">
                <input type="hidden" name="itens[${itemCount}][id_formula]" value="${formCode}">
            `;

        // Add ingredients inputs
        currentIngredients.forEach((ing, i) => {
          manInputs += `
                    <input type="hidden" name="itens[${itemCount}][ingredientes][${i}][id_produto]" value="${ing.id_produto}">
                    <input type="hidden" name="itens[${itemCount}][ingredientes][${i}][id_estoque]" value="${ing.id_estoque}">
                    <input type="hidden" name="itens[${itemCount}][ingredientes][${i}][quantidade]" value="${ing.quantidade}">
                `;
        });
      }

      const row = `
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        ${imageSrc ? `<img src="${imageSrc}" class="rounded-circle me-2" width="30" height="30">` : ''}
                        <div>
                            ${prodName}
                            <input type="hidden" name="itens[${itemCount}][id_produto]" value="${prodId}">
                        </div>
                    </div>
                </td>

                <td>
                    <input type="number" class="form-control form-control-sm qty-input" name="itens[${itemCount}][quantidade]" value="${qty}" min="0.01" step="0.01" style="width: 100px;">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm price-input" name="itens[${itemCount}][valor_unitario]" value="${price}" min="0.01" step="0.01" style="width: 120px;">
                </td>
                <td class="item-total">R$ ${total.toFixed(2).replace('.', ',')}</td>
                <td>${manDetails}${manInputs}</td>
                <td><button type="button" class="btn btn-sm btn-danger btn-remove"><i class="ri-delete-bin-line"></i></button></td>
            </tr>
        `;

      tableBody.insertAdjacentHTML('beforeend', row);
      itemCount++;

      // Reset Inputs
      qtyInp.value = 1;
      manCheck.checked = false;
      manPanel.style.display = 'none';
      document.getElementById('formula_input').value = '';
      document.getElementById('maquina_selector').value = '';

      // Clear Ingredients
      currentIngredients = [];
      renderIngredients();

      updateTotal();
    });

    tableBody.addEventListener('click', function(e) {
      if (e.target.closest('.btn-remove')) {
        e.target.closest('tr').remove();
        updateTotal();
      }
    });

    // Auto-recalculate on input change
    tableBody.addEventListener('input', function(e) {
      if (e.target.classList.contains('qty-input') || e.target.classList.contains('price-input')) {
        const row = e.target.closest('tr');
        updateRowTotal(row);
        updateTotal();
      }
    });

    function updateRowTotal(row) {
      const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
      const price = parseFloat(row.querySelector('.price-input').value) || 0;
      const total = qty * price;
      row.querySelector('.item-total').innerText = 'R$ ' + total.toFixed(2).replace('.', ',');
    }

    function updateTotal() {
      let total = 0;
      document.querySelectorAll('.item-total').forEach(td => {
        total += parseFloat(td.innerText.replace('R$ ', '').replace('.', '').replace(',', '.'));
      });
      grandTotalEl.innerText = 'R$ ' + total.toFixed(2).replace('.', ',');
    }
  });
</script>
