<!DOCTYPE html>
<html>
<head>
<title>Chatbot</title>

<style>
#chat-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #007bff;
    color: #fff;
    padding: 12px 15px;
    border-radius: 50%;
    cursor: pointer;
}

#chatbox {
    display: none;
    position: fixed;
    bottom: 70px;
    right: 20px;
    width: 300px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
}

#chat-header {
    background: #007bff;
    color: #fff;
    padding: 10px;
}

#messages {
    height: 250px;
    overflow-y: auto;
    padding: 10px;
}

#chat-input {
    display: flex;
}

#chat-input input {
    flex: 1;
    padding: 10px;
    border: none;
}

#chat-input button {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px;
}
</style>

</head>
<body>

<div id="chat-toggle" onclick="toggleChat()">💬</div>

<div id="chatbox">
    <div id="chat-header">Chat Support</div>

    <div id="messages"></div>

    <div style="padding:10px;">
        <button onclick="quickMsg('membership')">Membership</button>
        <button onclick="quickMsg('booking')">Booking</button>
        <button onclick="quickMsg('support')">Support</button>
    </div>

    <div id="chat-input">
        <input type="text" id="userInput" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
    </div>
</div>

<script>
function toggleChat(){
    let box = document.getElementById('chatbox');
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
}

function sendMessage(){
    let input = document.getElementById('userInput');
    let msg = input.value;

    if(!msg) return;

    let messages = document.getElementById('messages');

    messages.innerHTML += `<p><b>You:</b> ${msg}</p>`;

    fetch('/chatbot/getResponse', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'message=' + msg
    })
    .then(res => res.json())
    .then(data => {
        messages.innerHTML += `<p><b>Bot:</b> ${data.reply}</p>`;
        messages.scrollTop = messages.scrollHeight;
    });

    input.value = '';
}

function quickMsg(text){
    document.getElementById('userInput').value = text;
    sendMessage();
}
</script>

</body>
</html>