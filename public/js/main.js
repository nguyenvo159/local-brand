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