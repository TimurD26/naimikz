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

   

    // function fetchUserIds(orderId, userIdsContainer) {
    //     // Make an AJAX request to your API
    //     fetch('http://naimikz-project/api/spec/get_Respoce_by_order_id/' + orderId)
    //         .then(response => response.json())
    //         .then(records => {
    //             // Extract and display user IDs
    //             const userIds = records.map(record => record.user_id);
    //             const existingContent = userIdsContainer.textContent;
    //             const newContent = existingContent ? existingContent + ', ' + userIds.join(', ') : userIds.join(', ');
    //             userIdsContainer.textContent = newContent;
    //         })
    //         .catch(error => {
    //             console.error('Error fetching user IDs:', error);
    //         });
    // }

    function fetchUserIds(orderId, userIdsContainer) {
        // Make an AJAX request to your API
        fetch('http://naimikz-project/api/spec/get_Respoce_by_order_id/' + orderId)
            .then(response => response.json())
            .then(records => {
                // Extract and display user IDs
                const userIds = records.map(record => record.user_id);
                // Reset content of userIdsContainer
                userIdsContainer.textContent = ''; // Clear existing content
           
                const existingContent = userIdsContainer.textContent;
                const newContent = existingContent ? existingContent + ', ' + userIds.join(', ') : userIds.join(', ');
                userIdsContainer.textContent = newContent;
            })
            .catch(error => {
                console.error('Error fetching user IDs:', error);
            });
    }
    var temp1;
    var temp2;

    var userIdsContainers = {}; // Object to store userIdsContainer elements

function displayOrders(orders) {
    var ordersList = $('#orders-list');

    orders.forEach(function(order) {
        var userIdsContainer = document.createElement('div');
        userIdsContainer.className = 'user-ids-container';

        fetchUserIds(order.id, userIdsContainer);

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
            `<button class="add-response-btn" data-order-id="${order.id}">Add Response</button>` +
            '</div>';

        var orderElement = $(orderHtml);
        orderElement.append(userIdsContainer);
        ordersList.append(orderElement);

        // Store the userIdsContainer element in the userIdsContainers object
        userIdsContainers[order.id] = userIdsContainer;
    });
}

$(document).on('click', '.add-response-btn', function() {
    var orderId = $(this).data('order-id');
    addResponse(orderId);
});

function addResponse(orderId) {
    console.log(user_id1);

    $.ajax({
        url: 'http://naimikz-project/api/spec/create_Respoce',
        type: 'POST',
        dataType: 'json',
        data: {
            order_id: orderId,
            user_id: user_id1
        },
        success: function(response) {
            console.log('Response added:', response);
            // Update the corresponding userIdsContainer with the new response
            fetchUserIds(orderId, userIdsContainers[orderId]);
        },
        error: function(xhr, status, error) {
            console.error('Error adding response:', error);
            alert('Error adding response. Please try again later.');
        }
    });
}

    
});
