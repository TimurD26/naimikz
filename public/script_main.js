async function register() {
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var isClient = $('#isClient').val();

    try {
        
        const response = await $.ajax({
            url: 'http://naimikz-project/api/register',
            method: 'POST',
            data: { name: name, password: password, email: email, isClient: isClient }
        });

        // Display a success message on the page or use a notification system
        console.log('Registration successful:', response);
        alert('Registration successful!');

        if (isClient == false) {
            location.assign('http://naimikz-project/specs.html');
        } else {
            location.assign('http://naimikz-project/order.html');
        }
    } catch (error) {
        console.error('Error registering user:', error);

        // Check if the error contains responseJSON
        if (error.responseJSON) {
            alert('Registration failed: ' + error.responseJSON.error);
        } else {
            alert('Registration failed. Please try again later.');
        }
    }
}

async function login() {
    var loginEmail = $('#loginEmail').val();
    var loginPassword = $('#loginPassword').val();
  
    try {
        const response = await $.ajax({
            url: 'http://naimikz-project/api/login',
            method: 'POST',
            data: { email: loginEmail, password: loginPassword }
        });

        console.log('Response:', response);

        // Save the access token in local storage for future requests
        localStorage.setItem('access_token', response.access_token);
        
        // Call the 'me()' function after successful login
        // localStorage.removeItem('user_info');
        await me();
        // me();

            var userInfoString = localStorage.getItem('user_info');
            var userInfo = JSON.parse(userInfoString);

            console.log(userInfoString);

            
            console.log('isClient after login: ');
            console.log(userInfo);
            if(userInfo.isClient==false)
            {
                location.assign('http://naimikz-project/specs.html');
            }
            else if(userInfo.isClient==true)
            {
                console.log('isClient after login: ');
                console.log(userInfo.isClient);
                location.assign('http://naimikz-project/order.html');
            }
        
    } catch (error) {
        console.error('Error logging in:', error);
    }
}

async function logout() {
    try {
        const response = await $.ajax({
            url: 'http://naimikz-project/api/logout',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token')
            }
        });

        // Remove the access token from local storage
        localStorage.removeItem('access_token');

        // Hide user information after logout
        $('#userInfo').hide();
        alert('Logout successful!');
    } catch (error) {
        console.error('Error logging out:', error);
    }
}

async function me() {
    try {
        const response =await $.ajax({
            url: 'http://naimikz-project/api/me',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('access_token')
            }
        });

        console.log('Response:', response); 
        
        // Save the response to local storage
        localStorage.setItem('user_info', JSON.stringify(response));
        
        // Hide user information after logout
        // For example, you could do something like $('#userInfo').hide();
    } catch (error) {
        console.error('Error logging out:', error);
        // Handle error as needed
    }
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
