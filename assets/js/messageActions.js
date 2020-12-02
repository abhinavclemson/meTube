function postMessage(button, messageBy,messageTo, containerClass) {
    var textarea = $(button).siblings("textarea");
    var messageText = textarea.val();
    textarea.val("");

    if(messageText) {

        $.post("ajax/postMessage.php", { messageText: messageText, messageBy: messageBy,
            messageTo: messageTo })
            .done(function(message){

                if(!replyTo) {
                    $("." + containerClass).prepend(message);
                }
                else {
                    $(button).parent().siblings("." + containerClass).append(message);
                }

            });

    }
    else {
        alert("You can't post an empty message");
    }
}

function toggleReply(button) {
    var parent = $(button).closest(".itemContainer");
    var messageForm = parent.find(".messageForm").first();

    messageForm.toggleClass("hidden");
}





function getReplies(messageId, button) {
    $.post("ajax/getMessageReplies.php", { messageId: messageId, messageBy: messageBy})
        .done(function(messages) {
            var replies = $("<div>").addClass("repliesSection");
            replies.append(messages);

            $(button).replaceWith(replies);
        });
}