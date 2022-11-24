function debounce( callback, delay ) {
    let timeout;
    return function() {
        clearTimeout( timeout );
        timeout = setTimeout( callback, delay );
    }
}


function search(value) {
    //alert (javascriptVariable);
    if(!value){
      value = false;
    }
    $.ajax({
      type: "GET",
      url: "http://localhost/mvc/public/movie/search/"+value,
      dataType: 'json',
      data: value,
      success: function(response) {
        render(response);
      },
    });
  }

  function searchCache() {
    if(myInput.value) {
      const url = new URL(window.location.href);
      url.searchParams.set('q', myInput.value);
      window.history.replaceState(null, null, url); // or pushState
      search(myInput.value);
    } else {
      console.log("empty");
      history.replaceState({}, "Title", "movie");
      search(false);
    }
  }