//validation
$(window).ready(() => {
    $.ajax({
        url: '/guviintern-main/backend/validation.php',
        type: 'GET',
        data: {},
        success: function (data) {
            if (data.code === false) {
                location.href = "/guviintern-main/"
                console.log(data.msg);
            }
        },
        dataType: 'json',
    })
})

