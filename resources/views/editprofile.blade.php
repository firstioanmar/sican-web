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
                            <h5 class="card-title">Edit Profil</h5>
                            <form class="row g-3" id="editProfileForm">
                                <div class="col-md-12">
                                    <label for="username" class="form-label">Username</label>
                                    <input id="username" type="text" class="form-control" value="<?php echo $nilai_variabel; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label for="oldPassword" class="form-label">Password Lama</label>
                                    <input id="oldPassword" type="password" class="form-control">
                                </div>
                                <div class="row" style="margin-top: 24px">
                                    <div class="col-md-6">
                                        <label for="passworda" class="form-label">Password Baru</label>
                                        <input id="passworda" type="password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="passwordb" class="form-label">Ulangi Password Baru</label>
                                        <input id="passwordb" type="password" class="form-control">
                                    </div>
                                </div>
                               
                               
                                <div class="row" style="margin-top: 24px">
                                    <div class="col-1">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    $(document).ready(function() {
        $('#editProfileForm').submit(function(event) {
            event.preventDefault();

            var passwordA = $('#passworda').val();
            var passwordB = $('#passwordb').val();

            if (passwordA !== passwordB) {
                vt.error("Password baru tidak sama", {
                    title: "Gagal",
                    position: "top-center",
                });
            } else if (passwordA === '' || passwordB === '') {
                vt.error("Password harus diisi", {
                    title: "Gagal",
                    position: "top-center",
                });
            } else if (passwordA.length < 5) {
                vt.error("Password harus lebih dari 5 digit", {
                    title: "Gagal",
                    position: "top-center",
                });
            } else {
                var cookies = document.cookie.split(';'); // Membagi string cookie menjadi array
                var nilai_variabel = '';
var uuidx = '';

for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();

    if (cookie.startsWith('username=')) {
        nilai_variabel = cookie.substring('username='.length);
    } else if (cookie.startsWith('uuid=')) {
        uuidx = cookie.substring('uuid='.length);
    }

    // Hentikan perulangan jika kedua cookie telah ditemukan
    if (nilai_variabel !== '' && uuidx !== '') {
        break;
    }
}


                var formData = {
                    username: nilai_variabel,
        
                    password: $('#oldPassword').val()
                };

                var requestData = $.param(formData); // Mengubah objek menjadi form-urlencoded

                // Tampilkan loading screen
                var loadingScreen = $('<div class="loading-screen"></div>').appendTo('body');
                var loader = $('<div class="loader"></div>').appendTo(loadingScreen);

                $.ajax({
                    url: 'http://localhost:1500/login',
                    type: 'POST',
                    data: requestData,
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(response) {

                        var formData2 = {
                    nama:  $('#username').val(),
                    uuid: uuidx,
                    password: $('#passworda').val()
                };

                var requestData2 = $.param(formData2);
                        console.log(response);
                        $.ajax({
                    url: 'http://localhost:1500/updateusers',
                    type: 'POST',
                    data: requestData2,
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(response) {
                        console.log(response);

                        vt.success("Profil berhasil diperbarui", {
                            title: "Berhasil",
                            position: "top-center",
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);

      //oke
    var response = JSON.parse(xhr.responseText).response;

vt.error(response, {
    title: "Gagal",
    position: "top-center",
});


                    },
                    complete: function() {
                        loadingScreen.remove();
                    }
                });
                    
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);

                        if (xhr.status === 401) {
                            vt.error("Password lama tidak valid", {
                                title: "Gagal",
                                position: "top-center",
                            });
                        } else {
                            vt.error("Terjadi kesalahan saat mengedit profil", {
                                title: "Gagal",
                                position: "top-center",
                            });
                        }
                    },
                    complete: function() {
                        loadingScreen.remove();
                    }
                });
            }
        });
    });
</script>


@endsection
