<div id="chatIcon" class="chat-icon">
    <i class="fas fa-comments"></i>
</div>

<div id="chatBox" class="chat-box">
    <div class="chat-header">
        <button id="closeChat" class="close-btn">&times;</button>
    </div>
    <div class="chat-body" id="chatMessages">
        <!-- Chat messages will appear here -->
    </div>
    <div class="chat-footer">
        <input type="text" id="chatInput" placeholder="Type your message..." class="form-control">
        <button id="sendChat" class="btn">Send</button>
    </div>
</div>

<script>
    document.getElementById('chatIcon').addEventListener('click', function() {
        document.getElementById('chatBox').style.display = 'flex';
    });


    document.getElementById('closeChat').addEventListener('click', function() {
        document.getElementById('chatBox').style.display = 'none';
    });

    document.getElementById('chatIcon').addEventListener('click', function() {
        const chatBox = document.getElementById('chatBox');
        chatBox.style.display = 'flex';

        const orderId = {{ $order->id }};

        fetch(`/comments/${orderId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const chatMessages = document.getElementById('chatMessages');
                chatMessages.innerHTML = '';

                const isAdmin =
                    {{ Auth::user()->is_admin ? 'true' : 'false' }};

                data.comments.forEach(comment => {
                    const messageElement = document.createElement('p');
                    const isSender = comment.sender_id === {{ Auth::id() }};
                    messageElement.className = isSender ? 'message-sender' : 'message-receiver';

                    const messageText = document.createElement('span');
                    messageText.textContent = `${comment.sender_name}: ${comment.comment}`;

                    // Check if the message has been read by the admin
                    if (comment.read) {
                        const seenIndicator = document.createElement('span');
                        seenIndicator.innerHTML = '&#x2713;&#x2713;';
                        seenIndicator.className = 'seen-indicator';
                        seenIndicator.style.float = 'right';
                        messageElement.appendChild(seenIndicator);
                    }

                    const dateElement = document.createElement('span');
                    dateElement.textContent = comment.created_at;
                    dateElement.className = 'message-date';

                    messageElement.appendChild(messageText);
                    messageElement.appendChild(dateElement);

                    chatMessages.appendChild(messageElement);
                });
            })
            .catch(error => {
                console.error('Error fetching comments:', error);
            });
    });

    document.getElementById('sendChat').addEventListener('click', function() {
        const chatInput = document.getElementById('chatInput');
        const commentText = chatInput.value;

        if (commentText.trim() === '') {
            alert('Please enter a message.');
            return;
        }

        const orderId = {{ $order->id }};

        fetch('/comments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    comment: commentText,
                    order_id: orderId
                })
            })
            .then(response => response.json())
            .then(data => {
                chatInput.value = '';

                const chatMessages = document.getElementById('chatMessages');
                const messageElement = document.createElement('p');
                messageElement.className = 'message-sender';

                const messageText = document.createElement('span');
                messageText.textContent = `You: ${data.comment}`;

                const dateElement = document.createElement('span');
                dateElement.textContent = data.created_at;
                dateElement.className = 'message-date';

                messageElement.appendChild(messageText);
                messageElement.appendChild(dateElement);
                chatMessages.appendChild(messageElement);
            })
            .catch(error => {
                console.error('Error sending comment:', error);
            });
    });
</script>

<style>
    .chat-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #dd61be;
        color: #fff;
        padding: 15px;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .chat-box {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 300px;
        height: 400px;
        background-color: #EEEDEB;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        display: none;
        flex-direction: column;
        z-index: 1000;
    }

    .chat-header {
        color: #fff;
        padding: 10px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        border-radius: 10px 10px 0 0;
    }

    .chat-body {
        flex-grow: 1;
        padding: 10px;
        overflow-y: auto;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
    }

    .chat-body p {
        padding: 10px;
        margin: 5px 0;
        border-radius: 10px;
        max-width: 80%;
    }

    .message-sender {
        background-color: #dd61be;
        color: white;
        align-self: flex-end;
    }

    .message-receiver {
        background-color: #e0e0e0;
        color: black;
        align-self: flex-start;

    }

    .chat-footer {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ccc;
    }

    .chat-footer input {
        flex-grow: 1;
        margin-right: 10px;
    }

    .close-btn {
        background: none;
        border: none;
        color: #000000;
        font-size: 20px;
        cursor: pointer;
    }

    .chat-body {
        scrollbar-width: thin;
        scrollbar-color: #dd61be #f4f4f4;
    }

    .chat-body::-webkit-scrollbar {
        width: 6px;
    }

    .chat-body::-webkit-scrollbar-thumb {
        background-color: #dd61be;
        border-radius: 10px;
    }

    .chat-footer .btn {
        background-color: #dd61be;
    }

    .message-date {
        display: block;
        font-size: 12px;
        color: #4d4d4d;
        margin-top: 2px;
    }

    .seen-indicator {
        color: rgb(0, 140, 255);
        margin-left: 5px;
        font-size: 14px;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .chat-box {
            width: 90%;
            /* Full width on small screens */
            height: 300px;
            /* Reduce height on smaller screens */
        }
    }

    @media (max-width: 480px) {
        .chat-footer input {
            margin-right: 5px;
            /* Reduce space between input and button */
        }

        .chat-icon {
            padding: 10px;
            /* Smaller icon on small screens */
        }
    }
</style>
