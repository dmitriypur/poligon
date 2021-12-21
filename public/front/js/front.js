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


// ========================= Уведомления ===========================
var notifications = [];
const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
    newPost: 'App\\Notifications\\NewPost'
};

$(document).ready(function() {
    // проверить, есть ли вошедший в систему пользователь
    if(Laravel.userId) {
        $.get('/notifications', function (data) {
            addNotifications(data, "#notifications");
        });
    }
});
function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // показываем только последние 5 уведомлений
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">Нет уведомлений</li>');
        $(target).removeClass('has-notifications');
    }
}

// Сделать строку уведомления
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '">' + notificationText + '</a></li>';
}
// получить маршрут уведомления в зависимости от его типа
function routeNotification(notification) {
    var to = `?read=${notification.id}`;
    if(notification.type === NOTIFICATION_TYPES.follow) {
        to = 'cabinet' + to;
    }else if(notification.type === NOTIFICATION_TYPES.newPost) {
        const postSlug = notification.data.post_slug;
        to = `posts/${postSlug}` + to;
    }
    return '/' + to;
}
// получить текст уведомления в зависимости от его типа
function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        text += `<strong>${name}</strong> Подписался на вас`;
    } else if(notification.type === NOTIFICATION_TYPES.newPost) {
        const name = notification.data.following_name;
        text += `<strong>${name}</strong> опубликовал запись`;
    }
    return text;
}
