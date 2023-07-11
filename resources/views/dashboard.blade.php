@extends('template')
@section('content')

<?php
   $nilai_variabel = $_COOKIE['username'];
?>

<section id="content" class="content">
  <div class="content__header content__boxed overlapping">
    <div class="content__wrap">
      <h1 class="page-title mb-2">Dashboard</h1>
      <h2 class="h5">Selamat Datang <?php echo $nilai_variabel; ?> Di halaman dashboard.</h2>
      <p>Scroll down to see quick links and overviews of your Server, To do list<br> Order status or get some Help using Nifty.</p>
    </div>
  </div>
  <div class="content__boxed">
    <div class="content__wrap">
      <div class="row">
        <div class="col-sm-6">
            <div class="card bg-success text-white overflow-hidden mb-3">
              <div class="p-3 pb-2">
                <h5 class="mb-3"><i class="demo-psi-data-storage text-reset text-opacity-75 fs-3 me-2"></i>Jumlah Cerita</h5>
                <ul class="list-group list-group-borderless">
                  <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                    <div class="me-auto"> </div>
                    <span class="fw-bold" style="font-size: 50px;" id="jumlah-cerita"></span>
                  </li>
                </ul>
              </div>
              <div class="py-0" style="height: 70px; margin: 0 -5px -5px;">
                <canvas id="_dm-hddChart"></canvas>
              </div>
            </div>
          </div>
          
        <div class="col-sm-6">
          <div class="card bg-info text-white overflow-hidden mb-3">
            <div class="p-3 pb-2">
              <h5 class="mb-3"><i class="demo-psi-coin text-reset text-opacity-75 fs-2 me-2"></i> Jumlah Pembaca</h5>
              <ul class="list-group list-group-borderless">
                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                  <div class="me-auto"></div>
                  <span class="fw-bold" style="font-size: 50px;" id="jumlah-likes"></span>
                </li>
              </ul>
            </div>
            <div class="py-0" style="height: 70px; margin: 0 -5px -5px;">
              <canvas id="_dm-earningChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content__boxed">
    <div class="content__wrap">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-3">List Cerita</h5>
          <div class="row">
            <div class="col-md-6 d-flex gap-1 align-items-center mb-3">
              <button class="btn btn-icon btn-outline-light" aria-label="Print table">
                <i class="demo-pli-printer fs-5"></i>
              </button>
              <div class="btn-group">
                <button class="btn btn-icon btn-outline-light" aria-label="Information"><i class="demo-pli-exclamation fs-5"></i></button>
                <button class="btn btn-icon btn-outline-light" aria-label="Remove"><i class="demo-pli-recycling fs-5"></i></button>
              </div>
            </div>
            <div class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end mb-3">
              <div class="form-group">
                <input type="text" placeholder="Search..." class="form-control" autocomplete="off">
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="cerita-table" class="table table-striped">
                <thead>
                    <tr>
                      <th>Id Cerita</th>
                      <th>Judul</th>
                      <th>Likes</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
              <tbody id="cerita-data">
                <!-- Data akan ditambahkan melalui JavaScript -->
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="dataTables_info" id="cerita-table_info" role="status" aria-live="polite"></div>
            </div>
            <div class="col-md-6">
              <div class="dataTables_paginate paging_simple_numbers" id="cerita-table_paginate">
                <ul class="pagination">
                  <!-- Pagination akan ditambahkan melalui JavaScript -->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
</section>

<script>
  // Fungsi untuk mendapatkan data cerita dari API
  function getCeritaData(page, uuid) {
            // Tampilkan loading screen
            var loadingScreen = $('<div class="loading-screen"></div>').appendTo('body');
            var loader = $('<div class="loader"></div>').appendTo(loadingScreen);
  $.ajax({
    url: 'http://localhost:1500/ceritabypenulis',
    type: 'POST',
    data: {
      penulis: uuid,
    },
      dataType: 'json',
      success: function(response) {
        console.log(response);
        // Memanggil fungsi untuk mengisi tabel dengan data cerita
        fillCeritaTable(response.response);
        setTimeout(function() {
                        loadingScreen.remove();
                       
                    }, 1000);
      },
      error: function(xhr, status, error) {
        console.error(error);
        loadingScreen.remove();
      }
    });
  }

  function fillCeritaTable(data) {
  var table = $('#cerita-table').DataTable();
  table.clear().draw();

  $.each(data, function(index, cerita) {
    var editButton = '<button onclick="redirectToEditPage(\'' + cerita.id_cerita + '\', \'' + cerita.judul + '\', \'' + cerita.deskripsi + '\')" class="btn btn-primary">Edit</button>';

    table.row.add([
      cerita.judul,
      cerita.deskripsi,
      '<div class="d-block badge bg-success">' + cerita.likes + '</div>',
      editButton
    ]).draw();
  });
}

function redirectToEditPage(id, judul, deskripsi) {
  var url = '/editceritaku?id=' + id;
  window.location.href = url;
}
  // Inisialisasi DataTables
  $(document).ready(function() {
    $('#cerita-table').DataTable({
      paging: true, // Mengaktifkan pagination default DataTables
      searching: false, // Menghilangkan fitur pencarian DataTables
      info: false, // Menghilangkan informasi jumlah data DataTables
      order: [] // Menghilangkan pengurutan awal tabel
    });

    // Memanggil fungsi untuk mendapatkan data cerita pada halaman pertama
    getCeritaData(1);
  });

  function getJumlahCeritaData(uuid) {
  $.ajax({
    url: 'http://localhost:1500/jumlahceritabypenulis',
    type: 'POST',
    data: {
        id_penulis: uuid,
    },
   
  
    success: function(response) {
  jumlahCerita = response.response[0].jumlah_cerita;
  jumlahLikes = response.response[0].jumlah_likes;
  $('#jumlah-cerita').text(jumlahCerita);
  $('#jumlah-likes').text(jumlahLikes);
},
    error: function(xhr, status, error) {
      console.error(uuid);
    }
  });
}




  $(document).ready(function() {
  var uuid = getCookie('uuid');

  // Memanggil fungsi untuk mendapatkan data cerita pada halaman pertama
  getCeritaData(1, uuid);
  getJumlahCeritaData(uuid);
});

function getCookie(name) {
  var cookieName = name + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var cookieArray = decodedCookie.split(';');

  for (var i = 0; i < cookieArray.length; i++) {
    var cookie = cookieArray[i];
    while (cookie.charAt(0) == ' ') {
      cookie = cookie.substring(1);
    }
    if (cookie.indexOf(cookieName) == 0) {
      return cookie.substring(cookieName.length, cookie.length);
    }
  }

  return "";
}
</script>

@endsection
