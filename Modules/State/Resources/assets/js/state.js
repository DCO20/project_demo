$(document).ready(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------
    var token = $("input[name='_token']").val();
    var datatable_url = window.state.origin + "/datatable/pt-br.json";

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------
    $("#ajax-datatable-state").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#route_datatable_state").val(),
            type: "POST",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "initial" },
            { data: "action", orderable: false, searchable: false },
        ],
        language: {
            url: datatable_url,
        },
    });
});
