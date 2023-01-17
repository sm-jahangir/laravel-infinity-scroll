<!DOCTYPE html>
<html>

<head>
  <title>Laravel infinite scroll pagination</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <style type="text/css">
    .ajax-load {
      background: #e1e1e1;
      padding: 10px 0px;
      width: 100%;
    }
  </style>
</head>

<body>


  <div class="container">
    <h2 class="text-center">Laravel infinite scroll pagination</h2>
    <br />
    <div class="col-md-12" id="post-data">
      @include('data')
    </div>
  </div>


  <div class="ajax-load text-center" style="display:none">
    
    <img src="{{ asset('loader.gif') }}" alt="Loader" width="50"><p>Loading More post</p>
  </div>


  <script type="text/javascript">
    var page = 1;
    var loading = false;
    $(window).scroll(function() {
      if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
      }
    });


    function loadMoreData(page) {
        loading = true;
        if(loading) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                beforeSend: function() {
                  $('.ajax-load').show();
                }
              })
              .done(function(data) {
      
                //   console.log(data)
                if (data.html == "") {
                  loading = false;
                  $('.ajax-load').html("No more records found");
                  return;
                } else {

                    $('.ajax-load').hide();
                    $("#post-data").append(data.html);
                    loading = false;
                }
              })
              .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
                loading = false;
              });
        }
    }
  </script>


</body>

</html>