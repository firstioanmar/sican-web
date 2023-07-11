<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themeon.net/nifty/v3.0.1/front-pages/login/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 May 2023 11:32:56 GMT -->
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
<meta name="description" content="The login page allows a user to gain access to an application by entering their username and password or by authenticating using a social media login.">
<title>Login | Sican</title>



<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;family=Ubuntu:wght@400;500;700&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<link rel="stylesheet" href="../../assets/css/bootstrap.min.75a07e3a3100a6fed983b15ad1b297c127a8c2335854b0efc3363731475cbed6.css">

<link rel="stylesheet" href="../../assets/css/nifty.min.4d1ebee0c2ac4ed3c2df72b5178fb60181cfff43375388fee0f4af67ecf44050.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<style>.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<body>


<div id="root" class="root front-container">


<section id="content" class="content">
<div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
<div class="content__wrap">

<div class="card shadow-lg">
<div class="card-body">
<div class="text-center">
<h1 class="h3">Silahkan Daftar</h1>
<p>Kelola Ceritamu Mari Mewarnai Dunia</p>
</div>
<form class="mt-4" id="registerform">
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Username" id="username" autofocus>
    </div>
    <div class="mb-3">
        <input type="password" class="form-control" id="password" placeholder="Password">
    </div>
    <div class="mb-3">
        <textarea class="form-control" id="alamat" placeholder="Alamat" rows="4" cols="50"></textarea>
    </div>
    <div class="d-grid mt-5">
        <button class="btn btn-primary btn-lg" type="submit">Sign In</button>  <br>
      
    </div>
</form>


<div class="d-flex justify-content-between mt-4">
</div>
<div class="d-flex align-items-center justify-content-between border-top pt-3 mt-3">

</div>
</div>
</div>




</div>
</div>
</section>


</div>







<script>
    $(document).ready(function() {
      $('#registerform').submit(function(event) {
          event.preventDefault();
  
          var formData = {
            nama: $('#username').val(),
              password: $('#password').val(),
              alamat: $('#alamat').val(),
              role: '1'
          };
  
          var requestData = $.param(formData); // Mengubah objek menjadi form-urlencoded
  
          // Tampilkan loading screen
          var loadingScreen = $('<div class="loading-screen"></div>').appendTo('body');
          var loader = $('<div class="loader"></div>').appendTo(loadingScreen);
  
          $.ajax({
              url: 'http://localhost:1500/registrasi',
              type: 'POST',
              data: requestData,
              contentType: 'application/x-www-form-urlencoded',
              success: function(response) {
                  console.log(response);
  
                  // Hilangkan tombol login
                  setTimeout(function() {
                      $('#registerform button').hide();
                  }, 400);
  
                  // Tampilkan pesan toast berhasil dengan nama
                  Toastify({
                      text: "Pendaftaran Berhasil ",
                      backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                      className: "success",
                      position: "center",
                  }).showToast();
  
                  // Redirect ke halaman admin setelah 3 detik
                  setTimeout(function() {
                      window.location.href = '/login';
                  }, 4000);
              },
              error: function(xhr, status, error) {
                  console.log(xhr.responseText);
  
                  if (xhr.status === 400) {
                      Toastify({
                          text: "Permintaan Tidak Valid: status 400 bad request",
                          backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                          className: "error",
                          position: "center",
                      }).showToast();
                  } else if (xhr.status === 409) {
                      Toastify({
                          text: "Konflik: Userna telah digunakan",
                          backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                          className: "error",
                          position: "center",
                      }).showToast();
                  } else {
                    console.log(response);
                      Toastify({
                          text: "Terjadi Kesalahan: " + xhr.responseText,
                          backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                          className: "error",
                          position: "center",
                      }).showToast();
                  }
  
                  // Sembunyikan loading screen jika terjadi kesalahan
                  loadingScreen.remove();
              },
              complete: function() {
                   // Redirect ke halaman admin setelah 3 detik
                   setTimeout(function() {
                    loadingScreen.remove();
                  }, 3000);
              }
          });
      });
  });
</script>


<script src="toast/lib/vanilla-toast.min.js"></script>

<script src="../../assets/js/bootstrap.min.bdf649e4bf3fa0261445f7c2ed3517c3f300c9bb44cb991c504bdc130a6ead19.js" defer></script>

<script src="../../assets/js/nifty.min.b53472f123acc27ffd0c586e4ca3dc5d83c0670a3a5e120f766f88a92240f57b.js" defer></script>
</body>

