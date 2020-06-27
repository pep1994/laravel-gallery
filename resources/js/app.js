require('./bootstrap');

$(document).ready(function () {
    $('ul').on('click', 'li a', function(e){
        e.preventDefault();
        var urlAlbum = $(this).attr('href');
        var parent = $(this).parents('li');
        
        $.ajax({
            type: "GET",
            url: urlAlbum,
            success: function (data) {
                console.log(data);
                if (data == 1)  {
                    parent.remove();
                }
            }
        });
    })
});
