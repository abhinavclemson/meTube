function block(userTo, userFrom, button) {

    if(userTo == userFrom) {
        alert("You can't block to yourself");
        return;
    }

    $.post("ajax/block.php", { userTo: userTo, userFrom: userFrom })
        .done(function(count) {
            if(count != null) {
                $(button).toggleClass("block unblock");

                var buttonText = $(button).hasClass("block") ? "BLOCK" : "BLOCKED";
                $(button).text(buttonText + " " + count);
            }
            else {
                alert("Something went wrong");
            }

        });
}



function friend(userTo, userFrom, button) {

    if(userTo == userFrom) {
        alert("You can't friend to yourself");
        return;
    }

    $.post("ajax/friend.php", { userTo: userTo, userFrom: userFrom })
        .done(function(count) {
            if(count != null) {
                $(button).toggleClass("friend unfriend");

                var buttonText = $(button).hasClass("friend") ? "FRIEND" : "UNFRIEND";
                $(button).text(buttonText + " " + count);
            }
            else {
                alert("Something went wrong");
            }

        });
}


function family(userTo, userFrom, button) {

    if(userTo == userFrom) {
        alert("You can't add to family");
        return;
    }

    $.post("ajax/family.php", { userTo: userTo, userFrom: userFrom })
        .done(function(count) {
            if(count != null) {
                $(button).toggleClass("family unfamily");

                var buttonText = $(button).hasClass("family") ? "FAMILY" : "UNFAMILY";
                $(button).text(buttonText + " " + count);
            }
            else {
                alert("Something went wrong");
            }

        });
}


