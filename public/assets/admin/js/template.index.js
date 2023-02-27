$(document).ready(function () {
    $("#import-modal").on("show.bs.modal", function () {
        $(".file").val("");
        $(".name").val("");
        $(".description").val("");
        $(".categories").val("[]");
    });
    $("#template-detail-modal").on("hide.bs.modal", function () {
        $(".file").val("");
        $(".temp-name").val("");
        $(".temp-description").val("");
        $(".temp-categories").val("[]");
    });

    $("#template-detail-modal").on("show.bs.modal", function () {
        var templateId = $(this).data("id");
        $(".download-link").attr(
            "href",
            "/admin/template/download/" + templateId
        );
    });

    importTemplate();
    editTemplate();
    updateTemplate();
    deleteTemplate();
    changeStatus();
});

function editTemplate() {
    $(".template-img").off("click");
    $(".template-img").on("click", function (e) {
        e.preventDefault();
        let _modal = $("#template-detail-modal");
        _modal.data("id", $(this).parents(".template").data("id"));
        let _url = $(this).parents(".template").data("url");
        $.ajax({
            url: _url,
            success: function (template) {
                _modal.find(".temp-categories").val(template.categories);
                _modal.find(".temp-name").val(template.name);
                _modal.find(".temp-description").val(template.description);
                _modal.modal("show");
            },
        });
    });
}

function updateTemplate() {
    $(".save-button").off("click");
    $(".save-button").on("click", function (e) {
        e.preventDefault();
        let _id = $("#template-detail-modal").data("id");

        let _file = $(".temp-file")[0].files[0];
        let _name = $(".temp-name").val();
        let _des = $(".temp-description").val();
        let _cats = $(".temp-categories").val();

        if (!_name || !_cats) {
            return;
        }

        let _formData = new FormData();
        _formData.append("name", _name);
        _formData.append("description", _des);
        _formData.append("_method", "PUT");
        if (_file) {
            _formData.append("file", _file);
        }
        for (let i = 0; i < _cats.length; i++) {
            _formData.append("categories[]", _cats[i]);
        }

        $("#template-detail-modal").modal("hide");
        Swal.fire({
            title: "Please wait...",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        $.ajax({
            url: `/admin/template/${_id}`,
            method: "POST",
            processData: false,
            contentType: false,
            data: _formData,
            success: function (template) {
                Swal.close();
                $(".template").each(function () {
                    if ($(this).data("id") == _id) {
                        $(this)
                            .find("img")
                            .attr("src", `/storage/${template.avatar}`);
                        $(this).find(".card-title").text(template.name);
                    }
                });
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Success !",
                    showConfirmButton: false,
                    timer: 1500,
                });
                editTemplate();
            },
            error: function (e) {
                console.log(e);
                Swal.close();
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: e.responseJSON.message,
                });
            },
        });
    });
}

function changeStatus() {
    $("input[type=checkbox]").on("change", function () {
        let _id = $(this).parents(".template").data("id");

        let _is_public = 0;
        if ($(this).prop("checked") == true) {
            _is_public = 1;
        }

        let formData = new FormData();
        formData.append("is_public", _is_public);
        formData.append("_method", "PUT");

        $.ajax({
            url: `/admin/template/${_id}`,
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function () {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Success !",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
            error: function (e) {
                Swal.close();
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: e.responseJSON.message,
                });
            },
        });
    });
}

function deleteTemplate() {
    $(".delete-button").off("click");
    $(".delete-button").on("click", function (e) {
        e.preventDefault();
        let _id = $("#template-detail-modal").data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "red",
            cancelButtonColor: "gray",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/template/${_id}`,
                    method: "DELETE",
                    success: function () {
                        $("#template-detail-modal").modal("hide");
                        $(".template").each(function () {
                            if ($(this).data("id") == _id) {
                                $(this).remove();
                            }
                        });
                        Swal.fire(
                            "Deleted!",
                            "Your template has been deleted.",
                            "success"
                        );
                    },
                });
            }
        });
    });
}

function importTemplate() {
    $(".import-button").off("click");
    $(".import-button").on("click", function (e) {
        e.preventDefault();

        let _file = $(".file")[0].files[0];
        let _name = $(".name").val();
        let _des = $(".description").val();
        let _cats = $(".categories").val();

        if (!_file || !_name || !_cats) {
            return;
        }

        let _formData = new FormData();
        _formData.append("file", _file);
        _formData.append("name", _name);
        _formData.append("description", _des);

        for (let i = 0; i < _cats.length; i++) {
            _formData.append("categories[]", _cats[i]);
        }

        $("#import-modal").modal("hide");
        Swal.fire({
            title: "Please wait...",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        $.ajax({
            url: `/admin/template`,
            method: "POST",
            processData: false,
            contentType: false,
            data: _formData,
            success: function (template) {
                Swal.close();
                let html = `<div class="col-md-6 col-lg-4 template" data-id="${template.id}" data-url="/admin/template/${template.id}/edit">
                                <div class="card" style="margin-bottom: 0 !important;">
                                    <span class="public" style="position: absolute; right: 0;">
                                        <input type="checkbox" class="is_public" checked>
                                    </span>
                                    <img class="img-fluid template-img" src="/storage/${template.avatar}">
                                </div>
                                <div class="card-body">
                                    <div class="card-title text-center">${template.name}</div>
                                </div>
                            </div>`;
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Success !",
                    showConfirmButton: false,
                    timer: 1500,
                });
                $(".templates").prepend(html);
                editTemplate();
                changeStatus();
            },
            error: function (e) {
                console.log(e);
                Swal.close();
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: e.responseJSON.message,
                });
            },
        });
    });
}
