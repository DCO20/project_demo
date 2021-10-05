$(document).ready(function () {
    //Text editor
    $("#summernote").summernote();

    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------
    var token = $("input[name='_token']").val();
    var datatable_url = window.location.origin + "/datatable/pt-br.json";

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------
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
            { data: "description" },
            { data: "action", orderable: false, searchable: false },
        ],
        language: {
            url: datatable_url,
        },
    });
});
