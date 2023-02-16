$(document).ready(function () {
    // let roleSelect = $('select[name=role_id]');
    // let siteSelect = $('.site');
    //
    // if (roleSelect.val() == 3) {
    //     siteSelect.removeClass('d-none');
    // }
    // roleSelect.on('change', function () {
    //     if ($(this).val() == 3) {
    //         siteSelect.removeClass('d-none');
    //     } else  {
    //         if (!siteSelect.hasClass('d-none')) {
    //             siteSelect.addClass('d-none');
    //         }
    //     }
    // });
    initFilterMultiSelect();
});

function initFilterMultiSelect() {
    if ($('#select_sites').length) {
        const sites = $('#select_sites').filterMultiSelect();

        if ($('.site_selected').attr('value')) {
            let siteSelecteds = $('.site_selected').attr('value').split(', ');
            for (i = 0; i < siteSelecteds.length; i++) {
                sites.selectOption(siteSelecteds[i]);
            }
        }

        updateSelectedItem(sites.getSelectedOptionsAsJson());

        $('#select_sites').on('optionselected', function(e) {
            updateSelectedItem(sites.getSelectedOptionsAsJson());
        });
        $('#select_sites').on('optiondeselected', function(e) {
            updateSelectedItem(sites.getSelectedOptionsAsJson());
        });
    }
}

function updateSelectedItem(jsonData) {
    let data = JSON.parse(jsonData).sites;
    $('.site_selected').val(data);
}
