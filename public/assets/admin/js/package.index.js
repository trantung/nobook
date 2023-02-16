`require('./core')`;

$(document).ready(function () {
    $('#package-detail-modal').on('hide.bs.modal', function () {
        $('.avatar').val('');
        $('.name').val('');
        $('.description').val('');
        $('.time').val('');
        $('.price').val('');
        $(this).data('id', '');
    });
    $('.price').on('keyup', function () {
        $(this).val(accounting.formatNumber($(this).val()));
    });
    openModalAddPackage();
    storeOrUpdatePackage();
    makeTableOrderable('/admin/package/reorder');
    editPackage();
    deletePackage();
});

function editPackage() {
    $('.package-name').off('click');
    $('.package-name').on('click', function (e) {
        e.preventDefault();

        $('.delete-button').removeClass('d-none');
        let modal = $('#package-detail-modal');
        let url = $(this).parent('tr').data('edit');

        $.ajax({
            url: url,
            success: function (data) {
                modal.find('.fileinput-new').find('img').attr('src', data.avatar);
                modal.find('.name').val(data.name);
                modal.find('.description').val(data.description);
                modal.find('.time').val(data.time);
                modal.find('.price').val(accounting.formatNumber(data.price));
                modal.find('.type').val(data.type);
                modal.data('id', data.id);
                modal.find('.modal-title').text('Edit package');
                modal.modal('show');
            }
        });

        modal.find('.avatar').val('');
        modal.find('.name').val('');
        modal.find('.description').val('');
        modal.find('.time').val('');
        modal.find('.price').val('');
    });
}

function openModalAddPackage() {
    $('.add-package').off('click');
    $('.add-package').on('click', function (e) {
        e.preventDefault();
        if (! $('.delete-button').hasClass('d-none')) {
            $('.delete-button').addClass('d-none');
        }

        let modal = $('#package-detail-modal');
        modal.find('.modal-title').text('Add package');
        modal.modal('show');
    });
}

function storeOrUpdatePackage() {
    $('.save-button').off('click');
    $('.save-button').on('click', function (e) {
        e.preventDefault();

        let avatar = $('.avatar')[0].files[0];
        let name = $('.name').val();
        let description = $('.description').val();
        let time = $('.time').val();
        let price = $('.price').val();
        let type = $('.type').val();
        let _id = $('#package-detail-modal').data('id');

        if ( ! name || ! time || ! price) {
            return;
        }

        let _formData = new FormData();
        _formData.append('avatar', avatar);
        _formData.append('name', name);
        _formData.append('description', description);
        _formData.append('time', time);
        _formData.append('price', accounting.unformat(price));
        _formData.append('type', type);

        $('#package-detail-modal').modal('hide');
        Swal.fire({
            title: 'Please wait...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        if (! _id) {
            $.ajax({
                url: `/admin/package`,
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
                            class="package-info"
                            data-id="${data.id}"
                            id="${data.id}"
                            data-edit="/admin/package/${data.id}/edit"
                            data-delete="/admin/package/${data.id}"
                        >
                            <td class="handle"
                                style="padding-top: 0 !important;padding-bottom: 0 !important;width: 55px;cursor: pointer;"
                                data-toggle="tooltip"
                                data-placement="left"
                                title="Hold to sort"
                            >
                                <i class="icon-list" style="font-size: 25px"></i>
                            </td>
                            <td class="package-name" style="cursor: pointer;">${data.name ?? ''}</td>
                            <td class="text-center package-price">${accounting.formatNumber(data.price ?? 0)} $</td>
                            <td class="text-center package-time">${data.time ?? ''}</td>
                            <td class="text-center package-time">${data.type == 0 ? 'Employee' : 'Member'}</td>
                            <td class="text-center package-created_at">${data.created_at ?? ''}</td>
                        </tr>
                    `;

                    $('tbody').prepend(html);
                    makeTableOrderable('/admin/package/reorder');
                    editPackage();
                }
            });
        } else {
            _formData.append('_method', 'PUT');

            $.ajax({
                url: `/admin/package/${_id}`,
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

                    let packageType = data.type == 0 ? "Employee" : "Member";
                    
                    $('.package-info').each(function () {
                        if ($(this).data('id') == _id) {
                            $(this).find('.package-name').text(data.name);
                            $(this).find('.package-price').text(accounting.formatNumber(data.price) + ' $');
                            $(this).find('.package-time').text(data.time);
                            $(this).find('.package-type').text(packageType);
                        }
                    });
                }
            });
        }
    });
}

function deletePackage() {
    $('.delete-button').off('click');
    $('.delete-button').on('click', function (e) {
        e.preventDefault();

        let modal = $('#package-detail-modal');
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
                    url: `/admin/package/${id}`,
                    method: 'DELETE',
                    success: function () {
                        modal.modal('hide');
                        $('.package-info').each(function () {
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
