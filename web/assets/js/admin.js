$( function () {
    $('#cinemas').on('change', function () {
        const value = $(this).val();
        const updated = $("#updated");

        $.ajax({
            url: `http://cinema/admin/session/${value}/halls`,
            type: "GET",
            // data: {'value': value},
            success: function (json) {
                const halls = JSON.parse(json);
                const select = $("#halls");

                select.empty();
                $(select).append("<option selected>--- Выберите зал ---</option>");

                halls.forEach(function (item) {
                    $(select).append(`<option value="${item.id}">${item.name}</option>`);
                });

                $(updated).addClass("updated");

                setTimeout(() => {
                    $(updated).removeClass("updated");
                }, 1500);
            },
            error: function (jqXHR, exception) {
                console.log("Ошибка при получении данных!");
                console.log(jqXHR);
            }
        })

    });
});