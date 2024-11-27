<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);
        @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");

        .navbar-brand {
            color: rgba(7, 58, 2, 0.288) !important;
            font-weight: bold;
        }

        .notification {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .timestamp {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .page-item.active .page-link {
            background-color: #000000;

            border-color: #28a745;
        }

        .page-link {
            color: #000000;
            background-color: white;
            border: 1px solid #dee2e6;
        }

        .page-link:focus {
            box-shadow: none;
            /* Remove focus outline */
        }

        .custom-badge {
            background-color: #ff4757;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.75rem;
            font-weight: bold;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            min-width: 1.5rem;
            text-align: center;
        }

        .custom-badge:empty {
            display: none;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg"
            id="navbarVertical">
            <div class="container-fluid">
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
                    FOOD
                </a>
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" id="allItemsTab" class="nav-link active">All Items</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" id="sharedTab" class="nav-link font-regular">Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" id="foodRequestsTab" class="nav-link font-regular">Food Requests<span
                                    id="pendingBadge" class="badge custom-badge">{{ $pendingCount }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" id="activityLogTab" class="nav-link font-regular">Activity Log</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" id="commentsTab" class="nav-link font-regular">Comments<span
                                    id="unreadBadge" class="badge custom-badge"></span></a>
                        </li>
                    </ul>

                    <hr class="navbar-divider my-5 opacity-20">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/superAdmin/analytics" class="nav-link font-regular">Analytics log</a>
                        </li>
                    </ul>

                    <div class="mt-auto"></div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Image"
                                    class="rounded-circle my-2" style="width: 30px; height: 30px;">&nbsp;Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                {{-- <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                                </a> --}}
                                <a class="nav-link" href="{{ route('logout') }}" onclick="confirmLogout(event)">
                                    <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            {{-- <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <h1 class="h2 mb-0 ls-tight">Food Items</h1>
                            </div> --}}
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div id="createButtonContainer" style="display: none;">
                                    <a href="create" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class="pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Create</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs mt-4 overflow-x border-0"></ul>
                    </div>
                </div>
            </header>
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <div id="allItemsContent">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Items</h5>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Id</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Schedule</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($foods as $food)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $food->image) }}" alt="Food Image"
                                                        class="avatar avatar-sm rounded-circle me-2">
                                                    {{ $food->name }}
                                                </td>
                                                <td>{{ $food->description }}</td>
                                                <td>{{ $food->price }}</td>
                                                <td>{{ $food->id }}</td>
                                                <td>{{ $food->category }}</td>
                                                <td>
                                                    <span class="badge badge-lg badge-dot">
                                                        <i class="bg-success"></i>Scheduled
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.view', ['id' => $food->id]) }}"
                                                        class="btn btn-sm btn-neutral"><i class="bi bi-eye"></i></a>
                                                    <a href="{{ route('admin.edit', ['id' => $food->id]) }}"
                                                        class="btn btn-sm btn-neutral"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $foods->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                    <div id="sharedContent" style="display:none;">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Users</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->usertype }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                    <div id="foodRequestsContent" style="display:none;">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Food Requests</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Order Id</th>
                                            <th scope="col">User Id</th>
                                            <th scope="col">Total Amount (Rs)</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Request At</th>
                                            <th scope="col">status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user_id }}</td>
                                                <td>{{ $order->total_amount }}</td>
                                                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                                    title="{{ $order->address }}">
                                                    {{ Str::limit($order->address, 30, '...') }}
                                                </td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td class="text-end">
                                                    @if ($order->status === 'pending')
                                                        <button class="btn btn-sm btn-success update-status"
                                                            data-id="{{ $order->id }}"
                                                            data-status="accept">Accept</button>
                                                        <button class="btn btn-sm btn-danger update-status"
                                                            data-id="{{ $order->id }}"
                                                            data-status="reject">Reject</button>
                                                    @elseif($order->status === 'accept')
                                                        <span class="text-success">Accepted</span>
                                                    @elseif($order->status === 'reject')
                                                        <span class="text-danger">Rejected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                    <div id="activityLogContent" style="display:none;">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Activity Log</h5>
                                <!-- Filter form -->
                                <form id="filter-form" class="d-flex">
                                    <select id="user-filter" name="user_id" class="form-control mx-2 my-2">
                                        <option value="">Select User</option>
                                        @foreach ($nonAdminUsers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="date" id="date-from" name="date_from"
                                        class="form-control mx-2 my-2">
                                    <input type="date" id="date-to" name="date_to"
                                        class="form-control mx-2 my-2">
                                    <button type="button" id="filter-btn"
                                        class="btn btn-info mx-2 my-2">Filter</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action By</th>
                                            <th scope="col">Action Type</th>
                                            <th scope="col">IP Address</th>
                                            <th scope="col">Browser Info</th>
                                            <th scope="col">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody id="activity-log-tbody">
                                        <!-- Content will be populated via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="commentsContent" style="display:none;">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-body">
                                <div id="commentsList" class="mb-3" style="max-height: 300px; overflow-y: auto;">
                                    <!-- Comments will be populated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Reply Popup Modal -->
                    <div id="replyPopup" class="popup" style="display:none;">
                        <div class="popup-content">
                            <!-- Dynamic Order ID -->
                            <h4 id="orderIdHeading"></h4> <!-- This will display the Order ID -->

                            <p id="commentText"></p>

                            <!-- Admin Reply Input -->
                            <input type="text" id="replyInput" placeholder="Type your reply here..." />

                            <button id="sendReplyButton" class="btn btn-primary">Send Reply</button>
                            <button onclick="document.getElementById('replyPopup').style.display='none'"
                                class="btn btn-secondary">Close</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showTabContent(tabName) {
            document.getElementById('allItemsContent').style.display = 'none';
            document.getElementById('sharedContent').style.display = 'none';
            document.getElementById('foodRequestsContent').style.display = 'none';
            document.getElementById('activityLogContent').style.display = 'none';
            document.getElementById('commentsContent').style.display = 'none';

            const tabs = document.querySelectorAll('.nav-link');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            if (tabName === "All Items") {
                document.getElementById('allItemsContent').style.display = 'block';
                document.getElementById('createButtonContainer').style.display = 'block';
                document.getElementById('allItemsTab').classList.add('active');
            } else {
                document.getElementById('createButtonContainer').style.display = 'none';
            }
            if (tabName === "Users") {
                document.getElementById('sharedContent').style.display = 'block';
                document.getElementById('sharedTab').classList.add('active');
            } else if (tabName === "Food Requests") {
                document.getElementById('foodRequestsContent').style.display = 'block';
                document.getElementById('foodRequestsTab').classList.add('active');
            } else if (tabName === "Activity Log") {
                fetchActivityLog();
                document.getElementById('activityLogContent').style.display = 'block';
                document.getElementById('activityLogTab').classList.add('active');
            } else if (tabName === "Comments") {
                fetchComments();
                document.getElementById('commentsContent').style.display = 'block';
                document.getElementById('commentsTab').classList.add('active');
            }
            localStorage.setItem('activeTab', tabName);
        }

        document.getElementById('allItemsTab').addEventListener('click', function() {
            showTabContent("All Items");
        });
        document.getElementById('sharedTab').addEventListener('click', function() {
            showTabContent("Users");
        });
        document.getElementById('foodRequestsTab').addEventListener('click', function() {
            showTabContent("Food Requests");
        });
        document.getElementById('activityLogTab').addEventListener('click', function() {
            showTabContent("Activity Log");
        });
        document.getElementById('commentsTab').addEventListener('click', function() {
            showTabContent("Comments");
        });

        document.getElementById('filter-btn').addEventListener('click', function() {
            const userFilter = document.getElementById('user-filter').value;
            const dateFrom = document.getElementById('date-from').value;
            const dateTo = document.getElementById('date-to').value;

            // Call the function to fetch the filtered data
            fetchActivityLog(userFilter, dateFrom, dateTo);
        });

        function fetchActivityLog(userId, dateFrom, dateTo) {
            const url = new URL('/admin/activity-log', window.location.href);
            const params = new URLSearchParams();

            if (userId) params.append('user_id', userId);
            if (dateFrom) params.append('date_from', dateFrom);
            if (dateTo) params.append('date_to', dateTo);

            url.search = params.toString();

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    const tbody = document.querySelector('#activityLogContent tbody');
                    tbody.innerHTML = '';

                    data.forEach(activity => {

                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${activity.description}</td>
                    <td>${activity.causer ? activity.causer.name : 'N/A'}</td>
                    <td>${activity.event || 'N/A'}</td>
                    <td>${activity.properties['ip_address'] || 'N/A'}</td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${activity.properties['browser_info'] || 'N/A'}">
                        ${activity.properties['browser_info'] ? (activity.properties['browser_info'].length > 30 ? activity.properties['browser_info'].substring(0, 30) + '...' : activity.properties['browser_info']) : 'N/A'}
                    </td>
                    <td>${new Date(activity.created_at).toLocaleString('en-GB')}</td>
                `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching activity log:', error));
        }

        function fetchComments() {
            fetch('/admin/comments')
                .then(response => response.json())
                .then(data => {
                    const commentsList = document.getElementById('commentsList');
                    commentsList.innerHTML = '';

                    // Update unread comments badge
                    const unreadBadge = document.getElementById('unreadBadge');
                    if (unreadBadge) {
                        unreadBadge.textContent = data.unreadCount > 0 ? data.unreadCount : '';
                    }

                    data.comments.forEach(comment => {
                        const commentItem = document.createElement('div');
                        commentItem.className = 'notification';
                        commentItem.style.backgroundColor = comment.read ? '#e9ecef' : '#ffffff';

                        // Display the comment
                        const commentContent = document.createElement('div');
                        commentContent.className = 'comment-content';
                        commentContent.textContent =
                            `Order ID: #${comment.order_id} - ${comment.sender.name}: ${comment.comment}`;

                        if (comment.created_at) {
                            const timeStamp = document.createElement('span');
                            timeStamp.className = 'timestamp';
                            timeStamp.textContent =
                                ` (${new Date(comment.created_at).toLocaleString('en-GB')})`;
                            commentContent.appendChild(timeStamp);
                        }

                        // Mark as Read Button
                        const markAsReadButton = document.createElement('button');
                        markAsReadButton.textContent = comment.read ? '✔✔' : 'Mark as Read';
                        markAsReadButton.className =
                            `btn btn-sm ${comment.read ? 'btn-success' : 'btn-secondary'} ms-2`;
                        markAsReadButton.disabled = comment.read;
                        markAsReadButton.onclick = () => markAsRead(comment.id, commentItem);

                        // Reply Button
                        const replyButton = document.createElement('button');
                        replyButton.textContent = 'Reply';
                        replyButton.className = 'btn btn-sm btn-info ms-2';
                        replyButton.onclick = () => openReplyPopup(comment);

                        commentItem.appendChild(commentContent);
                        commentItem.appendChild(markAsReadButton);
                        commentItem.appendChild(replyButton);
                        commentsList.appendChild(commentItem);
                    });
                })
                .catch(error => console.error('Error fetching comments:', error));
        }

        function markAsRead(commentId, commentElement) {
            fetch(`/admin/comments/${commentId}/mark-as-read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        read: true
                    })
                })
                .then(response => {
                    if (response.ok) {
                        commentElement.style.backgroundColor = '#e9ecef';
                        const button = commentElement.querySelector('button');
                        button.innerHTML = '&#10003;';
                        button.classList.remove('btn-secondary');
                        button.classList.add('btn-success');
                        button.disabled = true;
                    }
                })
                .catch(error => console.error('Error marking comment as read:', error));
        }

        function openReplyPopup(comment) {
            const popup = document.getElementById('replyPopup');
            const commentText = document.getElementById('commentText');
            const replyInput = document.getElementById('replyInput');
            const replyButton = document.getElementById('sendReplyButton');
            const orderIdHeading = document.getElementById('orderIdHeading');

            orderIdHeading.textContent = `Reply to Order ID: #${comment.order_id}`;
            commentText.textContent = `Comment: ${comment.comment}`;
            replyInput.value = ''; // Clear any previous input

            popup.style.display = 'block';

            replyButton.onclick = function() {
                const reply = replyInput.value.trim();
                if (reply) {
                    sendReply(comment.id, reply);
                    popup.style.display = 'none'; // Close the popup after sending reply
                }
            };
        }

        function sendReply(commentId, reply) {
            fetch(`/admin/comments/${commentId}/reply`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
                    },
                    body: JSON.stringify({
                        reply: reply
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchComments();
                    } else {
                        alert('Error sending reply!');
                    }
                })
                .catch(error => console.error('Error sending reply:', error));
        }

        fetchComments();
        const activeTab = localStorage.getItem('activeTab') || "All Items";
        showTabContent(activeTab);

        $(document).on('click', '.update-status', function() {
            const orderId = $(this).data('id');
            const status = $(this).data('status');

            $.ajax({
                url: '/order/' + orderId + '/status', // Update the URL to match your route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    status: status
                },
                success: function(response) {
                    // Update the UI based on the response
                    if (status === 'accept') {
                        $('button[data-id="' + orderId + '"]').parent().html(
                            '<span class="text-success">Accepted</span>');
                    } else {
                        $('button[data-id="' + orderId + '"]').parent().html(
                            '<span class="text-danger">Rejected</span>');
                    }
                },
                error: function(xhr) {
                    // Handle errors
                    alert('An error occurred. Please try again.');
                }
            });
        });

        function updatePendingBadge(orders) {
            const pendingCount = orders.filter(order => order.status === 'pending').length;
            const badge = document.getElementById('pendingBadge');

            if (pendingCount > 0) {
                badge.textContent = pendingCount; // Set badge text to count
            } else {
                badge.textContent = ''; // Clear badge text if no pending orders
            }
        }

        function confirmLogout(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure you want to log out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log out'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>

</html>
