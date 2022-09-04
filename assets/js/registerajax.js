$('#register').click(function (e) {
    let username = $('#username').val().trim();
    let password = $('#password').val().trim();
    if (username == '' || username == undefined || password == '' || password == undefined) {
        alert("Fill Out All The Fields");
    }
    else {
        $.ajax({
            type: 'POST',
            url: '/guviintern-main/backend/authentication.php',
            data: {
                register: "register",
                username: username,
                password: password,
            },
            success: function (data) {
                if (data.code == false) {
                    alert(data.msg);
                    $('#username').val('');
                    $('#password').val('');
                }
                else {
                    alert(data.msg);
                    location.href = "/guviintern-main/routes/home.html"
                }
            },
            error: function (data) {
                console.log(data);
            },
            dataType: 'json',
        })
    }

})
