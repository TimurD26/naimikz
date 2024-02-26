var user_id1 = 0;

window.onload = function() {
    printUserInfoFromLocalStorage();
};

function printUserInfoFromLocalStorage() {
    var userInfoString = localStorage.getItem('user_info');
    if (userInfoString) {
        // "user_info" exists in local storage
        let userInfo = JSON.parse(userInfoString);
        console.log('User Info:', userInfo);
        console.log(userInfo.id);
        user_id1 = userInfo.id;
     
    } else {
        // "user_info" does not exist in local storage
        console.log('User Info not found in local storage.');
    }
}

$(document).ready(function() {
    $('#orderForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Collect form data
        var formData = {
            category_id: $('#category_id').val(),
            user_id: user_id1,
            isModerated: $('#isModerated').prop('checked'),
            text: $('#text').val(),
            url_to_photo: $('#url_to_photo').val(),
            sum: $('#sum').val(),
            tel_number: $('#tel_number').val(),
            address: $('#address').val(),
            isActive: $('#isActive').prop('checked')
        };

        // Send AJAX request
        $.ajax({
            url: 'http://naimikz-project/api/order', //
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                // Handle success response
                console.log('Order created:', response);
                alert('Order created successfully!');
            },
            error: function(error) {
                // Handle error response
                console.error('Error creating order:', error);
                alert('Failed to create order. Please try again.');
            }
        });
    });

function fetchOrders() {
        $.ajax({
            
            url: 'http://naimikz-project/api/order/by_user_id/'+user_id1, //
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // displayOrders(response); // Call function to display orders
            },
            error: function(xhr, status, error) {
                
                console.error(error); // Log any errors to console
            }
        });
    }
    fetchOrders();
   
    // Call fetchOrders function when the page loads
    
});


   // Function to fetch orders

// Function to display orders on the webpage
function displayOrders(orders) {
    var orderList = $('#order-list');
    orderList.empty(); // Clear previous orders

    // Loop through each order and append it to the list
    orders.forEach(function(order) {
        var listItem = $('<li>').text('Order ID: ' + order.id + ', User ID: ' + order.user_id);
        orderList.append(listItem);
    });
}