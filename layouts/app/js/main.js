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

    // Print
    $("#print").on("click", function () {
        $(".congratulations__desc").print({
            iframe: false
        });
    });

    $("#print-ticket").on("click", function () {
        $(".congratulations__desc").print({
            iframe: false
        });
    });

    // Проверка занятности login
    $("#login").on("blur", function () {
        const value = $(this).val();
        const exist = $("#exist");
        exist.empty();

        if (value) {
            $.ajax({
                url: `http://cinema/api/user/${value}`,
                type: "GET",
                success: function (response) {
                    if (response === "true") {
                        $(exist).append("<div class=\"already-exist text-center\">Этот логин уже занят!</div>");
                        $("#register").prop("disabled", true);
                    } else {
                        $(exist).append("<div class=\"not-exist text-center\">Этот логин свободен!</div>");
                        $("#register").prop("disabled", false);
                    }
                },
                error: function (jqXHR, exception) {
                    console.log("Ошибка при получении данных!");
                    alert("Ошибка при получении данных!");
                }
            });
        }
    });
});