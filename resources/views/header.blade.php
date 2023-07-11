<?php
   $nilai_variabel = $_COOKIE['username'];
?>
<header class="header">
    <div class="header__inner">
    
    <div class="header__brand">
    <div class="brand-wrap">
    
    <a href="" class="brand-img stretched-link">
    <img src="assets/img/logonew.png" alt="Nifty Logo" class="Nifty logo" width="50" height="50">
    </a>
    
    <div class="brand-title">Sican</div>
    
    </div>
    </div>
    
    <div class="header__content">
    
    <div class="header__content-start">
    
    <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
    <i class="demo-psi-view-list"></i>
    </button>
    
    <div class="header-searchbox">
    
    <label for="header-search-input" class="header__btn d-md-none btn btn-icon rounded-pill shadow-none border-0 btn-sm" type="button">
    <i class="demo-psi-magnifi-glass"></i>
    </label>
    
    <form class="searchbox searchbox--auto-expand searchbox--hide-btn input-group">
    <input id="header-search-input" class="searchbox__input form-control bg-transparent" type="search" placeholder="Type for search . . ." aria-label="Search">
    <div class="searchbox__backdrop">
    <button class="searchbox__btn header__btn btn btn-icon rounded shadow-none border-0 btn-sm" type="button" id="button-addon2">
    <i class="demo-pli-magnifi-glass"></i>
    </button>
    </div>
    </form>
    </div>
    </div>
    
    
    <div class="header__content-end">
    
    
    

    
    <div class="dropdown">
    
    <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-label="User dropdown" aria-expanded="false">
    <i class="demo-psi-male"></i>
    </button>
    
    <div class="dropdown-menu dropdown-menu-end w-md-200px">
    
    <div class="d-flex align-items-center border-bottom px-3 py-2">
    <div class="flex-shrink-0">
    <img class="img-sm rounded-circle" src="assets/img/profile-photos/1.png" alt="Profile Picture" loading="lazy">
    </div>
    <div class="flex-grow-1 ms-3">
    <h5 class="mb-0"><?php echo $nilai_variabel; ?></h5>
    </div>
    </div>
    <div class="row">
        <div class="list-group list-group-borderless mb-3">
            <div class="list-group-item text-center border-bottom mb-3">
                <p class="h1 text-green">
                    <span class="bi bi-thermometer-half"></span>
                    <span id="suhu"></span>
                    <span class="bi bi-degree"></span>C
                  </p>
                
                  <div class="d-flex flex-column align-items-center">
                    <p class="h6 mb-0">
                      <i class="fas fa-cloud"></i>
                      CUACA
                    </p>
                    <p class="h6">
                      Bogor
                    </p>
                  </div>
                  
                </div>
         
                <a href="#" class="list-group-item list-group-item-action" id="logoutButton" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="demo-pli-unlock fs-5 me-2"></i> Logout
                </a>
        
            </div>
    </div>
    </div>
    </div>
    
    
    
    </div>
    </div>
    </div>
    <script>
     $(document).ready(function() {
  var apiKey = '8c339b053f1fd6d5ec69f7e82f135ca7';
  var latitude = -6.5944; // Koordinat latitude untuk Bogor
  var longitude = 106.7892; // Koordinat longitude untuk Bogor
  var url = 'https://api.openweathermap.org/data/2.5/weather?lat=' + latitude + '&lon=' + longitude + '&appid=' + apiKey;

  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      // Ambil data suhu dalam Celsius dari respons API
      var temperature = response.main.temp - 273.15;
      console.log(temperature);
      // Tampilkan suhu di elemen dengan kelas "display-1"
      $('#suhu').text(temperature.toFixed(0));
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
    </script>
    </header>