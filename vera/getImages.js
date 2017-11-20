var folder = "img/";

$.ajax({
    url : folder,
    success: function (data) {
        $(data).find("a").attr("href", function (i, val) {
            if( val.match(/\.(jpe?g|png)$/) ) { 
                $("body").append( "<img src='" + val +"'>" );
                
            } 
        });
    }
});