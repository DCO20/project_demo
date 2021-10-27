<div class="row row-purveyor">

    {{-- Fornecedor --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Fornecedor:<span class="text-danger">*</span></label>
            <select name="purveyors[]" class="form-control select2 select-purveyor" style="width: 100%;" required>

                <option value="">Selecione</option>

                @foreach ($purveyors as $purveyor)
                    ​
                    <option value="{{ $purveyor->id }}">{{ $purveyor->name }}</option>
                    ​
                @endforeach

            </select>
        </div>
    </div>

    {{-- Categoria --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Categoria:<span class="text-danger">*</span></label>
            <select name="categories[]" class="form-control select2 select-category" style="width: 100%;" disabled>

                <option value="">Selecione</option>

            </select>
        </div>
    </div>

    {{-- Produto --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Produto:<span class="text-danger">*</span></label>
            <select name="products[]" class="form-control select2 select-product" style="width: 100%;" disabled>

                <option value="">Selecione</option>

            </select>
        </div>
    </div>

    {{-- Preço --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>Preço:</label>
            <input name="price[]" type="text" class="form-control data-price" placeholder="R$ 0,00" readonly>
        </div>
    </div>

    {{-- Quantidade --}}
    <div class="col-md-2">
        <label>Quantidade:<span class="text-danger">*</span></label>
        <div class="form-group">
            <input name="amount[]" type="number" min="1" class="form-control amount-product" required>
        </div>
    </div>

    {{-- Total --}}
    <div class="col-md-2 text-center">
        <label>Total:</label>
        <div class="form-group">
            <input type="text" name="total" class="form-control total" placeholder="R$ 0,00">
        </div>
    </div>

    @if ($purveyor_index != 0)

        {{-- Remover Fornecedor --}}
        <div class="col-md-12 text-right">
            <div class="form-group">
                <a href="javascript:void(0)" class="text-secondary remove-purveyor" style="text-decoration: underline;">Remover</a>
            </div>
        </div>

    @endif

</div>

@section('footer-extras')
    <script src="{{ mix('js/suit.js') }}"></script>
@endsection
