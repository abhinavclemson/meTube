function postMessage(button, messageBy,messageTo, containerClass) {
    var textarea = $(button).siblings("textarea");
    var messageText = textarea.val();

    //for clearing the text after posting
    textarea.val("");
    if(messageText) {

        $.post("ajax/postMessage.php", { messageText: messageText, messageBy: messageBy,
            messageTo: messageTo })
            .done(function(message){
               $(button).parent().siblings("." + containerClass).append(message);
                }

            );

    }
    else {
        alert("You can't post an empty message");
    }
}
function toggleReply(button) {
    var parent = $(button).closest(".itemContainer");
    var commentForm = parent.find(".messageForm").first();

    commentForm.toggleClass("hidden");
}


function getMessages(button, messageTo, messageBy) {
    $.post("ajax/getMessageReplies.php", {messageTo:messageTo, messageBy: messageBy })
        .done(function(messages) {
            var replies = $("<div>").addClass("repliesSection");
            replies.append(messages);

            $(button).replaceWith(replies);
        });
}