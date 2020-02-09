$( function () {
    $(".hall-plan__place").not(".hall-plan__place_not-active").on('click', function () {

        const row   = $(this).data("row");
        const place = $(this).data("place");

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

        $(this).toggleClass("hall-plan__place_active");

        if ($(this).hasClass("hall-plan__place_active")) {
            $(".selected-places").append(placeHTML);
        } else {
            $(`*[data-row-selected="${row}"][data-place-selected="${place}"]`).remove();
        }

    });
});