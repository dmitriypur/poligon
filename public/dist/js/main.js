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