// $(function () {
//     $('.js-basic-example').DataTable({
//         responsive: true,
//         "order": [[0, 'desc']],
//     });

//     //Exportable table
//     $('.js-exportable').DataTable({
//         dom: 'Bfrtip',
//         responsive: true,
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//     });
// });
$(function () {
    // Basic Example
    var basicTable = $('.js-basic-example').DataTable({
        responsive: true,
    });

    // Exportable table
    var exportableTable = $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        "order": [],
    });

    // Manually sort the tables
    basicTable.order([[0, 'desc']]).draw();
    exportableTable.order([[0, 'desc']]).draw();
});
