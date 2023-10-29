$(document).ready(function () {
    // Xử lý khi search
    $("#search-btn").on("click", function () {
        $("#search-input").toggleClass("d-none");

        $("#search-btn i").toggleClass("fa-magnifying-glass");
        $("#search-btn i").toggleClass("fa-chevron-up");
        // if (!$("#search-input").hasClass("d-none")) {
        //     $("#search-input").removeClass("slideInDown");
        // } else {
        //     $("#search-input").addClass("slideInDown");
        // }

    });
    // Ẩn và hiện login
    $('#login-form').show();
    $('#register-form').hide();


    function switchToLogin() {
        $('#register-btn').removeClass('font-weight-bold');
        $('li:has(a#register-btn)').removeClass('decoration');
        $('li:has(a#login-btn)').addClass('decoration');
        $('#login-btn').addClass('font-weight-bold');
        $('#login-form').show();
        $('#register-form').hide();
    }

    function switchToRegister() {
        $('#login-btn').removeClass('font-weight-bold');
        $('li:has(a#login-btn)').removeClass('decoration');
        $('li:has(a#register-btn)').addClass('decoration');
        $('#register-btn').addClass('font-weight-bold');
        $('#login-form').hide();
        $('#register-form').show();
    }
    $('#bars').click(function () {
        $('#bars').toggleClass('fa-caret-down');
        $('#bars').toggleClass('fa-caret-up');
    });

    // Xử lý sự kiện khi  "Đăng Nhập"
    $('#login-btn').click(function () {
        switchToLogin();
    });

    $('#login-switch').click(function () {
        switchToLogin();
    });

    // Xử lý sự kiện khi  "Đăng Ky"
    $('#register-btn').click(function () {
        switchToRegister();
    });

    // Áp dụng cho #register-switch
    $('#register-switch').click(function () {
        switchToRegister();
    });

    // // Xử lý lỗi input Đăng Ký
    // $("#firstNameError").hide();
    // $("lastNameError").hide();
    // $("email-registerError").hide();
    // $("password-registerError").hide();
    // $("repassword-registerError").hide();

    // $("#registerForm").submit(function (event) {
    //     alert("log");
    //     var firstName = $("#firstName").val();
    //     var firstNameError = $("#firstNameError");

    //     var lastName = $("lastName").val();
    //     var lastNameError = $("lastNameError");

    //     var emailRegister = $("email-register").val();
    //     var mailRegisterError = $("email-registerError");

    //     var passwordRegister = $("password-register").val();
    //     var passwordRegisterError = $("password-registerError");

    //     var repasswordRegister = $("repassword-register").val();
    //     var repasswordRegisterError = $("repassword-registerError");




    //     firstNameError.toggle(!isValidFirstName(firstName));
    //     lastNameError.toggle(!isValidLastName(lastName));
    //     mailRegisterError.toggle(!isValidEmailRegister(emailRegister));
    //     passwordRegisterError.toggle(!isValidPasswordRegister(passwordRegister));
    //     repasswordRegisterError.toggle(!isValidRePasswordRegister(repasswordRegister, passwordRegister));

    //     if (!isValidFirstName(firstName) || !isValidLastName(lastName) || !isValidEmailRegister(emailRegister)
    //         || !isValidPasswordRegister(passwordRegister) || !isValidRePasswordRegister(repasswordRegister, passwordRegister)) {
    //         event.preventDefault();
    //     }
    // });

    // function isValidFirstName(firstName) {
    //     return firstName.length >= 2;
    // }
    // function isValidLastName(lastName) {
    //     return lastName.length >= 2;
    // }
    // function isValidEmailRegister(emailRegister) {
    //     var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //     return emailRegex.test(emailRegister);
    // }
    // function isValidPasswordRegister(passwordRegister) {
    //     return passwordRegister.length >= 6;
    // }
    // function isValidRePasswordRegister(repasswordRegister, passwordRegister) {
    //     if (passwordRegister.length >= 6 && repasswordRegister == passwordRegister) {
    //         return true;
    //     }
    //     return false;
    // }

    $('#repassword-register').on('input', function () {
        var password = $('#password-register').val();
        var repassword = $(this).val();

        if (password !== repassword) {
            $('#repassword-registerError').html('<strong>Nhập lại mật khẩu sai</strong>');
        } else {
            $('#repassword-registerError').html('');
        }
    });

});