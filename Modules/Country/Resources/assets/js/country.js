$(document).ready(function () {
    //Datatable ajax
    $("#ajax-datatable-country").DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#route_datatable_country").val(),
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "action", orderable: false, searchable: false },
        ],
    });
});
