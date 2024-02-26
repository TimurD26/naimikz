var user_id1 = 0;

window.onload = function() {
    printUserInfoFromLocalStorage();
};

function printUserInfoFromLocalStorage() {
    var userInfoString = localStorage.getItem('user_info');
    if (userInfoString) {
        var userInfo = JSON.parse(userInfoString);
        console.log('User Info:', userInfo);
        console.log(userInfo.id);
        user_id1 = userInfo.id;
         // Call fetchOrders here
    } else {
        console.log('User Info not found in local storage.');
    }
}

$(document).ready(function() {
    // Make an AJAX request to fetch orders
    $.ajax({
        url: 'http://naimikz-project/api/order/get_all',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Process the response
            displayOrders(response.data);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching orders:', error);
        }
    });

    

    function displayOrders(orders) {
        var ordersList = $('#orders-list');
    
        // Iterate through each order and display it
        orders.forEach(function(order) {

            function fetchUserIds(orderId) {
                // Make an AJAX request to your API
                fetch('http://naimikz-project/api/spec/get_Respoce_by_order_id/' + orderId)
                    .then(response => response.json())
                    .then(records => {
                        // Extract and display user IDs
                        const userIds = records.map(record => record.user_id);
                        const userIdsContainer = document.getElementById('user-ids');
                        userIdsContainer.textContent = userIds.join(', ');
                    })
                    .catch(error => {
                        console.error('Error fetching user IDs:', error);
                    });
            }
            
            function fetchUserIds(orderId) {
    // Make an AJAX request to your API
    fetch('http://naimikz-project/api/spec/get_Respoce_by_order_id/' + orderId)
        .then(response => response.json())
        .then(records => {
            // Extract and display user IDs
            const userIds = records.map(record => record.user_id);
            const userIdsContainer = document.getElementById('user-ids');
            const existingContent = userIdsContainer.textContent;
            const newContent = existingContent ? existingContent + ', ' + userIds.join(', ') : userIds.join(', ');
            userIdsContainer.textContent = newContent;
        })
        .catch(error => {
            console.error('Error fetching user IDs:', error);
        });
}

            // Call the fetchUserIds function with the order ID you want to retrieve records for
            fetchUserIds(order.id);

            var orderHtml = '<div class="order">' +
                                `<p><strong>ID:</strong> ${order.id}</p>` +
                                `<p><strong>Address:</strong> ${order.address}</p>` +
                                `<p><strong>Category ID:</strong> ${order.category_id}</p>` +
                                `<p><strong>Created At:</strong> ${order.created_at}</p>` +
                                `<p><strong>Sum:</strong> ${order.sum}</p>` +
                                `<p><strong>Tel Number:</strong> ${order.tel_number}</p>` +
                                `<p><strong>Text:</strong> ${order.text}</p>` +
                                `<p><strong>Updated At:</strong> ${order.updated_at}</p>` +
                                `<p><strong>User ID:</strong> ${order.user_id}</p>` +
                                `<p><strong>Spec ID:</strong> <span class="spec-id" style="display:none;"></span></p>` +
                                `<div id="user-ids">` +   // Insert user-ids div here
                                `<!-- User IDs will be displayed here -->` +
                                `</div>` +
                                `<button class="add-response-btn" data-order-id="${order.id}">Add Response</button>` +
                            '</div>';
    
            // Append the order HTML to the orders list
            ordersList.append(orderHtml);
        });
    }
    $(document).on('click', '.add-response-btn', function() {
        var orderId = $(this).data('order-id');
        addResponse(orderId);
    });
    function addResponse(orderId) {
        // This is a placeholder function to get the spec_id
        // You should replace this with your logic to get the spec_id for the order
        console.log(user_id1);
    
        // Make AJAX request to the create_Response API endpoint
        $.ajax({
            url: 'http://naimikz-project/api/spec/create_Respoce',
            type: 'POST',
            dataType: 'json',
            data: {
                order_id: orderId,
                user_id: user_id1
            },
            success: function(response) {
                // Handle success response
                console.log('Response added:', response);
                // Here you can update the UI if needed
                // $('.order').find('[data-order-id="' + orderId + '"]').siblings('.user-id').text('Spec ID: ' + userId).show();
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error adding response:', error);
                // Display error message to the user if needed
                alert('Error adding response. Please try again later.');
            }
        });
    }
});
