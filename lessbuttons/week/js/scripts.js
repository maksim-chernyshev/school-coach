var swiper1 = new Swiper('.teachers .swiper-container', {
    slidesPerView: 2,
    spaceBetween: 30,
    autoHeight: true,
    loop: true,
    pagination: {
        el: '.teachers .swiper-pagination',
        clickable: true
    },
    navigation: {
        nextEl: '.teachers .swiper-button-next',
        prevEl: '.teachers .swiper-button-prev'
    },
    breakpoints: {
        992: {
            slidesPerView: 1,
        }
    }
});

var swiper2 = new Swiper('.pupils .swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    autoHeight: true,
    loop: true,
    pagination: {
        el: '.pupils .swiper-pagination',
        clickable: true
    },
    navigation: {
        nextEl: '.pupils .swiper-button-next',
        prevEl: '.pupils .swiper-button-prev'
    }
});

const swiper3 = new Swiper('.main-caption .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 30,
    autoHeight: true,
    simulateTouch: false,
    loop: false,
    pagination: {
        el: '.main-caption .swiper-pagination',
        clickable: true
    },
    breakpoints: {
        768: {
            slidesPerView: 1
        }
    }
});

const swiper4 = new Swiper('.tarifs .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 30,
    autoHeight: true,
    simulateTouch: false,
    loop: false,
    pagination: {
        el: '.tarifs .swiper-pagination',
        clickable: true
    },
    breakpoints: {
        768: {
            slidesPerView: 1
        }
    }
});


$(document).ready(function () {

    $('.btn-consult, .btn-demo').magnificPopup({
        type: 'inline'
    });


    $(".mob-nav").click(function (event) {
        event.preventDefault();
        if ($(".mob-menu").is(":hidden")) {
            $(this).addClass('active');
            $(".mob-menu").slideDown(300);
        } else {
            $(this).removeClass('active');
            $(".mob-menu").slideUp(300);
        }

    });

    if ($(window).width() < 769) {
        $('body').click(function (e) {
            e.preventDefault();
            if ($(".mob-nav").hasClass('active')) {
                $(".mob-menu").slideUp(300);
                $(".mob-nav").removeClass('active')
            }
        });

    }

    $(".mob-nav, .mob-menu").click(function (event) {
        event.stopPropagation();
    });

    /*$(window).scroll(function(){
        if($(this).scrollTop()>150){
            $('.fixed-wrapper').addClass('fixed');
            $('.header-caption').addClass('fixed');

        }
        else if ($(this).scrollTop()<150){
            $('.fixed-wrapper').removeClass('fixed');
        }

    });*/

    $('.top a[href*=#]').bind('click', function (e) {
        e.preventDefault();

        var target = $(this).attr("href");

        $('html, body').stop().animate({scrollTop: $(target).offset().top}, 500, function () {
            location.hash = target;
        });

        return false;
    });

    $('a.btn-tarif[href*=#]').bind('click', function (e) {
        e.preventDefault();

        var target = $(this).attr("href");

        $('html, body').stop().animate({scrollTop: $(target).offset().top}, 500, function () {
            location.hash = target;
        });
        $(".tarifs").addClass('active')

        return false;
    });

    $('.more-button').on('click', function () {
        const list = $(this).closest('ul')
        const hiddenItems = list.find('.m-hidden')
        const moreItem = list.find('.more-item')

        hiddenItems.fadeIn()
        moreItem.css('display', 'none')
    })

    $('.btn-demo, .btn-consult').on('click', () => {
        $('.consult-modal').css('display', 'block')
        $('.success-modal, .error-modal').css('display', 'none')
        $('input[name="name"]').css('border','1px solid #f7f7f7')
        $('input[name="contact"]').css('border','1px solid #f7f7f7')
    })

    $('.check').on('click', function () {
        $(this).css('outline', 'none')
    })

    $('input[name="contact"], input[name="name"]').on('focus', (e) => {
        e.target.style.border = '1px solid #f7f7f7'
    })

    function isValid(form) {
        const nameInput = form.find('input[name="name"]')
        const contactInput = form.find('input[name="contact"]')
        const checkbox = form.find('input[type="checkbox"]')
        const emailMatch = contactInput.val().match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)
        const phoneMatch = contactInput.val().match(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/)

        if (nameInput.val().trim() === '') {
            nameInput.css('border', '1px solid red')
        }

        if (!(emailMatch || phoneMatch)) {
            contactInput.css('border', '1px solid red')
        }

        if (!checkbox.prop('checked')) {
            form.find('.check').css('outline', '1px dashed red')
        }

        return ((emailMatch || phoneMatch) && nameInput.val().trim() && checkbox.prop('checked')) ? true : false
    }

    // отправка формы

    $(".form_btn").click(function () {
        const currentForm = $(this).closest(".form")
        if (!isValid(currentForm)) {
            return
        }

        console.log("Начинаю отправку");
        $.ajax({
            url: "send.php",
            type: "POST",
            dataType: "html",
            data: currentForm.serialize(),
            success: function (response) {
                $('.consult-modal').css('display', 'none')
                $('.success-modal').css('display', 'block')
                console.log("Успешно отправил");
            },
            error: function (response) {
                $('.consult-modal').css('display', 'none')
                $('.error-modal').css('display', 'block')
                console.log("Ошибка отправки");
            }
        });
    })


});









