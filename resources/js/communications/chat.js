require("../bootstrap");

const messageInput = document.getElementById("message");
const userInput = document.getElementById("user");
const messagesEl = document.getElementById("messages");
const messageForm = document.getElementById("chat-form");

messageForm.addEventListener("submit", function (e) {
    e.preventDefault();

    let hasErrors = false;

    if (userInput.value.trim() == "") {
        alert("Please enter a username");
        hasErrors = true;
    }

    if (messageInput.value.trim() == "") {
        alert("Please enter a message");
        hasErrors = true;
    }

    if (hasErrors) return;

    const options = {
        method: "POST",
        url: "/chat",
        data: {
            username: userInput.value,
            message: messageInput.value,
        },
    };

    axios(options);
	messageInput.value = "";
});

window.Echo.channel("chat").listen(".message", (e) => {
    messagesEl.innerHTML += `
	<div class='message'><strong>${e.username}</strong>: ${e.message}</div>
	`;
});
