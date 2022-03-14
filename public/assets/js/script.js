$(document).ready(function () {
    $('#myTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        format: 'dd/mm/yyyy',
        startDate: '-3d',
        autoclose: true,
        calendarWeeks: true,
        clearBtn: true,
        language: "fr-FR",
        todayBtn: "linked",
        toggleActive: true,
        todayHighlight: true,
        daysOfWeekDisabled: "0,1",
        startDate: "01/01/2010",
        format: "dd/mm/yyyy",
    });
});