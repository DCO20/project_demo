@if ($show ?? false)
<div class="row row-purveyor">

    {{-- Fornecedor --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Fornecedor:</label>
            <input type="text" name="products[{{ $purveyor_index }}][purveyor_id]" class="form-control" value="{{ $item->purveyor->name }}" readonly>
        </div>
    </div>

    {{-- Categoria --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Categoria:</label>
            <input type="text" name="products[{{ $purveyor_index }}][category_id]" class="form-control" value="{{ $item->category->name }}" readonly>
        </div>
    </div>

    {{-- Produto --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Produto:</label>
            <input type="text" name="products[{{ $purveyor_index }}][product_id]" class="form-control" value="{{ $item->product->name }}" readonly>
        </div>
    </div>

    {{-- Valor do produto --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Valor do Produto:</label>
            <input type="text" class="form-control" name="products[{{ $purveyor_index }}][price]" value="{{ $item->formatted_price }}" readonly>
        </div>
    </div>

    {{-- Quantidade --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Quantidade:</label>
            <input type="number" min="1" class="form-control" name="products[{{ $purveyor_index }}][amount]" value="{{ $item->amount }}" readonly>
        </div>
    </div>

    {{-- Total --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Total dos Produtos:</label>
            <input type="text" class="form-control sum-total" readonly value="{{ $item->total() }}">
        </div>
    </div>
</div>

@elseif($suit ?? false)

<input type="hidden" name="products[{{ $purveyor_index }}][id]" value="{{ $item->id }}">

<div class="row row-purveyor">

    {{-- Fornecedor --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Fornecedor:<span class="text-danger">*</span></label>
            <select name="products[{{ $purveyor_index }}][purveyor_id]" class="form-control select2 select-purveyor" required>
                <option value="">Selecione</option>
                <option value="{{ $item->purveyor->id }}" selected>{{ $item->purveyor->name }}</option>

                @foreach ($suit->filterPurveyor($item) as $purveyor)

                <option value="{{ $purveyor->id }}">{{ $purveyor->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    {{-- Categoria --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Categoria:<span class="text-danger">*</span></label>
            <select name="products[{{ $purveyor_index }}][category_id]" class="form-control select2 select-category" required>
                <option value="">Selecione</option>
                <option value="{{ $item->category->id }}" selected>{{ $item->category->name }}</option>

                @foreach ($suit->filterCategory($item) as $category)

                <option value="{{ $category->id }}">{{ $category->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    {{-- Produto --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Produto:<span class="text-danger">*</span></label>
            <select name="products[{{ $purveyor_index }}][product_id]" class="form-control select2 select-product" required>
                <option value="">Selecione</option>
                <option value="{{ $item->product->id }}" selected>{{ $item->product->name }}</option>

                @foreach ($suit->filterProduct($item) as $product)

                <option value="{{ $product->id }}">{{ $product->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    {{-- Valor do produto --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Valor do Produto:</label>
            <input type="text" class="form-control price" name="products[{{ $purveyor_index }}][price]" value="{{ $item->formatted_price }}" readonly>
        </div>
    </div>

    {{-- Quantidade --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Quantidade:<span class="text-danger">*</span></label>
            <input type="number" min="1" class="form-control amount" name="products[{{ $purveyor_index }}][amount]" value="{{ $item->amount }}" required>
        </div>
    </div>

    {{-- Total --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Total dos Produtos:</label>
            <input type="text" class="form-control sum-total" value="{{ $item->total() }}" readonly>
        </div>
    </div>

    @if ($purveyor_index != 0)

    <div class="col-md-12 text-right">
        <div class="form-group">
            <a class="btn btn-link remove-purveyor">Remover</a>
        </div>
    </div>

    @endif

</div>

@else

<div class="row row-purveyor">

    {{-- Fornecedor --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Fornecedor:<span class="text-danger">*</span></label>
            <select name="products[{{ $purveyor_index }}][purveyor_id]" class="form-control select2 select-purveyor">

                <option value="">Selecione ..</option>

                @foreach ($purveyors as $purveyor)

                <option value="{{ $purveyor->id }}">{{ $purveyor->name }}</option>

                @endforeach

            </select>
        </div>
    </div>

    {{-- Categoria --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Categoria:<span class="text-danger">*</span></label>
            <select name="products[{{ $purveyor_index }}][category_id]" class="form-control select2 select-category" readonly></select>
        </div>
    </div>

    {{-- Produto --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Produto:<span class="text-danger">*</span></label>
            <select name="products[{{ $purveyor_index }}][product_id]" class="form-control select2 select-product" readonly></select>
        </div>
    </div>

    {{-- Valor do produto --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Valor do Produto:</label>
            <input type="text" class="form-control price" name="products[{{ $purveyor_index }}][price]" readonly>
        </div>
    </div>

    {{-- Quantidade --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Quantidade:<span class="text-danger">*</span></label>
            <input type="number" min="1" class="form-control amount" name="products[{{ $purveyor_index }}][amount]" required>
        </div>
    </div>

    {{-- Total --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Total dos Produtos:</label>
            <input type="text" class="form-control sum-total" readonly>
        </div>
    </div>

    @if ($purveyor_index != 0)

    <div class="col-md-12 text-right">
        <div class="form-group">
            <a class="btn btn-link remove-purveyor">Remover</a>
        </div>
    </div>

    @endif

</div>


@endif