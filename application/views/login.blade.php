
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login SPKP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ base_url('assets/template/utama/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ base_url('assets/template/utama/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ base_url('assets/template/utama/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        Sistem Penilaian Kinerja Pegawai
      </div>
      <div class="card-body">
        
       <form method="post" id="form-login">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username"  id="username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ base_url('assets/template/utama/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ base_url('assets/template/utama/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ base_url('assets/template/utama/dist/js/adminlte.min.js') }}"></script>
<script src="{{ base_url('assets/plugins/axios.min.js') }}"></script>
<script src="{{ base_url('assets/plugins/sweetalert2.all.min.js') }}"></script>
<script>
  $(function() {

    $username = $("#username");
    $password = $("#password");

    $("#form-login").submit(function(e) {

      e.preventDefault();

      $(this).find(':submit').attr('disabled','disabled');


      let post_data = {
        username: $username.val(),
        password: $password.val(),
      };

      post_data = Object.keys(post_data).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(post_data[key])).join('&')

      axios.post("{{ base_url("auth/login") }}", post_data)
      .then((res) => {
        $(this).find(':submit').attr('disabled',false);


        response = res.data;

        if (response.success == 0) {
         Swal.fire({
          title: 'Gagal!',
          text: response.message,
          icon: 'error',
          timer: 1000,
          showConfirmButton: false,

        });
       } else if(response.success == 1) {

        window.location.href = "{{ base_url('') }}";
      }

    })
      .catch(() => {
        $(this).find(':submit').attr('disabled',false);


      })

    });

    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  });
</script>  
</body>
</html>
