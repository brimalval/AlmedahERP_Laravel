// Caching the messages when requested
const messageCache = {};
// Storage for components that need to be duplicated
const components = $("#component-storage");
// Variable to track which chat is being viewed
var activeChat = null;
// Checking whether the user is currently replying to a chat
var replying = false;

// Functions concerned with form submission
var recipients = [];
const recipientField = $("#msg-to");
const recipientFieldRow = $("#row-to");
const addRecipientButton = $("#add-recipient-btn");

const saveBtn = $("#message-save-btn");
const messagingForm = $("#messaging-form");
const msgBody = $("#msg-body");

const department = $(".dept");
const msgGroup = $(".msg-grp-lbl");
var currentGroup = null;

function resetForm() {
    recipients = [];
    messagingForm[0].reset();
    recipientFieldRow.slideUp();
    msgBody.summernote("reset");
    currentGroup = null;
    msgGroup.text("Select Department or Role group");
}

department.on("click", function (e) {
    msgGroup.text(this.text);
    currentGroup = this.text;
    // ADD API CALL TO FETCH THE EMPLOYEES IN THIS DEPT
    // DO THE SLIDE DOWN HERE INSTEAD OF IN THE OTHER JS FILE
});

addRecipientButton.off("click").on("click", function (e) {
    e.preventDefault();
    const recipientName = recipientField.val();
    if (recipientName.trim() == "") {
        alert("Enter a recipient pre");
        return false;
    }

    recipients.push(recipientName);
    console.log("Recipients:", recipients);
});

saveBtn.off("click").on("click", function (e) {
    e.preventDefault();
    messagingForm.submit();
});

messagingForm.off("submit").on("submit", function (e) {
    e.preventDefault();
    let fd = new FormData(this);
    fd.append("recipients", JSON.stringify(recipients));
    fd.append("message", msgBody.summernote("code"));

    $.ajax({
        type: "POST",
        url: this.action,
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: function (data) {
            console.log(data);
            msgModal.modal("hide");
            if (data.created_new_chat) {
                addChat(data.chat, data.message);
            } else {
                addMessage(data.message, replying);
                setMessagePreview(data.chat.id, data.message.message);
            }
        },
        error: function (data) {
            console.log("error");
            console.log(data);
        },
    });
});

// Functions concerned with modals
const msgModal = $("#messageModal");
const modalBtn = $(".msg-modal-btn");
const closeBtn = $(".msg-modal-close-btn");
const subjectField = $('input[name="subject"]');

// Initialize modal
msgModal.modal("dispose");
// Pressing escape will not exist the modal nor will clicking the background
msgModal.modal({
    keyboard: false,
    backdrop: false,
});

// Hides checkbox for "send individual messages" if creating a new message
function hideSepMessageCheckbox() {
    const checkboxDiv = $("#checkbox-individual-messages");
    const checkbox = checkboxDiv.find("input");
    checkbox.attr("name", null);
    checkboxDiv.css("display", "none");
}

// Shows checkbox for "send individual messages" if creating a new message
function showSepMessageCheckbox() {
    const checkboxDiv = $("#checkbox-individual-messages");
    const checkbox = checkboxDiv.find("input");
    checkbox.attr("name", "individual_messages");
    checkboxDiv.css("display", "block");
}

// For creating a new message (as opposed to replying to one)
modalBtn.off("click").on("click", function (e) {
    e.preventDefault();
    $("#chat_id").val(null);
    subjectField.val("");
    subjectField.attr("readonly", null);
    showSepMessageCheckbox();
    msgModal.modal("show");
    replying = false;
});

// Hide message modal when close button is clicked
closeBtn.off("click").on("click", function (e) {
    e.preventDefault();
    $("#chat_id").val(null);
    msgModal.modal("hide");
});

// Prevent backdrop from doubling up
msgModal.on("hide.bs.modal", function () {
    const backdrop = $(".modal-backdrop");
    console.log("len", backdrop);
    if (backdrop.length !== 1) $(".modal-backdrop").remove();
});

// Reset form upon closing the message modal
msgModal.off("hidden.bs.modal").on("hidden.bs.modal", function (e) {
    e.preventDefault();
    resetForm();
});

// Functions concerned with displaying messages

/**
 * Fetch a component from the components-storage div
 * @param {string} query
 * @returns {false|object} false if the specified component
 * is not found, returns the component otherwise
 */
function getComponent(query) {
    const result = components.find(query);
    if (!result[0]) {
        return false;
    }
    return result.clone();
}

// Header of message content
const msgHeader = getComponent(".msg-header");
// Div for displaying content
const msgContent = $(".msg-content");
// Subject header
const subject = msgHeader.find(".msg-subject");
// Component with sample data
const msgSample = getComponent(".msg-thread-item");
// The chat boxes in the sidebar

/**
 * Populate the message content div with details about
 * the chat and its messages
 * @param {Chat} chat
 * @param {Message[]} messages
 */
function setMessages(chat, messages) {
    // Setting the subject before appending
    subject.html(chat.subject);

    msgContent.empty();
    msgContent.append(msgHeader);
    msgContent.append("<hr/>");

    for (message of messages) {
        addMessage(message);
    }
    msgContent.find(".reply-btn").data("id", chat.id);
}

/**
 * Add chat to chat list
 * @param {object} chat
 */
function addChat(chat, message) {
    const chatItem = getComponent(".main-item").clone();
    chatItem.data("id", chat.id);
    const inboxNav = $("#inbox-nav");
    const date = new Date(chat.created_at);
    const dateStr = date.toLocaleString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });

    const createdAtEl = chatItem.find(".created-at");
    const createdByEl = chatItem.find(".created-by");
    const subjectEl = chatItem.find(".subject");
    const bodyEl = chatItem.find(".msg-body");
    createdAtEl.text(dateStr);
    createdByEl.text(chat.created_by.toUpperCase());
    subjectEl.text(chat.subject);
    bodyEl.html(message.message);

    inboxNav.prepend(chatItem);
}

/**
 * Add a message to message content div
 * @param {object} message
 */
function addMessage(message, replying = false) {
    console.log(message);
    const sampleClone = msgSample.clone();
    const sender = sampleClone.find(".msg-body-sender");
    const sent = sampleClone.find(".msg-body-sent");
    const body = sampleClone.find(".msg-body");
    const sentDate = new Date(message.created_at);

    const dateStr = sentDate.toLocaleString("en-US", {
        month: "long",
        day: "numeric",
        year: "numeric",
    });
    const timeStr = sentDate.toLocaleTimeString("en-US", {
        hour: "numeric",
        minute: "numeric",
    });

    body.html(message.message);
    sender.text(message.from);
    sent.text(`${dateStr} at ${timeStr}`);

    msgContent.append(sampleClone);
    msgContent.append("<hr/>");
    if (replying) messageCache[activeChat].messages.push(message);
}

/**
 * Finds the box for the chat and changes
 * the message previewed in it accdg to the id
 * and text given
 * @param {number} id
 * @param {string} text
 */
function setMessagePreview(id, text) {
    console.log("id", id, "text", text);
    const chatItem = $(`#message-preview-${id}`);
    chatItem.html(text);
}

$(document).on("click", ".main-item", function (e) {
    e.preventDefault();
    // From Rapanot
    if (!$(this).hasClass("msg-active")) {
        $(this).addClass("msg-active");
        $(this).siblings().removeClass("msg-active");
        $(this)
            .siblings()
            .find(".inbox-selector")
            .children()
            .prop("checked", false);
        $(this).find(".inbox-selector").children().prop("checked", true);
    } else {
        $(this).removeClass("msg-active");
        $(this).find(".inbox-selector").children().prop("checked", false);
    }

    const id = $(this).data("id");
    activeChat = id;

    if (messageCache[id]) {
        const chat = messageCache[id].chat;
        const messages = messageCache[id].messages;
        setMessages(chat, messages);
        return;
    }

    msgContent.html(
        `<div class="spinner-border m-5" role="status" style="width: 5rem; height: 5rem">
            <span class="sr-only">Loading...</span>
         </div>`
    );

    $.ajax({
        type: "GET",
        url: `/chat/${id}`,
        contentType: false,
        processData: false,
        cache: false,
        success: function (data) {
            // Declaring types somehow
            const chat = { ...data.chat };
            const messages = [...data.messages];
            setMessages(chat, messages);
            messageCache[chat.id] = {
                chat: chat,
                messages: messages,
            };
            console.log(messageCache);
        },
        error: function (data) {
            console.log("error");
            console.log(data);
        },
    });
});

$(document).on("click", ".reply-btn", function (e) {
    e.preventDefault();
    const id = $(this).data("id");
    console.log(id);
    if (id == "" || id == undefined) {
        return;
    }
    replying = true;

    hideSepMessageCheckbox();
    // Assumed that the chat is already in the cache
    // since the button will only appear
    // if the chat was loaded in already
    const chat = messageCache[id].chat;
    subjectField.val(chat.subject);
    subjectField.attr("readonly", true);
    $("#chat_id").val(id);
    msgModal.modal("show");
});

msgModal.on("bs.modal.hide", function () {
    $(".modal-backdrop").remove();
});
