// $(document).ready(function() {
//     $('form').submit(function(event) {
//         event.preventDefault();
//         if (validateForm()) {
//             $('form').unbind('submit').submit();
//         } else {
//             $('#errorModal').modal('show');
//         }
//     });
// });
//
// function validateForm() {
//     let isValid = true;
//     $('input[required], select[required]').each(function() {
//         if (!$(this).val()) {
//             $(this).addClass('is-invalid');
//             isValid = false;
//         } else {
//             $(this).removeClass('is-invalid');
//         }
//     });
//     return isValid;
// }