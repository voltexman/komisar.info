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

$('.statistics tbody tr').on("click",function(event){
        event.preventDefault();
        var id = $(this).data('key');
        $('#statisticsDetails').modal("show");
        $('#statisticsDetails').find(".modal-body").load('/admin/statistic/statistics-details?id=' + id);
    }
);

window.onclick = function(event) {
    let modal = $('#statisticsDetails');
    if (event.target === modal) {
    }
}