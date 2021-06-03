toastr.options.progressBar = true;

var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};

function success(pos) {
    var crd = pos.coords;
    let statisticsId = $('body').data('statistics-id');

    // console.log('Ваше текущее местоположение:');
    // console.log(`Широта: ${crd.latitude}`);
    // console.log(`Долгота: ${crd.longitude}`);
    // console.log(`Плюс-минус ${crd.accuracy} метров.`);

    $.post({
        url: '/blog/geo-position',
        data: {
            id: statisticsId,
            latitude: crd.latitude,
            longitude: crd.longitude,
            accuracy: crd.accuracy
        },
    })
};

function error(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
};

navigator.geolocation.getCurrentPosition(success, error, options);

TimeMe.initialize({
    currentPageName: "body",
});

window.onbeforeunload = function () {
    let realId = $('body').data('real-id');
    if (realId !== 'undefined') {
        let timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
        $.post({
            url: '/blog/page-time',
            data: {id: realId, time: timeSpentOnPage},
        })
    }

}

let imageHref = $('.content-place img');
let imagePosition = '';
let imageMarginLeft = '';
let imageMarginRight = '';
let image = new Image();
imageHref.each(function (index) {
    index % 2 !== 0 ? imagePosition = 'left' : imagePosition = 'right';
    if (imagePosition === 'left') {
        imageMarginLeft = '0';
        imageMarginRight = '5px'
    } else {
        imageMarginLeft = '5px';
        imageMarginRight = '0'
    }
    $(this).attr('data-mfp-src', this.src);
    if (this.height > this.width) {
        $(this).css({
            'float': imagePosition,
            'width': '40%',
            'margin-left': imageMarginLeft,
            'margin-right': imageMarginRight,
            'margin-bottom': '5px',
            'border-radius': '5px',
            'cursor': 'pointer'
        });
    }
})

$('.content-place img').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    image: {
        verticalFit: false
    }
});

$('.image-gallery-item').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    image: {
        verticalFit: false
    }
});

$('.carousel').slick({
    dots: false,
    infinite: true,
    speed: 1000,
    arrows: false,
    autoplay: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    loop: true,
    adaptiveHeight: true,
});

$('iframe').wrap('<div class="video-container" />');

$(window).on('load', function () {
    $('.main-page > .social-share').prepend('<li class="first-position"><a><i class="elegant-icon social_share"></i></a></li>')
})

$('#sentenceForm').on('beforeSubmit', function () {
    let sentenceTheme = $('#sentence-theme').val().trim();
    let $form = $(this);
    let data = $form.serialize();
    let message = '<h5>Дякую!</h5>' +
        '<p class="font-medium">Ваша пропозиція на тему "' + sentenceTheme + '" відправлена. Найближчим часом я її розгляну.</p>';

    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        data: data,
        success: function (data) {
            if (data === 'sent') {
                $('.send-message').append(message);
                $('.send-info').removeClass('d-none');
                $('.sentence-form').hide();
                $form.trigger('reset');
                setTimeout(function () {
                    $('.send-info').addClass('d-none');
                    $('.sentence-form').show('slow');
                    $('.send-message').empty();
                }, 10000);
            }
        },
        error: function (jqXHR, errMsg) {
            alert(errMsg);
        }
    });

    return false;
})

$('#commentForm').on('beforeSubmit', function () {
    let $form = $(this);
    let data = $form.serialize();

    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        data: data,
        success: function (data) {
            $.pjax.reload({container: "#commentList", timeout: false});
            toastr.info('Ваш коментар додано до статті');
            $form.trigger('reset');
            $('html,body').animate({
                scrollTop: $('#commentList').offset().top - 140
            }, 500);
        },
        error: function (jqXHR, errMsg) {
            alert(errMsg);
        }
    });

    return false;
})

$(document).on('click', '.btn-favorite', function () {
    let id = $(this).closest('article').attr('id');
    let icon = $(this).find('i');
    $.post({
        url: '/blog/to-favorite?id=' + id,
        success: function (data) {
            if (data === 'added') {
                $.pjax.reload({container: "#favoriteMenu", timeout: false, async: false});
                icon.removeClass('icon_star_alt').addClass('icon_star');
                toastr.info('Стаття додана до списку обраних');
                $('#favoriteArticle').length ? $.pjax.reload({
                    container: "#favoriteArticle",
                    timeout: false,
                    async: false
                }) : null;
            } else if (data === 'removed') {
                $.pjax.reload({container: "#favoriteMenu", timeout: false, async: false});
                icon.removeClass('icon_star').addClass('icon_star_alt');
                toastr.info('Стаття видалена зі списку обраних');
                $('#favoriteArticle').length ? $.pjax.reload({
                    container: "#favoriteArticle",
                    timeout: false,
                    async: false
                }) : null;
            }
        }
    });
})

$(document).on('click', '.btn-favorite-remove', function () {
    let id = $(this).closest('article').attr('id');
    $.post({
        url: '/blog/favorite-remove?id=' + id,
        success: function (data) {
            if (data === 'removed') {
                $.pjax.reload({container: "#favoriteMenu", timeout: false, async: false});
                toastr.info('Стаття видалена зі списку обраних');
            }
        }
    });
})

$(document).on('click', '.btn-like', function () {
    let id = $(this).closest('article').attr('id');
    let icon = $(this).find('i');
    $.post({
        url: '/blog/add-like?id=' + id,
        success: function (data) {
            if (data === 'added') {
                icon.removeClass('icon_heart_alt').addClass('icon_heart');
                toastr.info('Ваш лайк зараховано');
            } else if (data === 'removed') {
                icon.removeClass('icon_heart').addClass('icon_heart_alt');
                toastr.info('Ваш лайк знято');
            }
        }
    });
})

$('#contactForm').on('beforeSubmit', function () {
    let $form = $(this);
    let senderName = $('#contact-name').val().trim();
    let senderEmail = $('#contact-email').val().trim();
    let data = $form.serialize();

    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        data: data,
        success: function (data) {
            if (data === 'sent') {
                $('.send-info').removeClass('d-none');
                $('html,body').animate({
                    scrollTop: $('.send-info').offset().top - 140
                }, 500);
                $('.sender-name').text(senderName + ', дякую Вам за листа');
                $('.sender-email').text(senderEmail);
                $('.contact-form').hide();
                $form.trigger('reset');
                setTimeout(function () {
                    $('.send-info').addClass('d-none');
                    $('.contact-form').show('slow');
                }, 10000);
            }
        },
        error: function (jqXHR, errMsg) {
            alert(errMsg);
        }
    });
})