$(document).ready(function() {

    $(".navShowHide").on("click", function() {

        var main = $("#mainSectionContainer");
        var nav = $("#sideNavContainer");

        if(main.hasClass("leftPadding")) {
            nav.hide();
        }
        else {
            nav.show();
        }

        main.toggleClass("leftPadding");

    });

});

function notSignedIn(){
    alert("In order to like/Dislike, you have to be signed in!")
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

function playlistVideoDelete(videoId, username, playlistName, button){


    $.post("ajax/deletePlaylistVideo.php", { videoId: videoId , username:username, playlistName:playlistName})
        .done(function(data) {
            if(data != null) {
                $(button).toggleClass("delete deleted");
                var buttonText = $(button).hasClass("delete") ? "DELETE" : "DELETED";
                alert(data);
            }
            else {
                alert("Something went wrong");
            }

        });
}

function playlistDelete(username, playlistName, button){


    $.post("ajax/deletePlaylist.php", {  username:username, playlistName:playlistName})
        .done(function(data) {
            if(data != null) {
                $(button).toggleClass("delete deleted");
                var buttonText = $(button).hasClass("delete") ? "DELETE" : "DELETED";
                alert(data);
            }
            else {
                alert("Something went wrong");
            }

        });
}

