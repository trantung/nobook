`require('./core')`;

$(document).ready(function () {
    $('#category-detail-modal').on('hide.bs.modal', function () {
        $('.avatar').val('');
        $('.name').val('');
        $('.description').val('');
        $(this).data('id', '');
    });
    openModalAddCategory();
    storeOrUpdateCategory();
    makeTableOrderable('/admin/category/reorder');
    editCategory();
    deleteCategory();
});

function editCategory() {
    $('.category-name').off('click');
    $('.category-name').on('click', function (e) {
        e.preventDefault();

        $('.delete-button').removeClass('d-none');
        let url = $(this).parent('tr').data('edit');
        let modal = $('#category-detail-modal');

        $.ajax({
            url: url,
            success: function (data) {
                modal.find('.fileinput-new').find('img').attr('src', data.avatar);
                modal.find('.name').val(data.name);
                modal.find('.description').val(data.description);
                modal.data('id', data.id);
                modal.find('.modal-title').text('Edit category');
                modal.modal('show');
            }
        });

        modal.find('.avatar').val('');
        modal.find('.name').val('');
        modal.find('.description').val('');
    });
}

function openModalAddCategory() {
    $('.add-category').off('click');
    $('.add-category').on('click', function (e) {
        e.preventDefault();
        if (! $('.delete-button').hasClass('d-none')) {
            $('.delete-button').addClass('d-none');
        }

        let modal = $('#category-detail-modal');
        modal.find('.modal-title').text('Add package');
        modal.modal('show');
    });
}

function storeOrUpdateCategory() {
    $('.save-button').off('click');
    $('.save-button').on('click', function (e) {
        e.preventDefault();

        let avatar = $('.avatar')[0].files[0];
        let name = $('.name').val();
        let description = $('.description').val();
        let _id = $('#category-detail-modal').data('id');

        if ( !name) {
            return;
        }

        let _formData = new FormData();
        _formData.append('avatar', avatar);
        _formData.append('name', name);
        _formData.append('description', description);

        $('#category-detail-modal').modal('hide');
        Swal.fire({
            title: 'Please wait...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        if (! _id) {
            $.ajax({
                url: `/admin/category`,
                method: 'POST',
                processData: false,
                contentType: false,
                data: _formData,
                success:function (data) {
                    Swal.close();

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Success !',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    let html = `
                        <tr
                            class="category-info"
                            data-id="${data.id}"
                            id="${data.id}"
                            data-edit="/admin/category/${data.id}/edit"
                        >
                            <td class="handle"
                                style="padding-top: 0 !important;padding-bottom: 0 !important;width: 55px;cursor: pointer;"
                                data-toggle="tooltip"
                                data-placement="left"
                                title="Hold to sort"
                            >
                                <i class="icon-list" style="font-size: 25px"></i>
                            </td>
                            <td class="category-name" style="cursor: pointer;">${data.name ?? ''}</td>
                            <td class="text-center category-description">${data.description ?? ''}</td>
                            <td class="text-center category-created_at">${data.created_at ?? ''}</td>
                        </tr>
                    `;

                    $('tbody').prepend(html);
                    makeTableOrderable('/admin/category/reorder');
                    editCategory();
                }
            });
        } else {
            _formData.append('_method', 'PUT');

            $.ajax({
                url: `/admin/category/${_id}`,
                method: 'POST',
                processData: false,
                contentType: false,
                data: _formData,
                success: function (data) {
                    Swal.close();

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Success !',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('.category-info').each(function () {
                        if ($(this).data('id') == _id) {
                            $(this).find('.category-name').text(data.name);
                            $(this).find('.category-description').text(data.description);
                        }
                    });
                }
            });
        }
    });
}

function deleteCategory() {
    $('.delete-button').off('click');
    $('.delete-button').on('click', function (e) {
        e.preventDefault();

        let modal = $('#category-detail-modal');
        let id = modal.data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'gray',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/category/${id}`,
                    method: 'DELETE',
                    success: function () {
                        modal.modal('hide');
                        $('.category-info').each(function () {
                            if ($(this).data('id') == id) {
                                $(this).remove();
                            }
                        });
                        Swal.fire(
                            'Deleted!',
                            'Your template has been deleted.',
                            'success'
                        )
                    },
                    error: function (res) {
                        modal.modal('hide');
                        if (res.status == 406) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Cannot delete this item !!!',
                            })
                        }
                    }
                });
            }
        })
    });
}
