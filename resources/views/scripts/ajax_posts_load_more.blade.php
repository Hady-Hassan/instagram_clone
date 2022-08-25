<script>
   var SITEURL = "{{ Route(Route::current()->getName())   }}";
   var page = 1; //track user scroll as page number, right now page number is 1
  //  load_more(page); //initial content load
  console.log($(document).height())
   $(window).scroll(function() { //detect page scroll
      if((($(window).scrollTop() + $(window).height() ) + 30) >= $(document).height()) { //if user scrolled from top to bottom of the page
      page++; //page number increment
      load_more(page); //load content   
      }
    });     

    function load_more(page){
        $.ajax({
           url: SITEURL + "?page=" + page,
           type: "get",
           datatype: "html",
           beforeSend: function()
           {
              $('.ajax-loading').show();
            }
        })
        .done(function(data)
        {
            if(data.length == 0){
            console.log(data.length);
            //notify user if nothing to load
            $('.ajax-loading').html("No more posts!");
            return;
          }
          $('.ajax-loading').hide(); //hide loading animation once data is received
          $("#wrapper").append(data); //append data into #results element          
       })
       .fail(function(jqXHR, ajaxOptions, thrownError)
       {
          console.log('No response from server');
       });
    }
</script>