    <script src="{{asset('temp/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('temp/js/popper.min.js')}}"></script>
    <script src="{{asset('temp/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('temp/js/all.min.js')}}"></script>
    <script>
      const imgInp = document.querySelector("#file");
      const List = document.querySelector(".first-carousel");
      const view_comments = document.querySelector(".view_comments");
      const comment_section = document.querySelector(".comment_section");
      
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

    const toggle = (event) =>{

        const value = event.getAttribute('for');
        const inputs = document.querySelectorAll('input');
        const action   = event.dataset.action;
        const postid   = event.dataset.postid;
        if(action == 'like'){
          like(postid);
        }else{
          save(postid);
        }
        for(let i=0; i<inputs.length; i++) {
       
          if(inputs[i].getAttribute('value') === value) 
          {
            if(inputs[i].checked)
            {
              inputs[i].checked = false;
            }
            else{
              inputs[i].checked = true;
            }
          }
    
        }
    }  




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

        function test(){
          console.log("works");
        }
        $('.comment_post').on('submit', function (e) {
          
          e.preventDefault();
          
          var form = $(this);
          var action = form.attr('action')
          var post_id = form.data('postid')
          var comment_section = $('#last_comment_section_'+post_id);
          var values  = form.serializeArray();
          $.ajax({
              url: "{{route('post.make_comment')}}",
              type: "POST",
              data: {
                  post_id: post_id,
                  comment: values[0]['value'],
                  _token: "{{csrf_token()}}"
              },
              success: function(data){
                data = $.parseJSON(data);
                
                status  = data.status;
                message = data.error;
                content = data.content;
                if(status == "success"){
                  form[0].reset();
                  comment_section.append(content);
                }else{

                }
              }
          });

        });

    function like(postid){
      $.ajax({
              url: "{{route('post.make_like')}}",
              type: "POST",
              data: {
                  post_id: postid,
                  _token: "{{csrf_token()}}"
              },
              success: function(data){
                data = $.parseJSON(data);
                status  = data.status;
                message = data.error;
              }
      });
      
    }

    function save(postid){
        $.ajax({
                url: "{{route('post.save_post')}}",
                type: "POST",
                data: {
                    post_id: postid,
                    _token: "{{csrf_token()}}"
                },
                success: function(data){
                  data = $.parseJSON(data);
                  status  = data.status;
                  message = data.error;
                }
        });
      
    }
    </script>
  </body>
</html>
