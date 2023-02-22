$(document).ready(function () {
    makeTableOrderable($('.table-data').data('order'));
    makeItemCanUpdateStatus();
    makeRecordCanDelete();
});
