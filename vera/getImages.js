var folder = "images/eski/fullres/";

$.ajax({
    url : folder,
    success: function (data) {
        $(data).find("a").attr("href", function (i, val) {
            if( val.match(/\.(jpe?g|png)$/) ) { 
                var final = val.substr(val.lastIndexOf('\\') + 1);
                var imageHtml = '<a href="images/eski/fullres/' + final + '" data-fancybox="images"><img src="images/eski/320x320/' + final + '" alt="" style="max-width:100%" /></a>'
                $("#resimler").append(imageHtml)
            }
        });
    }
});