
    <nav id="mainnav-container" class="mainnav">
    <div class="mainnav__inner">
    
    <div class="mainnav__top-content scrollable-content pb-5">
    
    <div class="mainnav__profile mt-3 d-flex3">
    <div class="mt-2 d-mn-max"></div>
    
    <div class="mininav-toggle text-center py-2">
    <img class="mainnav__avatar img-md rounded-circle border" src="assets/img/profile-photos/1.png" alt="Profile Picture">
    </div>
    <div class="mininav-content collapse d-mn-max">
    <div class="d-grid">
    
    <button class="d-block btn shadow-none p-2" >
        <a style="font-size: 20px;"><strong><?php echo $nilai_variabel; ?></strong></a>


     <br>
             
     <small class="text-muted">Writer</small>
    </span>
  
    </button>
    
    
    </div>
    </div>
    </div>
    
    
    <div class="mainnav__categoriy py-3">
    <h6 class="mainnav__caption mt-0 px-3 fw-bold">Navigasi</h6>
    <ul class="mainnav__menu nav flex-column">
        <li class="nav-item">
            <a href="{{ '/admin' }}" class="nav-link mininav-toggle"><i class="demo-pli-split-vertical-2 fs-5 me-2"></i>
            <span class="nav-label mininav-content ms-1">Dashboard</span>
            </a>
    
    
    
    <li class="nav-item">
    <a href="{{ '/edit' }}" class="nav-link mininav-toggle"><i class="demo-pli-gear fs-5 me-2"></i>
    <span class="nav-label mininav-content ms-1">Profile</span>
    </a>
    </li>
    <li class="nav-item">
        <a href="{{ '/ceritaku' }}" class="nav-link mininav-toggle"><i class="demo-pli-bar-chart fs-5 me-2"></i>
        <span class="nav-label mininav-content ms-1">Ceritaku</span>
        </a>
        </li>
    </ul>
    </div>

  