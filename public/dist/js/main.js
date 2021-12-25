//
// $('#add-post').submit(function (e) {
//     e.preventDefault();
//     let data = $(this)
//     let action = $(this).attr('action')
//
//     $.ajax({
//         type: "POST",
//         url: `${action}`,
//         data: data.serialize()
//     }).done(function (message) {
// console.log(message)
//         setTimeout(function () {
//             alert('Запись добавлена')
//             $('.note-editable').html('')
//             $('.select2-selection__rendered').html('')
//             data.trigger("reset");
//         }, 1000);
//     });
//     return false;
// })
$(function () {
    $('.select2').select2()
});

$(function () {
    $('#example1').DataTable({
        'pagingType': "numbers",
        "paging": true,
        "lengthChange": true,
        "iDisplayLength": 10,
        "searching": true,
        "ordering": true,
        "order": [[ 0, 'desc' ]],
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "language": {
            "infoFiltered":   "(Отфильтровано _MAX_ записей)",
            "zeroRecords":    "Записей не найдено",
            "info": "Показано с _START_ по _END_ записей из _TOTAL_",
            "lengthMenu": "Показывать _MENU_ записей на странице",
            "infoEmpty": "Нет записей.",
            "search": "Поиск:",
            "paginate": {
                "first": "Первая",
                "previous": "Предыдущая",
                "last": "Последняя",
                "next": "Следующая"
            }
        }
    });
});

$('.nav-sidebar a').each(function () {
    let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
    let link = this.href;
    if(link == location){
        $(this).addClass('active');
    }
})
