$(document).ready(function () {
    addTeacher();
    makeTableOrderable($('.table-data').data('order'));
    makeItemCanUpdateStatus();
    makeRecordCanDelete();
});

function addTeacher() {
    $('.add_teacher').off('click');
    $('.add_teacher').on('click', function () {
        const _select = $('#select_teachers');
        if (!_select.val().length) {
            toastr.error('Vui lòng chọn giáo viên!', failTitle);
            return;
        }
        const subjectIds = _select.val();

        $.ajax({
            url: $(this).data('href'),
            method: 'POST',
            data: {
                'teacher_ids': subjectIds
            },
            success: function (res) {
                toastr.success(defaultSuccessMess, successTitle);
                _select.val([]);
                _select.trigger('change');
                $('.teacher-data').html(res);
            },
            error: function () {
                toastr.error(defaultFailMess, failTitle);
            }
        });
    });
}
