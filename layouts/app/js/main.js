$( function () {
    $(".hall-plan__place").not(".hall-plan__place_not-active").on('click', function () {

        const place = `
            <div class="selected-places__item ">
                <div class="selected-places__place">
                    ${$(this).data("place")} место
                </div>
                <div class="selected-places__row">
                    ${$(this).data("row")} ряд
                </div>
            </div>
        `;

        $(this).toggleClass("hall-plan__place_active");
        if ($(this).hasClass("hall-plan__place_active")) {
            $(".selected-places").append(place);
        } else {

        }

    });
});