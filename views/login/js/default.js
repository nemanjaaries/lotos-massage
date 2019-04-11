$(document).ready(function () {

    var logBox = $("#log-box");
    var regBox = $("#reg-box");
    var logButton = $("#log-btn");
    var regButton = $("#reg-btn");

    regButton.on("click", function () {
        logBox.css("display", "none");
        regBox.css("display", "inline-block");
    });

    logButton.on("click", function () {
        logBox.css("display", "inline-block");
        regBox.css("display", "none");
    });

    var usernameInput = $('#username-input');
    var passwordInput = $('#password-input');
    var emailInput = $('#email-input');
    var regForm = $("#registration-form");

    var usernameMsg = $("#error-username");
    var passwordMsg = $("#error-password");
    var emailMsg = $("#error-email");

    var usernameError = true;
    var passwordError = true;
    var emailError = true;

    usernameMsg.hide();
    passwordMsg.hide();
    emailMsg.hide();


    usernameInput.on('focusout', function () {
        usernameCheck();
    });

    passwordInput.on('focusout', function () {
        passwordCheck();
    });

    emailInput.on('focusout', function () {
        emailCheck();
    });



    regForm.on("submit", function () {

        usernameError = true;
        passwordError = true;
        emailError = true;

        usernameCheck();
        passwordCheck();
        emailCheck();

        if (usernameError === false && passwordError === false && emailError === false) {
            return true;
        } else {
            return false;
        }
    });



    function usernameCheck() {
        var length = usernameInput.val().length;
        if (length < 5 || length > 20) {
            usernameMsg.html("User name mora imati izmedju 5 i 20 karaktera.");
            usernameMsg.show();
        } else {
            usernameMsg.hide();
            usernameError = false;
        }
    }

    function passwordCheck() {
        var length = passwordInput.val().length;
        if (length < 8) {
            passwordMsg.html("Password mora imati najmanje 8 karaktera.");
            passwordMsg.show();
        } else {
            passwordMsg.hide();
            passwordError = false;
        }
    }

    function emailCheck() {
        var email = emailInput.val();
        var patern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (patern.test(email) === false) {
            emailMsg.html("Neispravna email adresa.");
            emailMsg.show();
        } else {
            emailMsg.hide();
            emailError = false;
        }
    }



 });


