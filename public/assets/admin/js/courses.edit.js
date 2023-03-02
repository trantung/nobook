$(document).ready(function () {
    init();
    select2FlexData('#select_subjects2', '/admin/subjects', 'subjects', {}, 'Chọn môn học');
    const func = function (page) {
        getTeachersData(page);
    };
    search(func);
    navigate(func);
    $('#select_subjects2').on('change', function () {
        func(1);
    });
    actionTeacher();
    actionTeacher('.remove_teacher');

    const modal = $('.teachers-modal');
    modal.on('hide.bs.modal', function (e) {
        let container = $('.teacher-data');
        $.ajax({
            url: container.data('url'),
            success: function (res) {
                toastr.success(defaultSuccessMess, successTitle);
                container.html(res);
                modal.modal('hide');
                init();
            },
            error: function () {
                toastr.error(defaultFailMess, failTitle);
            }
        });
    });
});

function init() {
    makeTableOrderable($('.table-data').data('order'));
    makeItemCanUpdateStatus();
    makeRecordCanDelete();
}

function actionTeacher(container = '.add_teacher') {
    $(container).off('click');
    $(container).on('click', function () {
        let _this = $(this);
        $.ajax({
            url: _this.data('href'),
            method: 'POST',
            data: {
                _method: _this.hasClass('remove_teacher') ? 'DELETE' : 'POST',
            },
            success: function () {
                toastr.success(defaultSuccessMess, successTitle);
                _this.addClass('d-none');
                _this.parent('td').find('a').not(_this).removeClass('d-none');
            },
            error: function () {
                toastr.error(defaultFailMess, failTitle);
            }
        });
    });
}

function getTeachersData(page) {
    let text = $('.filter-teachers').val();
    let link = $('.teacher_modal_data').data('link');
    let subjects = $('#select_subjects2').val();
    let _url = `${link}?page=${page}&perpage=5&need_subjects=1`;
    if (text) {
        _url += `&text=${text}`;
    }

    if (subjects.length) {
        subjects = subjects.join(',');
        _url += `&subject_ids=${subjects}`;
    }

    $.ajax({
        url: _url,
        success: function(data) {
            $('.teacher_modal_data').html(data);
            const func = function (page) {
                getTeachersData(page);
            };
            navigate(func);
            actionTeacher();
            actionTeacher('.remove_teacher');
        }
    });
}
