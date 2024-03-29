
function register() {
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var isClient = $('#isClient').val();

    // Perform client-side form validation here if needed
    // console.log('name',name);
    // console.log('email',email);
    // console.log('password',password);
    // console.log('isClient',isClient);

    $.ajax({
        url: 'http://naimikz-project/api/register',
        method: 'POST',
        data: { name: name, password: password, email: email, isClient: isClient },
        success: function (response) {
            // Display a success message on the page or use a notification system
            console.log('Registration successful:', response);
            alert('Registration successful!');

            if(isClient==false)
            {
                location.assign('http://naimikz-project/specs.html');
            }
            else
            {
                location.assign('http://naimikz-project/order.html');
            }

        },
        error: function (error) {
            console.error('Error registering user:', error);

            // Check if the error contains responseJSON
            if (error.responseJSON) {
                alert('Registration failed: ' + error.responseJSON.error);
            } else {
                alert('Registration failed. Please try again later.');
            }
        }
    });
}

// function login() {
//     var loginEmail = $('#loginEmail').val();
//     var loginPassword = $('#loginPassword').val();

//     $.ajax({
//         url: 'http://naimikz-project/api/login',
//         method: 'POST',
//         data: { email: loginEmail, password: loginPassword },
//         success: function (response) {
//             console.log('Response:', response);

//             // Save the access token in local storage for future requests
//             localStorage.setItem('access_token', response.access_token);
            
//             // Redirect to a new page after successful login
//             window.location.href = 'http://naimikz-project/temp.html';
//         },
//         error: function (error) {
//             console.error('Error logging in:', error);
//         }
//     });
// }
function login() {
    var loginEmail = $('#loginEmail').val();
    var loginPassword = $('#loginPassword').val();
  
    
    localStorage.removeItem('access_token');
    localStorage.removeItem('user_info');
    
    $.ajax({
        url: 'http://naimikz-project/api/login',
        method: 'POST',
        data: { email: loginEmail, password: loginPassword },
        success: function (response) {
            console.log('Response:', response);

            // Save the access token in local storage for future requests
            localStorage.setItem('access_token', response.access_token);
            
            me();
            var userInfoString = localStorage.getItem('user_info');
            var userInfo = JSON.parse(userInfoString);

            console.log(userInfo.isClient);

            if(userInfo.isClient==false)
            {
                location.assign('http://naimikz-project/specs.html');
            }
            else
            {
                location.assign('http://naimikz-project/order.html');
            }
            
            
            // Redirect to a new page after successful login
            
        
        },
        
            

        error: function (error) {
            console.error('Error logging in:', error);
        }
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
function me() {
    $.ajax({
        url: 'http://naimikz-project/api/me',
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('access_token')
        },
        success: function (response) {
            console.log('Response:', response); 
            
            // Save the response to local storage
            localStorage.setItem('user_info', JSON.stringify(response));
            
            // Hide user information after logout
            // For example, you could do something like $('#userInfo').hide();
        },
        error: function (error) {
            console.error('Error logging out:', error);
            // Handle error as needed
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