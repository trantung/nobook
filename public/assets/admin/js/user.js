$(document).ready(function () {
    navigate();
    changePerpage();
    search();
    searchButton();
    initFilterMultiSelectSite();
    multiSelectPackageStatus();
});

function navigate() {
    $('.pagination a').off('click');
    $('.pagination a').on('click', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let perpage = $('.perpage').val();
        getData(page, perpage);
    });
}

function changePerpage() {
    $('.perpage').off('change');
    $('.perpage').on('change', function () {
        let page = 1;
        let perpage = $(this).val();
        getData(page, perpage);
    });
}

function search() {
    $('.filter').off('keyup');
    $('.filter').on('keyup', _.debounce(function () {
        let page = 1;
        let perpage = $('.perpage').val();
        getData(page, perpage);
    }, 500));
}

function searchButton() {
    $(document).off('keyup');
    $(document).on('keyup', function (e) {
        if (e.keyCode == 13) {
            $('.search-button').click();
        }
    });
    $('.search-button').off('click');
    $('.search-button').on('click', function () {
        getData(1, $('.perpage').val());
    });
}

function initFilterMultiSelectSite() {
    if (! $('#select_sites').length) {
        return;
    }

    const sites = $('#select_sites').filterMultiSelect();
    sites.selectAll();
    updateSelectedItem(sites.getSelectedOptionsAsJson(), '.site_selected');

    $('#select_sites').on('optionselected', function(e) {
        updateSelectedItem(sites.getSelectedOptionsAsJson(), '.site_selected');
    });
    $('#select_sites').on('optiondeselected', function(e) {
        updateSelectedItem(sites.getSelectedOptionsAsJson(), '.site_selected');
    });
}

function updateSelectedItem(jsonData, selector) {
    let attr = $(selector).data('name');
    let data = JSON.parse(jsonData)[attr];

    $(selector).val(data);
}

function multiSelectPackageStatus() {
    if (! $('#select_statuses').length) {
        return;
    }

    const statuses = $('#select_statuses').filterMultiSelect({
        placeholderText: 'Select package status'
    });

    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('package_statuses')) {
        statuses.selectOption(searchParams.get('package_statuses'))
    }

    let func = _.debounce(function(e) {
        updateSelectedItem(statuses.getSelectedOptionsAsJson(), '.statuses_selected');
        getData(1, $('.perpage').val());
    }, 400);

    $('#select_statuses').on('optionselected', func);
    $('#select_statuses').on('optiondeselected', func);
}

function getData(page, perpage) {
    let text = $('.filter').val();
    let link = $('.table-data').data('link');
    let search_content = [];
    $('input[type="checkbox"].search_content:checked').each(function () {
        search_content.push($(this).val());
    });

    let _url = `${link}?page=${page}&perpage=${perpage}&text=${text}`;

    if ($('.site_selected').length) {
        let site_ids = $('.site_selected').val();
        _url += `&site_ids=${site_ids}`;
    }

    if ($('.statuses_selected').length) {
        _url += `&package_statuses=` + $('.statuses_selected').val();
    }

    if (search_content) {
        let filter_text = $('.filter-text').val();
        _url += `&search_content=${search_content}&filter_text=${filter_text}`;
    }
    $.ajax({
        url: _url,
        success: function(data) {
            $('.table-data').html(data);
            navigate();
            changePerpage();
            search();
            searchButton();
        }
    });
}
