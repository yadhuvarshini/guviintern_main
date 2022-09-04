//validation
$(window).ready(() => {
    $.ajax({
        url: '/guviintern-main/backend/validation.php',
        type: 'GET',
        data: {},
        success: function (data) {
            if (data.code === true) {
                alert(data.msg);
                location.href = "/guviintern-main/routes/home.html"
            }
        },
        dataType: 'json',
    })
})