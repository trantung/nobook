$(document).ready(function () {
    CKEDITOR.replace('description');
    initSelect2();
    $('#select_subjects').on('change.select2', function () {
        initSelect2();
    });
});

function initSelect2() {
    const customParams = {
        is_for_teacher: true
    };
    if ($('[name=id]').length) {
        customParams.teacher_id = $('[name=id]').val();
    } else {
        customParams.selected_ids = $('#select_subjects').val()
    }
    select2FlexData('#select_subjects', '/admin/subjects', 'subjects', customParams);
}
