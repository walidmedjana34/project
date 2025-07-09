<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>   @yield('title')   </title>
  <link rel="stylesheet" href="{{ asset('assets/css/Dashboard-agence.css') }}">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <aside>
    <div class="profile">
      <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="James Wilson">
      <div class="profile-info">
        <strong>{{ auth()->guard('agency')->user()->name }}</strong>
        <span>{{ auth()->guard('agency')->user()->manager_name }}</span>
      </div>
    </div>
    <nav>
      <a href="{{ route('agence.dashboard') }}"><i class='bx bxs-dashboard'></i> Dashboard</a>
    </nav>

    <nav>
      <a href="{{ route('agence.properties') }}"><i class='bx bxs-building'></i>Properties </a>
    </nav>
    <nav>
      <a href="{{ route('agence.vacances') }}"><i class='bx bxs-building'></i>Vacances </a>
    </nav>
    <nav>
      <a href="{{ route('agence.request') }}"><i class='bx bx-git-pull-request' ></i> Request Anonces </a>
    </nav>
    <nav>
      <a href="{{ route('agence.vacancess') }}"><i class='bx bx-git-pull-request' ></i> Request Vacances </a>
    </nav>

    <nav>
      <a href="{{ route('agence.visites') }}"><i class='bx bxs-calendar'></i> Visits</a>
</nav>
<nav>
  <a href="{{ route('agence.messages') }}"><i class='bx bxs-message'></i> Messages</a>
</nav>

<nav>
  <a href="{{ route('agence.settings') }}"><i class='bx bxs-cog'></i> Settings</a>
    </nav>
    <a href="{{route('home.type-annonce')}}" class="add-btn"><i class='bx bx-plus'></i> Add New Property</a>
  </aside>
  

  <main>
   @yield('content')
  </main>

   <!-- Scripts -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   @stack('scripts') <!-- For page-specific scripts -->
   
   <!-- Include your messages script only on messages page -->
   @if(request()->routeIs('agence.messages'))
     <script src="{{ asset('assets/js/messages.js') }}"></script>
   @endif
   
   <!-- Other scripts -->
   <script src="{{ asset('assets/js/accueil/agence-dashboard.js') }}"></script>
  
</body>
</html>