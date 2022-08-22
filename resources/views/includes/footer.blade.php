    <script src="{{asset('temp/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('temp/js/popper.min.js')}}"></script>
    <script src="{{asset('temp/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('temp/js/all.min.js')}}"></script>
    <script>
      const imgInp = document.querySelector("#file");
      const List = document.querySelector(".first-carousel");
      const view_comments = document.querySelector(".view_comments");
      const comment_section = document.querySelector(".comment_section");
      const comment_count = document.querySelector(".view_comments").innerText.match(/\d/g).join("");
      //Comment Handler
    //   view_comments.onclick = evt =>
    //   {
    //     if(evt.target.innerText.includes('all'))
    //     {
    //         get_all_comments(comment_section.attribute('data-id'));
    //       comment_section.style.display = 'flex';
    //       evt.target.innerText = "View less comments...";
    //       return;
    //     }
    //     if(evt.target.innerText.includes('less'))
    //     {
    //       comment_section.style.display = 'none';
    //       evt.target.innerText = `View all ${comment_count} comments..`;
    //       return;
    //     }
       
    //   }



      //Modal Image Handler
      imgInp.onchange = evt => {
      List.innerHTML = "";
      let selected = evt.target.files;
         console.log(selected);
         let file = [...selected];
       
         
         for (let i = 0;i < file.length;i++)
         {
          console.log(file[i]);
          if(file[i]['type'].match("image/*"))
             {
              div = document.createElement("div");
              div.classList.add("carousel-item");
              if(i === 0)
              {
                div.classList.add("active");
              }
              div.innerHTML = `<img src="${URL.createObjectURL(file[i])}" class="col-12 w-100 m-auto"  alt="...">`;
             List.appendChild(div); 
         
             }
             if(file[i]['type'].match("video/*"))
                {
                  div = document.createElement("div");
                  div.classList.add("carousel-item");
                  if(i === 0)
                    {
                  div.classList.add("active");
                    }
                  div.innerHTML =`<video class="col-12 w-100 m-auto" controls> <source  src="${URL.createObjectURL(file[i])}" type="${file[i]['type']}" > </video>`;
              
                  List.appendChild(div)
                } 
         }
      }
    
     
    </script>
    <script>
        // function get_all_comments(post_id){
        //     $.ajax({
        //         url: "{{route('get_all_comments')}}",
        //         type: "POST",
        //         data: {
        //             post_id: post_id,
        //             _token: "{{csrf_token()}}"
        //         },
        //         success: function(data){
        //             console.log(data);
        //             // $('.comment_section').html(data);
        //         }
        //     });
        // }


        $('.comment_post').on('submit', function (e) {
          
          e.preventDefault();
          
          var form = $(this);
          var action = form.attr('action')
          var post_id = form.data('postid')
          console.log(form.serialize());
          $.ajax({
              url: "{{route('get_all_comments')}}",
              type: "POST",
              data: {
                  post_id: post_id,
                  _token: "{{csrf_token()}}"
              },
              success: function(data){
                  console.log(data);
                  // $('.comment_section').html(data);
              }
          });
          
        });

    
    </script>
  </body>
</html>
