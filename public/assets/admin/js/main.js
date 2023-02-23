$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('.select2').select2({'width': '100%'});
});

toastr.options = {
    timeOut: 5e3,
    closeButton: !0,
    debug: !1,
    newestOnTop: !0,
    progressBar: !0,
    positionClass: "toast-top-right",
    preventDuplicates: !0,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
    tapToDismiss: !1,
}
const successTitle = 'Thành công!';
const failTitle = 'Có lỗi xảy ra!';
const defaultSuccessMess = 'Thao tác thành công!';
const defaultFailMess = 'Thao tác thất bại!';

function makeTableOrderable(orderUrl) {
    $('.sort').sortable({
        handle: ".handle",
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        update: function update(event, ui) {
            let sort = $(this).sortable("toArray");
            $.ajax({
                url: orderUrl,
                method: "POST",
                data: {
                    sort: sort
                },
                success: function () {
                    toastr.success(defaultSuccessMess, successTitle);
                },
                error: function () {
                    toastr.error(defaultFailMess, failTitle);
                }
            });
        }
    });
}

function makeItemCanUpdateStatus(containerClass = '.change-status') {
    $(containerClass).off('click');
    $(containerClass).on('click', function (e) {
        e.preventDefault();
        let _this = $(this);
        const url = _this.data('url');
        $.ajax({
            url: url,
            method: 'POST',
            success: function () {
                if (_this.hasClass('icon-check')) {
                    _this.removeClass('icon-check').addClass('icon-close');
                } else {
                    _this.removeClass('icon-close').addClass('icon-check');
                }
                toastr.success(defaultSuccessMess, successTitle);
            },
            error: function () {
                toastr.error(defaultFailMess, failTitle);
            }
        });
    });
}

function makeRecordCanDelete(containerClass = '.destroy') {
    $(containerClass).off('click');
    $(containerClass).on('click', function (e) {
        e.preventDefault();
        let _this = $(this);
        const url = _this.data('href');
        Swal.fire({
            title: 'Bạn chắc chứ?',
            text: "Dữ liệu sẽ không thể phục hồi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _method: 'DELETE'
                    },
                    success: function () {
                        _this.parents('tr').remove();
                        Swal.close();
                        toastr.success(defaultSuccessMess, successTitle);
                    },
                    error: function () {
                        Swal.close();
                        toastr.error(defaultFailMess, failTitle);
                    }
                });
            }
        })
    });
}
