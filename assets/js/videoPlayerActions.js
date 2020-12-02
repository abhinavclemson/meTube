function likeVideo(button, videoId) {
    $.post("ajax/likeVideo.php", {videoId: videoId})
        .done(function(data) {

            var likeButton = $(button);
            var dislikeButton = $(button).siblings(".dislikeButton");

            likeButton.addClass("active");
            dislikeButton.removeClass("active");

            var result = JSON.parse(data);
            updateLikesValue(likeButton.find(".text"), result.likes);
            updateLikesValue(dislikeButton.find(".text"), result.dislikes);

            if(result.likes < 0) {
                likeButton.removeClass("active");
                likeButton.find("img:first").attr("src", "assets/images/icons/Like.png");
            }
            else {
                likeButton.find("img:first").attr("src", "assets/images/icons/Liked.png")
            }

            dislikeButton.find("img:first").attr("src", "assets/images/icons/Dislike.png");
        });
}

function dislikeVideo(button, videoId) {
    $.post("ajax/dislikeVideo.php", {videoId: videoId})
        .done(function(data) {

            var dislikeButton = $(button);
            var likeButton = $(button).siblings(".likeButton");

            dislikeButton.addClass("active");
            likeButton.removeClass("active");

            var result = JSON.parse(data);
            updateLikesValue(likeButton.find(".text"), result.likes);
            updateLikesValue(dislikeButton.find(".text"), result.dislikes);

            if(result.dislikes < 0) {
                dislikeButton.removeClass("active");
                dislikeButton.find("img:first").attr("src", "assets/images/icons/Dislike.png");
            }
            else {
                dislikeButton.find("img:first").attr("src", "assets/images/icons/Disliked.png")
            }

            likeButton.find("img:first").attr("src", "assets/images/icons/Like.png");
        });
}
function favourite(button, videoId) {
    $.post("ajax/favourite.php", {videoId: videoId})
        .done(function(data) {

            var favouriteButton = $(button);

            favouriteButton.addClass("active");

            var result = JSON.parse(data);

            if(result.fav <1) {
                favouriteButton.removeClass("active");
                favouriteButton.find("img:first").attr("src", "assets/images/icons/unfav.png");
            }
            else {
                favouriteButton.find("img:first").attr("src", "assets/images/icons/fav.png")
            }


        });
}




function updateLikesValue(element, num) {
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}

