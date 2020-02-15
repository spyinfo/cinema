$( function () {

    const checkbox = $(".fake-checkbox");

    // Переключаем на false все input-ы
    $(checkbox).not(".fake-checkbox_not-active").each(function (item) {
        if ($(this).prev().is(":checked")) {
            $(this).prev().prop("checked", false);
        }
    });

    // Обработка клика на input
    $(checkbox).not(".fake-checkbox_not-active").on('click', function (e) {
        const input = $(this).prev();

        const row   = input.data("row");
        const place = input.data("place");

        const placeHTML = `
            <div class="selected-places__item" data-place-selected="${place}" data-row-selected="${row}">
                <div class="selected-places__place">
                    ${place} место
                </div>
                <div class="selected-places__row">
                    ${row} ряд
                </div>
            </div>
        `;

        if (!input.is(":checked")) {
            $(".selected-places").append(placeHTML);
        } else {
            $(`*[data-row-selected="${row}"][data-place-selected="${place}"]`).remove();
        }
    });
});