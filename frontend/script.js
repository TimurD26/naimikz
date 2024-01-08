// scripts.js


function register() {
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();

    $.ajax({
        url: 'http://naimikz-project/api/register',
        method: 'POST',
        data: { name: name, email: email, password: password },
        success: function (response) {
            alert('Registration successful!');
        },
        error: function (error) {
            console.error('Error registering user:', error);
        }
    });
}
function login() {
        var loginEmail = $('#loginEmail').val();
        var loginPassword = $('#loginPassword').val();
    
        $.ajax({
            url: 'http://naimikz-project/api/login',
            method: 'POST',
            data: { email: loginEmail, password: loginPassword },
            success: function (response) {
                // Log the entire response object to the console
                console.log('Response:', response);
            
            },
            // success: function (response) {
            //     // Check if the 'user' property exists in the response
            //     if (response && response.user || response.user.name) {
            //         // Save the access token in local storage for future requests
            //         localStorage.setItem('access_token', response.access_token);
    
            //         // Show user information after successful login
            //         $('#userInfo').show();
            //         $('#userName').text('Welcome, ' + response.user.name);
            //     } else {
            //         console.error('Invalid response format:', response);
            //     }
            // },
            // error: function (error) {
            //     console.error('Error logging in:', error);
            // }
        });
 }

function logout() {
    $.ajax({
        url: 'http://naimikz-project/api/logout',
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('access_token')
        },
        success: function (response) {
            // Remove the access token from local storage
            localStorage.removeItem('access_token');

            // Hide user information after logout
            $('#userInfo').hide();
            alert('Logout successful!');
        },
        error: function (error) {
            console.error('Error logging out:', error);
        }
    });
}
$(document).ready(function () {
    // Register button click event
    $("#registerButton").on("click", function () {
        register();
    });

    // Login button click event
    $("#loginButton").on("click", function () {
        login();
    });

    // Logout button click event
    $("#logoutButton").on("click", function () {
        logout();
    });

    // Additional logic or event handling can be added here
});
