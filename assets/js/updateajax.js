$('#updateDetailsDiv #update').click(function (e) {
    //getting data fromm fields
    let age = $('#age').val();
    let dob = $('#dob').val();
    let contact = $('#contact').val();
    let city = $('#city').val();
    if (age == '' || dob == '' || contact == '' || city == '') {
        console.log(age, dob, contact, city);
        alert("Fill Out All The Fields");
    }
    else {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/guviintern-main/backend/update.php',
            data: {
                update: "update",
                age: age,
                dob: dob,
                contact: contact,
                city: city,
            },
            success: function (data) {
                if (data.code == false) {
                    alert(data.msg);
                    $('#updateDetailsDiv').hide(200);
                    $('#showDetailsDiv').show(1000);
                }
                else {
                    alert(data.msg);
                    //setting data
                    $("#agefield").val(data["age"]);
                    $("#dobfield").val(data["dob"]);
                    $("#contactfield").val(data["contact"]);
                    $("#cityfield").val(data["city"]);

                    $('#updateDetailsDiv').hide(200);
                    $('#showDetailsDiv').show(1000);
                }

                //emptying update fields
                $('#age').val("");
                $('#dob').val("");
                $('#contact').val("");
                $('#city').val("");
            },
            error: function (data) {
                console.log(data);
            },
        })
    }

})
