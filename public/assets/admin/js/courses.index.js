$(document).ready(function () {
    const func = function (page) {
        getData(page);
    };
    changePerpage(func);
    search(func);
    navigate(func);
    makeItemCanUpdateStatus();
    makeRecordCanDelete();
    initSelect2();
});

function getData(page) {
    let perpage = $('.perpage').val();
    let text = $('.filter').val();
    let link = $('.table-data').data('link');
    let method = $('#select_method').val();
    let subjects = $('#select_subjects').val();
    let _url = `${link}?page=${page}&perpage=${perpage}`;
    if (text) {
        _url += `&text=${text}`;
    }
    if (method) {
        _url += `&method=${method}`;
    }
    if (subjects.length) {
        subjects = subjects.join(',');
        _url += `&subjects=${subjects}`;
    }
    $.ajax({
        url: _url,
        success: function(data) {
            $('.table-data').html(data);
            const func = function (page) {
                getData(page);
            };
            changePerpage(func);
            search(func);
            navigate(func);
            makeItemCanUpdateStatus();
            makeRecordCanDelete();
        }
    });
}

function initSelect2() {
    $('#select_method').select2({
        minimumResultsForSearch: -1,
    });
    $('#select_method').on('change', function () {
        getData(1);
    });
    $('#select_subjects').on('change', function () {
        getData(1);
    });
    $('#select_subjects').on('select2:change', function () {
        getData(1);
    });
    let selectedSubjects = $('#select_subjects').val();
    $('#select_subjects').select2({
        width: '100%',
        placeholder: 'Chọn môn học',
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
            cache: true,
        },
    });
}
