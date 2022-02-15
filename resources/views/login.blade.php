<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>2021 LOGIN - Admin - Merchant Share</title>
  <link rel="icon" href="{{ asset('public/assets/img/brand/favicon.png')}}" type="image/png">
  <link rel="stylesheet" href="{{ asset('public/assets/css/argon.min5438.css?v=1.0') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('public/assets/vendor/nucleo/css/nucleo.css?v=1.0') }}" type="text/css">

</head>

<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-success py-7 py-lg-8 pt-lg-9">

      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><strong>Login here</strong></div>
              
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small id="l_status">Sign in With Credentials</small>
              </div>
              <form id="loginForm"  name="loginForm" autocomplete="false">
                
              <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" required placeholder="Email" type="text" name="email" id="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" required minlength="3" placeholder="Password" type="password" name="password" id="pass" autocomplete="false">
                  </div>
                </div>
                
                <div class="text-center">
                  <input type="submit" id="btn_login" class="btn btn-primary my-4" value="Sign in">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- javascript libs -->
  <link rel="stylesheet" href="{{ asset('public/assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" type="text/css">
  <script src="{{ asset('public/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script>
    
  $(document).on('submit',function(e){
    
      e.preventDefault();
     
      $.ajax({
        type: 'POST',
        url: './api/login',
        headers: {
          "Authorization": "bearer token"
        },
        dataType: 'json',
        data: $("#loginForm").serialize(),
        beforeSend:function(data){
          $("#l_status").text("Logging inprogress....")
          $("#btn_login").prop('disabled', true);
        },
        success: function(data) {
          
          var userData = {};
          
          //window.localStorage.setItem('user_email', data.data.email);
          window.localStorage.setItem('token', data.data.token);
          window.localStorage.setItem('ps', data.data.ps);
          
          userData['token'] = data.data.token;
          userData['email'] = data.data.email;
          userData['ps'] = data.data.ps;
          window.localStorage.setItem('user', JSON.stringify(userData));
          
          if(data.success == true) {
            
            $.when(getLoginData(data.data.email)).then(function(data) {

              $("#l_status").text("Logging success....")
              $("#l_status").css("color","green");

              window.location.href = "./dashboard";

              $("#btn_login").prop('disabled', false);

          });
          }
        },
        error: function(xhr) {
          $("#l_status").text("Logging failed.");
          $("#l_status").css("color","red");
          $("#btn_login").prop('disabled', false);
        }
      });

  })


</script>
<script src="{{ asset('public/assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script>
    
    function getLoginData(email) {
        
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/getData') }}",
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            //data: '',
            data: 'email=' + email,
            async: false,
            success: function (data) {
                //console.log(data.status);
                
                
                var oldItems = JSON.parse(localStorage.getItem('user')) || {};
                //oldItems['id'] = data.data.id;
                //oldItems['parent_id'] = data.data.parent_id;
                oldItems['u_name'] = data.data.email;
                oldItems['u_role'] = data.data.u_role;
                //oldItems['u_status'] = data.data.u_status;
                //oldItems.push(data.data.u_role);

                localStorage.setItem('user', JSON.stringify(oldItems));
                
                return 'ok';
                
            },
            error: function (xhr) {
                console.log(xhr.readyState);
                //console.log('error');
                if (xhr.readyState == 4) {
                    swal({
                        title: xhr.responseJSON.message,
                        text: "Please Login Again...",
                        type: "success",
                        confirmButtonText: "Login",
                        confirmButtonClass: "btn btn-default"
                    });
                    $('.swal2-confirm').click(function () {
                        window.location.href = "{{ url('/login') }}";
                    });
                    // window.location.href = "{{ url('/login') }}";
                }
                return 'error';
            },
            complete: function (data) {
//                console.log(data.status);
//              return true;  
            }
        });
    }
    
    function getBalance(id) {
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/getBalance') }}",
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            //data: '',
            data: 'id=' + id,
            cache: false,
            success: function (data) {
                //console.log(data.data);

                //window.localStorage.setItem('bal', data.data.amount);
            },
            error: function (xhr) {
                //console.log(xhr.responseText);
                //console.log('error');
            }
        });
    }
</script>
</body>
</html>