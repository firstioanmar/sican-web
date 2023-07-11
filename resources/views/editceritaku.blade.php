@extends('template')
@section('content')
<?php
   $nilai_variabel = $_COOKIE['username'];
?>

<section id="content" class="content">
    <div class="content__boxed">
        <div class="content__wrap">
            <section>
                <div class="row">
                  
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Block styled form</h5>
                                <form class="row g-3" id="uploadForm">

                                    <div class="col-md-12">
                                        <label for="judul_cerita" class="form-label">Judul Cerita</label>
                                        <input id="judul_cerita" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="deskripsi_cerita" class="form-label">Deskripsi Cerita</label>
                                        <textarea id="deskripsi_cerita" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gambar" class="form-label">Upload Gambar</label>
                                        <input id="gambar" type="file" class="form-control" accept="image/*">
                                        <div class="mt-3 border-dashed">
                                            <img id="previewImageGambar" class="img-fluid" src="#" alt="Preview" style="display: none; max-width: 200px; max-height: 200px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="video" class="form-label">Upload Video</label>
                                        <input id="video" type="file" class="form-control" accept="video/*">
                                        <div class="mt-3 border-dashed">
                                            <video id="previewVideo" class="img-fluid" src="#" alt="Preview" style="display: none; max-width: 200px; max-height: 200px;" controls></video>
                                        </div>
                                    </div>
                             
                                    <div class="row">
                                        <div class="col-1">
                                            <button type="button" id="uploadButton" class="btn btn-primary">Upload</button>
                                        </div>
                                        <div class="col-1">
                                            <button type="button" id="deleteButton" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                    
                                </form>
    
                            </div>
                        </div>
           
    
                </div>
            </section>
        </div>
    </div>
    @include('footer')
</section>
<script>
    document.getElementById('gambar').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('previewImageGambar');
            preview.src = reader.result;
            preview.style.display = "block";
        }
        reader.readAsDataURL(event.target.files[0]);
    });

    document.getElementById('video').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('previewVideo');
            preview.src = reader.result;
            preview.style.display = "block";
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

<script>
    $(document).ready(function() {
        var idCerita = getUrlParameter('id');
        $('#uploadButton').click(function() {
            var formData = new FormData();
            formData.append('id_cerita', idCerita);
            formData.append('judul', $('#judul_cerita').val());
            formData.append('cerita', $('#deskripsi_cerita').val());
            formData.append('file', $('#gambar')[0].files[0]);
            formData.append('video', $('#video')[0].files[0]);

            // Tampilkan loading screen
            var loadingScreen = $('<div class="loading-screen"></div>').appendTo('body');
            var loader = $('<div class="loader"></div>').appendTo(loadingScreen);

            $.ajax({
                url: 'http://localhost:1500/editcerita',
                type: 'PUT',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    // Lakukan aksi yang sesuai setelah upload berhasil

                    // Tampilkan pesan sukses
                    vt.success("Update berhasil", {
                        title: "Sukses",
                        position: "top-center",
                    });

                    setTimeout(function() {
                        
                      window.location.href = '/admin';
                  }, 4000);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    loadingScreen.remove();
                    // Tampilkan pesan error
                    vt.error("Upload gagal", {
                        title: "Error",
                        position: "top-center",
                    });
                },
                complete: function() {
                    setTimeout(function() {
                        loadingScreen.remove();
                        window.location.href = '/admin';
                    }, 3000);
                  
                }
            });
        });

        function getCookie(name) {
            var cookieArr = document.cookie.split(';');
            for (var i = 0; i < cookieArr.length; i++) {
                var cookiePair = cookieArr[i].split('=');
                if (name === cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }
    });
    $(document).ready(function() {
        var idCerita = getUrlParameter('id');
        $('#deleteButton').click(function() {

            // Tampilkan loading screen
            var loadingScreen = $('<div class="loading-screen"></div>').appendTo('body');
            var loader = $('<div class="loader"></div>').appendTo(loadingScreen);

            $.ajax({
                url: 'http://localhost:1500/deletecerita/' + idCerita,
        type: 'DELETE',
                type: 'DELETE',
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    // Lakukan aksi yang sesuai setelah upload berhasil

                    // Tampilkan pesan sukses
                    vt.success("Proses Menghapus berhasil", {
                        title: "Sukses",
                        position: "top-center",
                    });

                    setTimeout(function() {
                        
                      window.location.href = '/admin';
                  }, 4000);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    loadingScreen.remove();
                    // Tampilkan pesan error
                    vt.error("Proses Menghapus gagal", {
                        title: "Error",
                        position: "top-center",
                    });
                },
                complete: function() {
                    setTimeout(function() {
                        loadingScreen.remove();
                        window.location.href = '/admin';
                    }, 3000);
                  
                }
            });
        });

        function getCookie(name) {
            var cookieArr = document.cookie.split(';');
            for (var i = 0; i < cookieArr.length; i++) {
                var cookiePair = cookieArr[i].split('=');
                if (name === cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }
    });

    $(document).ready(function() {
  var idCerita = getUrlParameter('id');
  if (idCerita) {
    var formData = new FormData();
    formData.append('idcerita', idCerita);

    $.ajax({
      url: 'http://localhost:1500/getCeritaByID',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function(response) {
        if (response.metadata.code === 200) {
          var cerita = response.response[0];
          $('#judul_cerita').val(cerita.judul);
          $('#deskripsi_cerita').val(cerita.deskripsi);
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }

 
});
function getUrlParameter(name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
    var results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }
</script>

@endsection
