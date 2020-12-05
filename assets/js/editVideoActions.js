function setNewThumbnail(thumbnailId, videoId, itemElement) {
    $.post("ajax/updateThumbnail.php", { videoId: videoId, thumbnailId: thumbnailId })
        .done(function() {
            var item = $(itemElement);
            var itemClass = item.attr("class");

            $("." + itemClass).removeClass("selected");

            item.addClass("selected");
            alert("Thumbnail updated");
        });
}


function deleted (videoId, button){


    $.post("ajax/delete.php", { videoId: videoId })
        .done(function(data) {
            if(data != null) {
                $(button).toggleClass("delete deleted");
                var buttonText = $(button).hasClass("delete") ? "DELETE" : "DELETED";
            }
            else {
                alert("Something went wrong");
            }

        });
}

