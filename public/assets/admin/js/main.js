$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function makeTableOrderable(orderUrl) {
    $('.sort').sortable({
        handle: ".handle",
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        update: function update(event, ui) {
            let sort = $(this).sortable("toArray");
            $.ajax({
                url: orderUrl,
                method: "POST",
                data: {
                    sort: sort
                }
            });
        }
    });
}
