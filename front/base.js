var element = null;
var customUsername = null;
var customPassword = null;
var url = 'http://localhost:8000';

$(function() {
    element = $("#actionText");
    customUsername = $("#customUsername");
    customPassword = $("#customPassword");
});

function getMessageFromFail(xhr) {
    return $.parseJSON(xhr.responseText).message;
}

function register() {
    element.html('Registering');

    $.ajax({
        method: "POST",
        url: url + '/register',
        dataType: 'json',
        data: { username: customUsername.val(), password: customPassword.val() }
    })
    .fail(function(xhr) {
        element.html('REGISTER ERROR : ' + getMessageFromFail(xhr));
    })
    .done(function( msg ) {
        element.html('REGISTER SUCCESS : ' + msg.username);
    });
}

function login() {
    element.html('Logging in');

    $.ajax({
        method: "POST",
        url: url + '/login',
        dataType: 'json',
        data: { username: customUsername.val(), password: customPassword.val() }
    })
        .fail(function(xhr) {
            element.html('LOGIN ERROR : ' + getMessageFromFail(xhr));
        })
        .done(function( msg ) {
            element.html('LOGIN SUCCESS : ' + msg.username);
        });
}
