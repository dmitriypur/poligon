(function ($) {
    "use strict"
// =========== Лайки ===========
    $('.add-like').submit(function (e) {
        e.preventDefault();
        let data = $(this)
        let action = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: `${action}`,
            data: data.serialize()
        }).done(function (message) {
            // console.log(message)
        });
        return false;
    })

    let likeIco = document.querySelectorAll('.like-btn i')

    likeIco.forEach(function (el) {

        let parent = el.parentNode
        if (el.classList.contains('fa-bookmark') || el.classList === 'fas fa-heart') {
            parent.setAttribute('data-like', 1)
        }
    })

    $('.like-btn').click(function (e) {
        var counter = $(this).siblings('.like-count')
        var count = +counter.html()
        var ico = $(this).data('ico')

        if ($(this).attr('data-like') == 0) {
            $(this).attr('data-like', 1)
            $(this).html(`<i class="fas fa-${ico}"></i>`)
            count++
            counter.html(count)
        } else if ($(this).attr('data-like') == 1) {
            $(this).attr('data-like', 0)
            $(this).html(`<i class="far fa-${ico}"></i>`)
            count--
            counter.html(count)
        }
    })
// =========== Лайки ===========


})(jQuery);
