<script src="{{asset('temp/js/jquery-3.6.0.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
<script src="{{asset('temp/js/popper.min.js')}}"></script>
<script src="{{asset('temp/js/bootstrap.min.js')}}"></script>
<script src="{{asset('temp/js/all.min.js')}}"></script>

<script>
  const imgInp = document.querySelector("#file");
  const List = document.querySelector(".first-carousel");
  const view_comments = document.querySelector(".view_comments");
  const comment_section = document.querySelector(".comment_section");


  const toggle = (event) => {

    const value = event.getAttribute('for');
    const inputs = document.querySelectorAll('input');
    const action = event.dataset.action;
    const postid = event.dataset.postid;
    const commentid = event.dataset.commentid;
    if (action == 'like') {
      like(postid);
    } 
    else if (action == 'like_comment')
    {
      likeComment(postid,commentid);
    }
    else {
      save(postid);
    }
    for (let i = 0; i < inputs.length; i++) {

      if (inputs[i].getAttribute('value') === value) {
        if (inputs[i].checked) {
          inputs[i].checked = false;
        } else {
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

    if(file.length === 1) {
      document.querySelector('.carousel-control-prev').style.display= "none";
      document.querySelector('.carousel-control-next').style.display= "none";
    }
    else{
      document.querySelector('.carousel-control-prev').style.display= "block";
      document.querySelector('.carousel-control-next').style.display= "block";
    }
    for (let i = 0; i < file.length; i++) {
      // console.log(file[i]);
      if (file[i]['type'].match("image/*")) {
        div = document.createElement("div");
        div.classList.add("carousel-item");
        if (i === 0) {
          div.classList.add("active");
        }
        div.innerHTML = `<img src="${URL.createObjectURL(file[i])}" class="col-12 w-100 m-auto"  alt="...">`;
        List.appendChild(div);

      }
      if (file[i]['type'].match("video/*")) {
        div = document.createElement("div");
        div.classList.add("carousel-item");
        if (i === 0) {
          div.classList.add("active");
        }
        div.innerHTML = `<video class="col-12 w-100 m-auto" controls> <source  src="${URL.createObjectURL(file[i])}" type="${file[i]['type']}" > </video>`;

        List.appendChild(div)
      }
    }
  }
</script>
<script>

  function test() {
    console.log("works");
  }
  $('.comment_post').on('submit', function(e) {

    e.preventDefault();

    var form = $(this);
    var action = form.attr('action')
    var post_id = form.data('postid')
    var comment_section = $('#last_comment_section_' + post_id);
    var values = form.serializeArray();
    $.ajax({
      url: "{{route('post.make_comment')}}",
      type: "POST",
      data: {
        post_id: post_id,
        {{ Route::is('home') ? "type:true," : " " }}
        comment: values[0]['value'],
        _token: "{{csrf_token()}}"
      },
      success: function(data) {
        status = data['status'];
        if (status != "failed") {
          form[0].reset();
          comment_section.append(data);
          comment_section.animate({ scrollTop:comment_section.prop("scrollHeight")},"slow");
          }
        
      }
    });

  });

  function like(postid) {
    $.ajax({
      url: "{{route('post.make_like')}}",
      type: "POST",
      data: {
        post_id: postid,
        _token: "{{csrf_token()}}"
      },
      success: function(data) {
        data = $.parseJSON(data);
        status = data.status;
        message = data.error;
      }
    });

  }
  function likeComment(postid,commentid) {
    $.ajax({
      url: "{{route('post.make_like_comment')}}",
      type: "POST",
      data: {
        post_id: postid,
        comment_id: commentid,
        _token: "{{csrf_token()}}"
      },
      success: function(data) {
        data = $.parseJSON(data);
        status = data.status;
        message = data.error;
      }
    });

  }



  function save(postid) {
    $.ajax({
      url: "{{route('post.save_post')}}",
      type: "POST",
      data: {
        post_id: postid,
        _token: "{{csrf_token()}}"
      },
      success: function(data) {
        data = $.parseJSON(data);
        status = data.status;
        message = data.error;
      }
    });

  }

  function removefollow(userid) {
    $.ajax({
      url: "{{route('users.removefollow')}}",
      type: "POST",
      data: {
        userid: userid,
        _token: "{{csrf_token()}}"
      },
      success: function(data) {
        data = $.parseJSON(data);
        status = data.status;
        message = data.error;
        if (status == 'success') {
          location.reload();
        }
      }
    });

  }

  function unfollow(userid) {
    $.ajax({
      url: "{{route('users.unfollow')}}",
      type: "POST",
      data: {
        userid: userid,
        _token: "{{csrf_token()}}"
      },
      success: function(data) {
        data = $.parseJSON(data);
        status = data.status;
        message = data.error;

        if (status == 'success') {
          location.reload();
        }
      }
    });

  }

  function unblock(userid) {
    $.ajax({
      url: "{{route('users.unblock')}}",
      type: "POST",
      data: {
        userid: userid,
        _token: "{{csrf_token()}}"
      },
      success: function(data) {
        data = $.parseJSON(data);
        status = data.status;
        message = data.error;

        if (status == 'success') {
          location.reload();
        }
      }
    });

  }
  
</script>
<script>
  // search
  var searchBox = $('#boxSearch');
  searchBox.on('keyup', function(e) {
    let keyword = searchBox.val();
    if (keyword.length >= 3) {
      $.ajax({
        url: "{{route('users.search')}}",
        type: "POST",
        data: {
          keyword: keyword,
          _token: "{{csrf_token()}}"
        },
        success: function(data) {
          status = data['status'];
          $('#dropdown-search').children().remove();
          if (status != "failed") {
            $('#dropdown-search').append(data);
          } else {
            $('#dropdown-search').append('<center class="text-muted">Nothing found</center>');
          }
          $('#dropdown-search').show();
        }
      });
    }
  });
  searchBox.on('focusout', function(e) {
    if (searchBox.val() == "") {
      $('#dropdown-search').hide();
    }
  });
</script>
@yield('more_js')

</body>

</html>