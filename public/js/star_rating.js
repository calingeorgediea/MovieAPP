$( document ).ready(function() {

    var rating = $('.ratings').attr('data-rating');
    var star = '.star'
    var selected = '.selected'
    if(rating>5){
        rating=5;
    }
        $('.ratings').children().slice(-rating).each(function(){
            $(this).addClass('selected');
            console.log(this);
    })
});
function changeRating(newRating) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.has('id')){
        var id = urlParams.get('id');
    }
    console.log(id)
    $.ajax({
        type: "PATCH",
        // Pass data to PHP using URL and then retrieve using $_get[param]
        url: "http://localhost/mvc/public/movies/update_rating?movieid=" + id,
        dataType: 'text',
        data: JSON.stringify(newRating.toString(),id),
        success: function (data) {
        }
    });
}

$(function (){
    var star = '.star',
        selected = '.selected';
    $(star).on('click', function(){
      var newRating = $(this).attr('rating');
      changeRating(newRating);
      $(selected).each(function(){
        $(this).removeClass('selected');
      });
      $(this).addClass('selected');
    });
  });