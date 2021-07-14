$(document).on('click', '.btn-author-like', function () {
    let id = $(this).closest('.box-widget').attr('id');
    $.post({
        url: '/admin/comment/author-like?id=' + id,
        success: function (data) {
            if (data === 'liked') {
                $.pjax.reload({container: "#comment-" + id, timeout: false});
            }
        }
    })
})

$(document).on('submit', 'form.add-reply', function (event) {
    event.preventDefault();
    let id = $(this).closest('.box-widget').attr('id');
    let data = $(this).serialize();
    $.post({
        url: '/admin/comment/add-reply?id=' + id,
        data: data,
        success: function (data) {
            console.log(data)

            if (data === 'sent') {
                $.pjax.reload({container: "#comment-" + id, timeout: false});
            }
        }
    })
    return false;
})

$(document).on('click', '.statistics tbody tr', function (event) {
        event.preventDefault();

        let id = $(this).data('key');
        let statisticsDetails = $('#statisticsDetails');

        statisticsDetails.modal('show');
        statisticsDetails.find('.modal-body').load('/admin/statistic/details?id=' + id);
    }
);

$(document).on('click', '.statistics a.btn-chart', function (event) {
    event.preventDefault();

    let charts = $('#charts');

    charts.modal('show');
    charts.find('.modal-body').load('/admin/statistic/charts');
})

