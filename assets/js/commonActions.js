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