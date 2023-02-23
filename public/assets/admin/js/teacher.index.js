$(document).ready(function () {
    const func = function (page, perpage) {
        getData(page, perpage);
    };
    changePerpage(func);
    search(func);
    navigate(func);
    makeItemCanUpdateStatus();
    makeRecordCanDelete();
});

function getData(page, perpage = 10) {
    let text = $('.filter').val();
    let link = $('.table-data').data('link');
    let _url = `${link}?page=${page}&perpage=${perpage}`;
    if (text) {
        _url += `&text=${text}`;
    }
    $.ajax({
        url: _url,
        success: function(data) {
            $('.table-data').html(data);
            const func = function (page, perpage) {
                getData(page, perpage);
            };
            changePerpage(func);
            search(func);
            navigate(func);
            makeItemCanUpdateStatus();
            makeRecordCanDelete();
        }
    });
}
