$(document).ready(function() {
    let tableRow = $('tr[data-name="tableRow"]');
    if ($(tableRow).length) {
        $(tableRow).each((index, element) => {
            $(element).click(() => {
                window.location = $(element).data('href');
            });
        });
    }

    let table = $('.table');
    let tableHeaders = $(table).find('th').length;
    let tableEmpty = $('#tableEmpty');

    if ($(tableEmpty).length) {
        $(tableEmpty).attr('colspan', tableHeaders)
    }
});