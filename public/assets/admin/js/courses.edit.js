$(document).ready(function () {
    makeTableOrderable($('.table-data').data('order'));
    makeItemCanUpdateStatus();
    makeRecordCanDelete();
    select2FlexData('#select_subjects2', '/admin/subjects', 'subjects', {}, 'Chọn môn học');
    const func = function (page) {
        getTeachersData(page);
    };
    search(func);
    navigate(func);
});

// function addTeacher() {
//     $('.add_teacher').off('click');
//     $('.add_teacher').on('click', function () {
//         const _select = $('#select_teachers');
//         if (!_select.val().length) {
//             toastr.error('Vui lòng chọn giáo viên!', failTitle);
//             return;
//         }
//         const subjectIds = _select.val();
//
//         $.ajax({
//             url: $(this).data('href'),
//             method: 'POST',
//             data: {
//                 'teacher_ids': subjectIds
//             },
//             success: function (res) {
//                 toastr.success(defaultSuccessMess, successTitle);
//                 _select.val([]);
//                 _select.trigger('change');
//                 $('.teacher-data').html(res);
//             },
//             error: function () {
//                 toastr.error(defaultFailMess, failTitle);
//             }
//         });
//     });
// }

function getTeachersData(page) {
    let text = $('.filter-teachers').val();
    let link = $('.teacher_modal_data').data('link');
    let subjects = $('#select_subjects2').val();
    let _url = `${link}?page=${page}`;
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
            search(func);
            navigate(func);
        }
    });
}
