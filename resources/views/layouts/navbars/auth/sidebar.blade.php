
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header ">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
        <span class="ms-3 font-weight-bold">Admin Panel  </span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <title>shop </title>
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                  <g transform="translate(1716.000000, 291.000000)">
                    <g transform="translate(0.000000, 148.000000)">
                      <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                      <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                    </g>
                  </g>
                </g>
              </g>
            </svg>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item" >
        
        <a class="nav-link {{ (Request::is('home.Accueil') ? 'active' : '') }} " href="{{ route('home.Accueil') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>home</title>
                <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Rounded-Icons" transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                        <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                            <g id="home" transform="translate(1.000000, 0.000000)">
                                <path class="color-background" d="M12,2 L2,12 L4,12 L4,21 C4,21.552 4.448,22 5,22 L9,22 L9,15 L15,15 L15,22 L19,22 C19.552,22 20,21.552 20,21 L20,12 L22,12 L12,2 Z" id="Path" opacity="0.59858631"></path>
                                <path class="color-foreground" d="M12,5.69 L17,10.19 L17,19 L15,19 L15,12 L9,12 L9,19 L7,19 L7,10.19 L12,5.69 Z" id="Path"></path>
                            </g>
                        </g>
                    </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Accueil</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Laravel Examples</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('user-profile') ? 'active' : '') }} " href="{{ url('user-profile') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>customer-support</title>
                    <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded-Icons" transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                <g id="customer-support" transform="translate(1.000000, 0.000000)">
                                    <path class="color-background" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z" id="Path" opacity="0.59858631"></path>
                                    <path class="color-foreground" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z" id="Path"></path>
                                    <path class="color-foreground" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z" id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <span class="nav-link-text ms-1">User Profile</span>
        </a>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('user-management') ? 'active' : '') }}" href="{{ url('user-management') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="42px" height="42px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>user-management</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g fill="#FFFFFF" fill-rule="nonzero">
                    <!-- User Circle -->
                    <circle class="color-background opacity-6" cx="21" cy="12" r="8"></circle>
                    <!-- Body -->
                    <path class="color-background" d="M21,24 C14,24 8,29 8,36 L34,36 C34,29 28,24 21,24 Z"></path>
                    <!-- Settings Gear Icon -->
                    <path class="color-background" d="M36,16 L39,16 L39,19 L36,19 L36,22 L33,22 L33,19 L30,19 L30,16 L33,16 L33,13 L36,13 L36,16 Z"></path>
                  </g>
                </g>
              </svg>                   
            </div>
            <span class="nav-link-text ms-1">User Management</span>
        </a>
      </li> 
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('Agency-Management') ? 'active' : '') }}" href="{{ url('Agency-Management') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>office</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g id="office" transform="translate(153.000000, 2.000000)">
                        <path class="color-background opacity-6" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                        <path class="color-background" d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Agency Management</span>
        </a>
      </li>
      
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('agency-request-management') ? 'active' : '') }}" href="{{ url('agency-request-management') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>building</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g fill="#FFFFFF" fill-rule="nonzero">
                    <path class="color-background opacity-6" d="M12,17 L8,17 L8,2 C8,1 9,0 10,0 L32,0 C33,0 34,1 34,2 L34,12 L30,12 L30,4 L12,4 L12,17 Z"></path>
                    <path class="color-background" d="M40,14 L24,14 C23,14 22,15 22,16 L22,38 L18,38 L18,22 C18,21 17,20 16,20 L2,20 C1,20 0,21 0,22 L0,40 C0,41 1,42 2,42 L40,42 C41,42 42,41 42,40 L42,16 C42,15 41,14 40,14 Z M12,36 L7,36 L7,33 L12,33 L12,36 Z M12,30 L7,30 L7,27 L12,27 L12,30 Z M35,36 L30,36 L30,33 L35,33 L35,36 Z M35,30 L30,30 L30,27 L35,27 L35,30 Z M35,22 L30,22 L30,19 L35,19 L35,22 Z"></path>
                  </g>
                </g>
              </svg>
              

            </div>
            <span class="nav-link-text ms-1">Agency Request Management</span>
        </a>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('anoncy-request-management') ? 'active' : '') }}" href="{{ url('anoncy-request-management') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>building</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g fill="#FFFFFF" fill-rule="nonzero">
                    <path class="color-background opacity-6" d="M12,17 L8,17 L8,2 C8,1 9,0 10,0 L32,0 C33,0 34,1 34,2 L34,12 L30,12 L30,4 L12,4 L12,17 Z"></path>
                    <path class="color-background" d="M40,14 L24,14 C23,14 22,15 22,16 L22,38 L18,38 L18,22 C18,21 17,20 16,20 L2,20 C1,20 0,21 0,22 L0,40 C0,41 1,42 2,42 L40,42 C41,42 42,41 42,40 L42,16 C42,15 41,14 40,14 Z M12,36 L7,36 L7,33 L12,33 L12,36 Z M12,30 L7,30 L7,27 L12,27 L12,30 Z M35,36 L30,36 L30,33 L35,33 L35,36 Z M35,30 L30,30 L30,27 L35,27 L35,30 Z M35,22 L30,22 L30,19 L35,19 L35,22 Z"></path>
                  </g>
                </g>
              </svg>
              

            </div>
            <span class="nav-link-text ms-1">Anoncy Request Management</span>
        </a>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('vaconcy-request-management') ? 'active' : '') }}" href="{{ url('vaconcy-request-management') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>building</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g fill="#FFFFFF" fill-rule="nonzero">
                    <path class="color-background opacity-6" d="M12,17 L8,17 L8,2 C8,1 9,0 10,0 L32,0 C33,0 34,1 34,2 L34,12 L30,12 L30,4 L12,4 L12,17 Z"></path>
                    <path class="color-background" d="M40,14 L24,14 C23,14 22,15 22,16 L22,38 L18,38 L18,22 C18,21 17,20 16,20 L2,20 C1,20 0,21 0,22 L0,40 C0,41 1,42 2,42 L40,42 C41,42 42,41 42,40 L42,16 C42,15 41,14 40,14 Z M12,36 L7,36 L7,33 L12,33 L12,36 Z M12,30 L7,30 L7,27 L12,27 L12,30 Z M35,36 L30,36 L30,33 L35,33 L35,36 Z M35,30 L30,30 L30,27 L35,27 L35,30 Z M35,22 L30,22 L30,19 L35,19 L35,22 Z"></path>
                  </g>
                </g>
              </svg>
              

            </div>
            <span class="nav-link-text ms-1">Vaconcy Request Management</span>
        </a>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('message-management') ? 'active' : '') }}" href="{{ url('message-management') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>building</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g fill="#FFFFFF" fill-rule="nonzero">
                    <path class="color-background opacity-6" d="M12,17 L8,17 L8,2 C8,1 9,0 10,0 L32,0 C33,0 34,1 34,2 L34,12 L30,12 L30,4 L12,4 L12,17 Z"></path>
                    <path class="color-background" d="M40,14 L24,14 C23,14 22,15 22,16 L22,38 L18,38 L18,22 C18,21 17,20 16,20 L2,20 C1,20 0,21 0,22 L0,40 C0,41 1,42 2,42 L40,42 C41,42 42,41 42,40 L42,16 C42,15 41,14 40,14 Z M12,36 L7,36 L7,33 L12,33 L12,36 Z M12,30 L7,30 L7,27 L12,27 L12,30 Z M35,36 L30,36 L30,33 L35,33 L35,36 Z M35,30 L30,30 L30,27 L35,27 L35,30 Z M35,22 L30,22 L30,19 L35,19 L35,22 Z"></path>
                  </g>
                </g>
              </svg>
              

            </div>
            <span class="nav-link-text ms-1">message  Management</span>
        </a>
      </li>
      
      
    </ul>
  </div>
  {{-- <div class="sidenav-footer mx-3 ">
    <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
      <div class="full-background" style="background-image: url('../assets/img/curved-images/white-curved.jpeg')"></div>
      <div class="card-body text-start p-3 w-100">
        <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
          <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true" id="sidenavCardIcon"></i>
        </div>
        <div class="docs-info">
          <h6 class="text-white up mb-0">Need help?</h6>
          <p class="text-xs font-weight-bold">Please check our docs</p>
          <a href="/documentation/getting-started/overview.html" target="_blank" class="btn btn-white btn-sm w-100 mb-0">Documentation</a>
        </div>
      </div>
    </div>
  </div> --}}
</aside>
