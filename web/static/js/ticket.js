$(function () {
    const url = location.pathname;

    if (url === "/profile/orders/ticket") {
        $("#print-ticket").print({
            iframe: false
        });
    }
});