$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

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
        const data = {};
        let column = _this.data('column');
        if (column) {
            data.column = column;
        }
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function () {
                if (_this.hasClass('icon-check')) {
                    _this.removeClass('icon-check text-green').addClass('icon-close text-danger');
                } else {
                    _this.removeClass('icon-close text-danger').addClass('icon-check text-green');
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

function navigate(callback) {
    $('.pagination a').off('click');
    $('.pagination a').on('click', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let perpage = $('.perpage').val();
        callback(page, perpage);
    });
}

function changePerpage(callback) {
    $('.perpage').off('change');
    $('.perpage').on('change', function () {
        let page = 1;
        let perpage = $(this).val();
        callback(page, perpage);
    });
}

function search(callback) {
    $('.filter').off('keyup');
    $('.filter').on('keyup', _.debounce(function () {
        let page = 1;
        let perpage = $('.perpage').val();
        callback(page, perpage);
    }, 500));
}

function searchButton(callback) {
    $(document).off('keyup');
    $(document).on('keyup', function (e) {
        if (e.keyCode == 13) {
            $('.search-button').click();
        }
    });
    $('.search-button').off('click');
    $('.search-button').on('click', function () {
        callback(1, $('.perpage').val());
    });
}

function select2Subjects(container = '#select_subjects') {
    let selectedSubjects = $(container).val();
    $(container).select2({
        width: '100%',
        ajax: {
            url: '/admin/subjects',
            delay: 300,
            data: function (params) {
                return {
                    text: params.term, // search term
                    page: params.page,
                    is_select2: true
                };
            },
            processResults: function (data, params) {
                data = data.subjects;
                let subjects = data.data;
                const resData = [];
                for (let i = 0; i < subjects.length; i++) {
                    resData.push({
                        id: subjects[i].id,
                        text: subjects[i].name,
                        selected: selectedSubjects.includes(subjects[i].id)
                    });
                }
                return {
                    results: resData,
                    pagination: {
                        more: data.current_page < data.last_page
                    }
                };
            },
            cache: true
        },
    });
}

