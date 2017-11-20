var postModule = (function() {
    var init = function() {
        var labels = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
        $(".slider")
            .slider({
                max: 25,
                change: function(event, ui) {
                    showPosts(labels[ui.value]);
                }
            })
            .slider("pips", {
                rest: "label",
                labels:labels
            });
    }

    var showPosts = function(letter) {
        var texts = $("#texts");
        $.get("php/textload.php", {
            letter: letter,
        }).done(function(data) {
            // Display the returned data in browser
            texts.html(data);
        });
    }

    return {
        init: init
    };
}());

$(document).ready(function() {
    postModule.init();
});
