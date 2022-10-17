$(document).ready(function () {
  $("#myTable").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
    },
  });
  $(".js-datepicker").datepicker({
    format: "dd/mm/yyyy",
    startDate: "-3d",
    autoclose: true,
    calendarWeeks: true,
    clearBtn: true,
    language: "fr-FR",
    todayBtn: "linked",
    toggleActive: true,
    todayHighlight: true,
  });
});
