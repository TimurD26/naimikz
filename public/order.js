var user_id1 = 0;

window.onload = function() {
    printUserInfoFromLocalStorage();
    getCategories();
};

function printUserInfoFromLocalStorage() {
    var userInfoString = localStorage.getItem('user_info');
    if (userInfoString) {
        var userInfo = JSON.parse(userInfoString);
        console.log('User Info:', userInfo);
        console.log(userInfo.id);
        user_id1 = userInfo.id;
        fetchOrders(); // Call fetchOrders here
    } else {
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
                fetchOrders();
            },
            error: function(error) {
                // Handle error response
                console.error('Error creating order:', error);
                alert('Failed to create order. Please try again.');
            }
        });
    });
    
});
console.log(user_id1);
function fetchOrders() {
    $.ajax({
        
        url: 'http://naimikz-project/api/order/by_user_id/'+user_id1, //
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            displayOrders(response); // Call function to display orders
        },
        error: function(xhr, status, error) {
            
            console.error(error); // Log any errors to console
        }
    });
}
// fetchOrders();


// Function to display orders on the webpage
function displayOrders(orders) {
    // Assuming you have an element with id "orders-list" where you want to display orders
    var ordersList = document.getElementById('orders-list');
    
    // Clear any existing content
    ordersList.innerHTML = '';

    // Loop through each order
    orders.forEach(function(order) {
        // Create a list item for each order
        var listItem = document.createElement('li');

        // Set the inner HTML of the list item with order details
        listItem.innerHTML = `
            <p><strong>ID:</strong> ${order.id}</p>
            <p><strong>Address:</strong> ${order.address}</p>
            <p><strong>Category ID:</strong> ${order.category_id}</p>
            <p><strong>Created At:</strong> ${order.created_at}</p>
            <p><strong>Sum:</strong> ${order.sum}</p>
            <p><strong>Tel Number:</strong> ${order.tel_number}</p>
            <p><strong>Text:</strong> ${order.text}</p>
            <p><strong>Updated At:</strong> ${order.updated_at}</p>
            <p><strong>User ID:</strong> ${order.user_id}</p>
        `;

        // Append the list item to the orders list
        ordersList.appendChild(listItem);
    });
}

function getCategories(){
    $.ajax({
        url: 'http://naimikz-project/api/categories', //
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            setCategories(response); // Call function to display orders
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors to console
        }
    });
}

function setCategories(categories){
    categories.forEach(function(category) {
        $( "#category_id" ).append( `<option value="${category.id}">${category.category_name}</option>` );
        // categoryList.innerHTML = `
        //     <option value="${category.id}">${category.category_name}</option>
        // `;
    });
}
