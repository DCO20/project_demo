$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/pt-br.json",
        searched_city = "",
        contact = 1;

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------

    $(".mask-cnpj").mask("00.000.000/0000-00", { reverse: true });

    $(".mask-zipcode").mask("00000-000", { reverse: true });

    $(".mask-phone-cell").mask("(00) 00000-0000");

    $("#summernote").summernote();

    $("#summernote-disable").summernote("disable");

    $(".select2").select2();

    $(".add_contact").click(function () {
        contact++;

        $(".contact").append(
            '<div class="row">' +
                '<div class="col-md-3">' +
                '<div class= "form-group">' +
                '<label> Telefone: <span class="text-danger">*</span></label>' +
                '<input type = "text" name= "phones[1][number]" class= "form-control mask-phone-cell" required>' +
                "</div></div>" +
                '<div class= "col-md-3">' +
                '<div class= "form-group">' +
                '<label> Tipo: <span class="text-danger">*</span></label>' +
                '<select name="phones[1][phone_type]" class="form-control" style="width: 100% !important" required="">' +
                '<option value = "" > Selecione</option><option value="residential">Residencial</option> ' +
                '<option value="commercial">Comercial</option>' +
                '<option value="cellphone">Celular</option> ' +
                "</select></div></div>" +
                '<div class= "col-md-3">' +
                '<div class="form-group"> ' +
                '<label>E-mail:<span class="text-danger">*</span></label>' +
                '<input type="email" name="emails[1][email]" class="form-control" required>' +
                "</div></div > " +
                '<div class="col-md-3">' +
                '<div class="form-group">' +
                '<label>Tipo:<span class="text-danger">*</span></label>' +
                '<select name="emails[1][email_type]" class="form-control type-email" style="width: 100% !important">' +
                '<option value="">Selecione</option>' +
                '<option value="personal">Pessoal</option>' +
                '<option value="commercial">Comercial</option>' +
                '<option value="other">Outro</option>' +
                "</select></div></div >" +
                '<div class="col-md-12">' +
                '<div><a href="javascript:void(0)" class="text-secondary remove-contact"' +
                'style="text-decoration: underline" > Remover</a>' +
                "</div></div></div> "
        );
    });

    $(document).on("click", ".remove-contact", function () {
        var button_id = $(this).attr("id");
        $("#row" + button_id + "").remove();
    });

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
            { data: "cnpj" },
            { data: "legal_name" },
            { data: "trade_name" },
            { data: "active" },
            { data: "action", orderable: false, searchable: false },
        ],
        language: {
            url: datatable_url,
        },
    });

    //-----------------------------------------------------
    // Defining a function
    //-----------------------------------------------------

    function searchCNPJ() {
        var cnpj = $("#cnpj")
            .val()
            .replace(/[^0-9]/g, "");

        var url = "https://www.receitaws.com.br/v1/cnpj/" + cnpj;

        if (cnpj.length != 14) {
            return false;
        }

        $.ajax({
            url: url,
            crossDomain: true,
            type: "GET",
            dataType: "jsonp",
            success: function (data) {
                if (data.nome == undefined) {
                    $("#message").append(
                        "<p>O cnpj não consta no sistema.</p>"
                    );
                } else {
                    $("#message").hide();
                    $("#legal_name").val(data.nome);
                    $("#trade_name").val(data.fantasia);
                }
            },
        });
    }

    function searchZipCode() {
        var zipcode = $("#cep").val().replace("-", "");

        var url = "https://viacep.com.br/ws/" + zipcode + "/json/";

        if (zipcode.length != 8) {
            return false;
        }

        $.ajax({
            url: url,
            crossDomain: true,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $("#uf")
                    .find("option:contains('" + data.uf + "')")
                    .prop("selected", true)
                    .trigger("change");

                searched_city = data.localidade;

                $("#logradouro").val(data.logradouro);

                $("#bairro").val(data.bairro);
            },
        });
    }

    function loadCities() {
        $("#city").prop("disabled", true);

        $("#city option").remove();

        $("#city").append("<option value=''>Selecione</option>");

        $.ajax({
            url: $("#route_load_address").val(),
            type: "POST",
            data: {
                state_id: $(this).val(),
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
            success: function (cities) {
                $.each(cities, function (key, city) {
                    $("#city").append(
                        '<option value="' +
                            city.id +
                            '">' +
                            city.name +
                            "</option>"
                    );
                });

                if (searched_city != "") {
                    $("#city")
                        .find("option:contains('" + searched_city + "')")
                        .prop("selected", true)
                        .trigger("change");

                    searched_city = "";
                }

                $("#city").prop("disabled", false);

                $("#city").prop("required", true);
            },
        });
    }

    //-----------------------------------------------------
    // Defining a call function
    //-----------------------------------------------------

    $(document).delegate("#cep", "input", searchZipCode);
    $(document).delegate("#cnpj", "input", searchCNPJ);
    $(document).delegate("#uf", "change", loadCities);
});
