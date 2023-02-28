$(document).ready(function () {
    // CKEDITOR.replace('description');
    initSelect2();
});

function initSelect2() {
    select2Subjects();
    $('select[name=type]').select2({
        minimumResultsForSearch: -1
    });
    $('#select_classes').select2();
    $('select[name=method]').select2({
        minimumResultsForSearch: -1
    });

    let selectedCourse = $('#select_lms_courses').val();
    $('#select_lms_courses').select2({
        width: '100%',
        ajax: {
            url: '/admin/courses/lms/list',
            delay: 300,
            data: function (params) {
                return {
                    text: params.term, // search term
                    page: params.page,
                };
            },
            processResults: function (data, params) {
                data = data.courses;
                let courses = data.data;
                const resData = [];
                for (let i = 0; i < courses.length; i++) {
                    resData.push({
                        id: courses[i].id,
                        text: `[${courses[i].id}] ${courses[i].fullname}`,
                        selected: selectedCourse == courses[i].id
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
