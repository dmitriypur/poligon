(function ($) {
    "use strict"

// ============= modal ========
    let modalWrap = document.querySelectorAll('.modal__wrap');

    document.querySelectorAll('.modal__show').forEach(function (el) {
        el.onclick = showModal;
    })
    modalWrap.forEach(function (el) {
        el.onclick = closeModal;
    })
    document.querySelectorAll('.modal__close').forEach(function (el) {
        el.onclick = closeModal;
    })
    document.querySelectorAll('.modalka').forEach((el) => {
        el.onclick = (event) => {
            event.stopPropagation();
        }
    })
    function showModal(event) {
        event.preventDefault()
        let data = this.dataset.modal;
        document.querySelectorAll(data).forEach((el) => {
            el.classList.remove('hide');
        })
        document.onkeydown = (el) => {
            if (el.keyCode == 27) {
                closeModal();
            }
        }
    }
    function closeModal() {
        for (let i = 0; i < modalWrap.length; i++) {
            modalWrap[i].classList.add('hide');
        }
        document.onkeydown = null;
    }
// ============= modal ========

// =========== Лайки ===========
    function likes() {
        let likeIco = document.querySelectorAll('.like-btn i')
        likeIco.forEach(function (el) {
            let parent = el.parentNode
            if (el.classList == 'fas fa-bookmark' || el.classList == 'fas fa-heart') {
                parent.setAttribute('data-like', 1)
            }
            parent.addEventListener('click', toggleLikeAttr)
        });
    }
    function toggleLikeAttr(e) {
        e.preventDefault();
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
        let data = $(this).parent()
        let action = $(this).parent().attr('action')
        $.ajax({
            type: "POST",
            url: action,
            data: data.serialize()
        }).done(function (message) {
            // console.log(message)
        });
        return false;
    }
    likes()

// =========== Лайки ===========

// =========== Бесконечный скролл ===========
    function loadMoredata(page) {
        $.ajax({
            url: '?page=' + page,
            type: 'get',
            beforeSend: function () {
                $('.ajax-load').show();
            }
        }).done(function (data) {
            if (data.html == '') {
                $('.ajax-load').html('Записей больше нет!');
                return;
            }
            $('.ajax-load').hide();
            $('#post-data').append(data.html);
            likes();

        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('Сервер не отвечает...');
        })
    }
    let page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            if (page >= lastPage) {
                return
            } else {
                page++;
                loadMoredata(page);
            }
        }
    })
// =========== Бесконечный скролл ===========

// =========== Комменты parent-id ===========
    $('.comment-reply-link').click(function (){
        let id = $(this).data('id');
        $('#parent_id').val(id)
    })
// =========== Комменты parent-id ===========

})(jQuery);
