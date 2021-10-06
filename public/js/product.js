$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/pt-br.json";

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------

    $(".money").mask("0.000.000.000,00", {
        reverse: true,
        placeholder: "R$ 0,00",
    });

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
            { data: "name" },
            { data: "active" },
            { data: "price" },
            { data: "category" },
            { data: "description" },
            { data: "action", orderable: false, searchable: false },
        ],
        language: {
            url: datatable_url,
        },
    });
});
