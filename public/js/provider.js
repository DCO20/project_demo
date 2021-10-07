$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/pt-br.json";

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

        if (cnpj.length != 11) {
            var url = "https://www.receitaws.com.br/v1/cnpj/" + cnpj;

            $.ajax({
                url: url,
                crossDomain: true,
                type: "GET",
                dataType: "jsonp",

                success: function (data) {
                    console.log(data);
                    if (data.nome == undefined) {
                        $("#message").append(
                            "<p>O cnpj não consta no sistema.</p>"
                        );
                    } else {
                        $("#corporate_name").val(data.nome);
                        $("#fantasy_name").val(data.fantasia);
                    }
                },
            });
        }
    }

    function searchZipCode() {
        var numZipcode = $("#cep").val().replace("-", "");
        var url = "https://viacep.com.br/ws/" + numZipcode + "/json/";
        $.ajax({
            url: url,
            crossDomain: true,
            type: "GET",
            dataType: "json",

            success: function (data) {
                console.log(data);
                $("#uf").select2("val", data.uf);
                $("#uf").trigger("change");
                $("#logradouro").val(data.logradouro);
                $("#bairro").val(data.bairro);
            },
        });
    }

    $("#uf").on("change", function () {
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

                $("#city").attr("disabled", false);

                $("#city").attr("required", true);
            },
        });
    });

    $(document).delegate("#cep", "input", searchZipCode);
    $(document).delegate("#cnpj", "input", searchCNPJ);
});
