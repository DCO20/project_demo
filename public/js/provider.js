$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/pt-br.json",
        searched_city = "";

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------

    $(".mask-cnpj").mask("00.000.000/0000-00", { reverse: true });

    $(".mask-zipcode").mask("00000-000", { reverse: true });

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
            { data: "cnpj" },
            { data: "corporate_name" },
            { data: "fantasy_name" },
            { data: "active" },
            { data: "action", orderable: false, searchable: false },
        ],
        language: {
            url: datatable_url,
        },
    });

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

    function searchCity() {
        $("#uf").on("change");
        var token = $("input[name='_token']").val();

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
                $("#city").attr("disabled", true);

                $("#city option").remove();

                $("#city").append("<option>Selecione</option>");

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

    $(document).delegate("#cep", "input", searchZipCode);
    $(document).delegate("#cnpj", "input", searchCNPJ);
    $(document).delegate("#uf", "select", searchCity);
});
