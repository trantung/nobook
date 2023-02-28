$(document).ready(function () {
    CKEDITOR.replace('description');
    initSelect2();
    addSubject();
    makeTableOrderable($('.table-data').data('order'));
    makeRecordCanDelete();
});

function initSelect2() {
    select2Subjects();
}

function addSubject() {
    $('.add_subject').off('click');
    $('.add_subject').on('click', function () {
        const _select = $('#select_subjects');
        if (!_select.val().length) {
            toastr.error('Vui lòng chọn môn học!', failTitle);
            return;
        }
        const subjectIds = _select.val();

        $.ajax({
            url: $(this).data('href'),
            method: 'POST',
            data: {
                'subject_ids': subjectIds
            },
            success: function (res) {
                toastr.success(defaultSuccessMess, successTitle);
                _select.val([]);
                _select.trigger('change');
                $('.subject-data').html(res);
            },
            error: function () {
                toastr.error(defaultFailMess, failTitle);
            }
        });
    });
}
