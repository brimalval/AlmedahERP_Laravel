<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
</head>
<body>
  <h1>Pusher Test</h1>
  <form action="chat" method="POST" id="chat-form">
    <input type="text" name="user" id="user" placeholder="User">
    <input type="text" name="message" id="message" placeholder="Message">
    <button type="submit">Send</button>
  </form>

  <div id="messages">

  </div>
</body>

<script src="./js/app.js"></script>