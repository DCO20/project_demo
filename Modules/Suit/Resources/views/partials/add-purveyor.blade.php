<div class="row">

    {{-- Fornecedor --}}
    <div class="col-md-3">
        <div class="form-group">
            <label>Fornecedor:<span class="text-danger">*</span></label>
            <select name="status" class="form-control select2" style="width: 100%;" required>

                <option value="">Selecione</option>

            </select>
        </div>
    </div>

    {{-- Categoria --}}
    <div class="col-md-3">
        <div class="form-group">
            <label>Categoria:<span class="text-danger">*</span></label>
            <select name="status" class="form-control select2" style="width: 100%;" disabled>

                <option value="">Selecione</option>

            </select>
        </div>
    </div>

    {{-- Produto --}}
    <div class="col-md-3">
        <div class="form-group">
            <label>Produto:<span class="text-danger">*</span></label>
            <select name="status" class="form-control select2" style="width: 100%;" disabled>

                <option value="">Selecione</option>

            </select>
        </div>
    </div>

    {{-- Preço --}}
    <div class="col-md-1">
        <div class="form-group">
            <label>Preço:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="0.00" readonly>
        </div>
    </div>

    {{-- Quantidade --}}
    <div class="col-md-1">
        <label>Quantidade:<span class="text-danger">*</span></label>
        <div class="form-group">
            <input type="number" min="1" class="form-control" placeholder="qtd">
        </div>
    </div>

    {{-- Remover Fornecedor --}}
    <div class="col-md-12 text-right">
        <div class="form-group">
            <a href="javascript:void(0)" class="text-secondary remove-purveyor" style="text-decoration: underline;">Remover</a>
        </div>
    </div>

</div>
