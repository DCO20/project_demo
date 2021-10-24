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
                    $(".remove").show(300);
                }
            })
            .fail(function (xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            });
    }

    /**
     * Adiciona fornecedor
     */
    function removePurveyor() {
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
                        .remove();
                }
            })
            .fail(function (xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            });
    }

    function changePurveyor() {
        var _this = $(this);

        var row_purveyor = _this.closest(".row-purveyor");

        row_purveyor
            .find(".select-category")
            .attr("disabled", false)
            .prop("required", true);

        row_purveyor
            .find(".select-product")
            .attr("disabled", false)
            .prop("required", true);
    }
    //-----------------------------------------------------
    // Defining a call function
    //-----------------------------------------------------

    $(document).delegate(".add-purveyor", "click", addPurveyor);
    $(document).delegate(".remove-purveyor", "click", removePurveyor);
    $(document).delegate(".select-purveyor", "change", changePurveyor);
});