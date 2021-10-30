$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/pt-br.json";
        (route_add_purveyor = $("#route_add_purveyor").val()),
        (route_load_category = $("#route_load_category").val()),
        (route_load_product = $("#route_load_product").val()),
        (route_datatable = $("#route_datatable").val()),
        (index_item_count = $("#index_item_count").val() || 0);

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
            url: route_datatable,
            type: "POST",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        },
        columns: [
            { data: "id" },
            { data: "status" },
            { data: "date" },
            { data: "client" },
            { data: "description" },
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
        index_item_count++;

        $.ajax({
            url: route_add_purveyor,
            data: {
                index: index_item_count,
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

                $(".select2").select2();
            })
            .fail(function (xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            });
    }

    function changePurveyor() {
        var div = $(this).closest(".row-purveyor");

        div.find(".select-category")
            .attr("readonly", false)
            .prop("required", true);

        div.find(".select-product")
            .attr("readonly", false)
            .prop("required", true);

        div.find(".sum-total").val("");

        calculateTotal();
    }

    function removePurveyor() {
        var div = $(this).closest(".row-purveyor");

        div.prev().prop("name", "remove_products_ids[]");

        div.remove();

        calculateTotal();
    }

    function loadCategories() {
        var div = $(this).closest(".row-purveyor");

        div.find(".select-category option").remove();

        div.find(".select-category").append(
            '<option value="">Selecione</option>'
        );

        div.find(".select-category").trigger("change");

        $.ajax({
            url: route_load_category,
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
                var select_category = div.find(".select-category");

                $.each(categories, function (key, category) {
                    select_category.append(
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
    }

    function loadProducts() {
        var div = $(this).closest(".row-purveyor");

        div.find(".select-product option").remove();

        div.find(".select-product").append(
            '<option value="">Selecione</option>'
        );

        div.find(".select-product").trigger("change");

        $.ajax({
            url: route_load_product,
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
                var select_product = div.find(".select-product");

                $.each(products, function (key, product) {
                    select_product.append(
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
    }

    function loadPrice() {
        var _this = $(this);

        var price =
            _this.val() != "" ? _this.find(":selected").data("price") : 0;

        var formatted_value = formatMoney(price);

        _this.closest(".row-purveyor").find(".price").val(formatted_value);
    }

    function formatMoney(value) {
        var converted_price = parseFloat(value);

        var formatted_value = converted_price.toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL",
        });

        return formatted_value;
    }

    function formatPrice(value) {
        var price = value.replace("R$", "").replace(".", "").replace(",", ".");

        return parseFloat(price);
    }

    function calculateProduct() {
        var _this = $(this);

        var price = _this.closest(".row-purveyor").find(".price").val();

        var total = formatPrice(price) * parseInt(_this.val());

        var formatted_total = formatMoney(total);

        _this.closest(".row-purveyor").find(".sum-total").val(formatted_total);

        calculateTotal();
    }

    function calculateTotal() {
        var total = 0; //"1000.00"

        $(".sum-total").each(function () {
            var sum_total = $(this).val();

            var value = sum_total != "" ? formatPrice(sum_total) : 0;

            total += value;
        });

        var formatted_total = formatMoney(total);

        $("#total").val(formatted_total);
    }

    //-----------------------------------------------------
    // Defining a call function
    //-----------------------------------------------------
    $(document).delegate("#add-purveyor", "click", addPurveyor);
    $(document).delegate(".remove-purveyor", "click", removePurveyor);
    $(document).delegate(".select-purveyor", "change", changePurveyor);
    $(document).delegate(".select-purveyor", "change", loadCategories);
    $(document).delegate(".select-category", "change", loadProducts);
    $(document).delegate(".select-product", "change", loadPrice);
    $(document).delegate(".amount", "input", calculateProduct);
});
