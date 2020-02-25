$( function () {
    $('#cinemas').on('change', function () {
        const value = $(this).val();
        const updated = $("#updated");

        $.ajax({
            url: `http://cinema/admin/api/halls/${value}`,
            type: "GET",
            // data: {'value': value},
            success: function (json) {
                const halls = JSON.parse(json);
                const select = $("#halls");

                // удаляем все <option> внутри <select>
                select.empty();

                // добавляем 1-й <option>
                $(select).append("<option selected disabled>--- Выберите зал ---</option>");

                // добавляем в <option> все залы
                halls.forEach(item => {
                    $(select).append(`<option value="${item.id}">${item.name}</option>`);
                });

                // отображаем "Обновлено" путем добавление класса
                $(updated).addClass("updated");

                // удаляем "Обновлено" путем удаление класса
                setTimeout(() => {
                    $(updated).removeClass("updated");
                }, 1500);
            },
            error: function (jqXHR, exception) {
                console.log("Ошибка при получении данных!");
                alert("Ошибка при получении данных!");
            }
        })

    });
});