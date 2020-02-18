$( function () {
    let checkbox = $('#isBudget');
    let input = $('#count_budget');

    if (!checkbox.prop('checked')) {
        input.attr('disabled', 'disabled');
        $('#plan_budget').attr('disabled', 'disabled');
    }

    $(checkbox).on('change', function () {
        if (input.attr('disabled')) {
            input.removeAttr('disabled');
        } else {
            input.attr('disabled', 'disabled');
        }
    });

    if ($('#specialty-select option:selected').length === 0) {
        $('#specialty-button-submit').attr("disabled", "disabled");
        $('#flash-select').css("display", "block");
    } else {
        $('#specialty-button-submit').removeAttr("disabled", "disabled");
        $('#flash-select').css("display", "none");
    }



    $('input[id=phone]').mask("+7 (999) 999-99-99");
    $('input[id=code]').mask("99.99.99");
});