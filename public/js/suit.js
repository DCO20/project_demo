$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/traductionBR.json",
        route_add_purveyor = $("input[name='route_add_purveyor']").val(),
        index_purveyor_count =
            $("input[name='index_purveyor_count']").val() || 0;

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------

    $("#summernote").summernote();

    $("#summernote-disable").summernote("disable");

    $(".select2").select2();

    $("#ajax-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#route_datatable").val(),
            type: "POST",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        },
        columns: [
            { data: "id" },
            { data: "note" },
            { data: "status" },
            { data: "date" },
            { data: "action", orderable: false, searchable: false },
        ],
        language: {
            url: datatable_url,
        },
    });

    //-----------------------------------------------------
    // Defining a function
    //-----------------------------------------------------

    /**
     * Adiciona fornecedor
     */
    function addPurveyor() {
        index_purveyor_count++;

        $.ajax({
            url: route_add_purveyor,
            data: {
                index: index_purveyor_count,
            },
            type: "POST",
            dataType: "JSON",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        })
            .done(function (data) {
                if (data && data.success && data.html) {
                    var html = $(data.html);

                    $("#div-purveyors")
                        .append(html)
                        .find(".row-purveyor:last")
                        .show(300);
                }
            })
            .fail(function (xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            });

        calculatorTotal();
    }

    /**
     * Remover fornecedor
     */
    function removePurveyor() {
        $(this).closest(".row-purveyor").remove();

        calculatorTotal();
    }

    /**
     * carrega a categoria
     */
    function loadCategory() {
        var div = $(this).closest(".row-purveyor");

        div.find(".select-category").prop("disabled", false);

        div.find(".select-category").prop("required", true);

        div.find(".select-category option").remove();

        div.find(".select-category").append(
            "<option value=''>Selecione</option>"
        );

        div.find(".select-category").trigger("change");

        div.find(".total").val("");

        $.ajax({
            url: $("#route_load_category").val(),
            data: {
                purveyor_id: $(this).val(),
            },
            type: "POST",
            dataType: "JSON",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        })
            .done(function (categories) {
                $.each(categories, function (key, category) {
                    div.find(".select-category").append(
                        '<option value="' +
                            category.id +
                            '">' +
                            category.name +
                            "</option>"
                    );
                });
            })
            .fail(function (xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            });

        calculatorTotal();
    }

    /**
     * carrega o produto
     */
    function loadProduct() {
        var div = $(this).closest(".row-purveyor");

        div.find(".select-product").prop("disabled", false);

        div.find(".select-product").prop("required", true);

        div.find(".select-product option").remove();

        div.find(".select-product").append(
            "<option value=''>Selecione</option>"
        );
        div.find(".select-product").trigger("change");

        $.ajax({
            url: $("#route_load_product").val(),
            data: {
                category_id: $(this).val(),
            },
            type: "POST",
            dataType: "JSON",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        })
            .done(function (products) {
                $.each(products, function (key, product) {
                    div.find(".select-product").append(
                        '<option value="' +
                            product.id +
                            '" data-price="' +
                            product.price +
                            '">' +
                            product.name +
                            "</option>"
                    );
                });
            })
            .fail(function (xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            });

        calculatorTotal();
    }

    /**
     * obtem o preço do produto
     */
    function dataPrice() {
        var _this = $(this);

        var price =
            _this.val() != "" ? _this.find(":selected").data("price") : 0;

        var formatted_value = formatMoney(price);

        _this.closest(".row-purveyor").find(".data-price").val(formatted_value);
    }

    /**
     * formata o preço do produto
     */
    function formatMoney(value) {
        var converted_price = parseFloat(value);

        var formatted_value = converted_price.toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL",
        });

        return formatted_value;
    }

    /**
     * calcula preço do produto
     */
    function calculatorProduct() {
        var _this = $(this);

        var price = _this.closest(".row-purveyor").find(".data-price").val();

        var total = formatPrice(price) * parseInt(_this.val());

        var formatted_total = formatMoney(total);

        _this.closest(".row-purveyor").find(".total").val(formatted_total);

        calculatorTotal();
    }

    /**
     * calcula o total dos produtos
     */
    function calculatorTotal() {
         var total = 0;  //"1000.00"

        $(".total").each(function () {
            var sum_total = $(this).val();

            var value = sum_total != "" ? formatPrice(sum_total) : 0;

            total += value;
        });

        var formatted_total = formatMoney(total);

        $("#sum-total").val(formatted_total);
    }

    /**
     * formata o total do produto
     */
    function formatPrice(value) {
        var price = value.replace("R$", "").replace(".", "").replace(",", ".");

        return parseFloat(price);
    }

    //-----------------------------------------------------
    // Defining a call function
    //-----------------------------------------------------

    $(document).delegate("#add-purveyor", "click", addPurveyor);
    $(document).delegate(".remove-purveyor", "click", removePurveyor);
    $(document).delegate(".select-purveyor", "change", loadCategory);
    $(document).delegate(".select-category", "change", loadProduct);
    $(document).delegate(".select-product", "change", dataPrice);
    $(document).delegate(".amount-product", "input", calculatorProduct);
});
