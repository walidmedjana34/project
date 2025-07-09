<!DOCTYPE html>
<html lang="fr">
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title')
        </title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <!-- Add your custom CSS file -->
        @stack('styles')
        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

           {{-- splidejs --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    </head>
    <!-- Chatbot Modal -->
@auth('agency')
    @if(auth('agency')->user()->is_premium)
        <!-- Chatbot Modal -->
        <div id="chatbot-modal" style="display:none; position: fixed; bottom: 20px; right: 20px; width: 350px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2); z-index: 1000;">
            <div style="background: #007bff; color: white; padding: 10px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                Chatbot Immobilier
                <span id="close-chatbot" style="float: right; cursor: pointer;">&times;</span>
            </div>
            <div id="chat-window" style="padding: 10px; height: 250px; overflow-y: auto;"></div>
            <div style="padding: 10px; display: flex; gap: 5px;">
                <input type="text" id="user-message" placeholder="Votre message..." style="flex: 1; padding: 6px;">
                <button id="send-btn" style="padding: 6px 10px; background: #007bff; color: white; border: none;">Envoyer</button>
            </div>
        </div>

        <!-- Bouton flottant -->
        <button id="open-chatbot" style="position: fixed; bottom: 20px; right: 20px; background: #007bff; color: white; border: none; border-radius: 50%; width: 50px; height: 50px; font-size: 24px; z-index: 999;">
            💬
        </button>
    @endif
@endauth


<body>

  <header>
    <h1>
        <a href="{{ route('home.Accueil') }}">
            <span>Imm</span>obiller
        </a>
    </h1>
    <nav>
        <ul class="nav-links">
            <li class="cta"><a href="{{ route('home.Accueil') }}" class="hover-underline-animation">Accueil</a></li>
            <li class="cta"><a href="{{ route('home.annonces') }}" class="hover-underline-animation">Annonces</a></li>
            
            <li class="cta"><a href="{{ route('vacances.index') }}" class="hover-underline-animation">Vacances</a></li>
           @auth('agency')
    <li class="cta"><a href="{{ route('service.services') }}" class="hover-underline-animation">services</a></li>
@endauth

           

        </ul>
    </nav>

    @php
    $user = Auth::guard('web')->user();
    $agency = Auth::guard('agency')->user();
    @endphp

<div class="links-cnx">
    @auth('admin')
    {{-- Admin connecté --}}
    <div class="ajt">
            <a href="{{ route('home.type-annonce') }}" class="button2 firstbien">Ajouter une Annonce</a>
            <a href="{{ route('home.type-annonce') }}" class="button2 lastbien"> + Annonce</a>
        </div>
    <div class="container-users">
        <div class="information-users">
            <i class='bx bxs-user-badge'></i>
            <p>{{ auth('admin')->user()->name }}</p>
        </div>
        <ul class="dropdownnn">
            <li><a href="{{ route('dashboard') }}">Profil Admin</a></li>
            <li>
                <a href="{{ route('logout') }}" style="color: red"
                   onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                    <i class='bx bx-log-out'></i> Déconnecter
                </a>
                <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
  @elseauth('web')
        {{-- User is logged in --}}
        <div class="ajt">
            <a href="{{ route('home.type-annonce') }}" class="button2 firstbien">Ajouter une Annonce</a>
            <a href="{{ route('home.type-annonce') }}" class="button2 lastbien"> + Annonce</a>
        </div>
        <div class="container-users">
            <div class="information-users">
                <i class='bx bx-user'></i>
                <p>{{ auth()->guard('web')->user()->name }}</p>
            </div>
            <ul class="dropdownnn">
                <li><a href="{{route('client.dashboard')}}">Dashboard</a></li>
                
                <li>
                    <a href="{{ route('logout') }}" style="color: red"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class='bx bx-log-out'></i> Déconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @elseauth('agency')
    <div class="premium-cta">
    @php
        $agency = auth()->guard('agency')->user();
    @endphp

    @if(!$agency->is_premium && !$agency->is_pro)
        <a href="{{ route('service.services') }}" class="button2 subscribe-btn">S'abonner</a>
    @else
        @if($agency->is_premium)
            <span class="button2 premium-active">Premium actif</span>
        @endif

        @if($agency->is_pro)
            <span class="button2 pro-active">Professionnel actif</span>
        @endif
    @endif
</div>
        {{-- Agency is logged in --}}
        <div class="ajt">
            <a href="{{ route('home.type-annonce') }}" class="button2 firstbien">Ajouter une Annonce</a>
            <a href="{{ route('home.type-annonce') }}" class="button2 lastbien"> + Annonce</a>
        </div>
        <div class="container-users">
            <div class="information-users">
                <i class='bx bx-buildings'></i>
                <p>{{ auth()->guard('agency')->user()->name }}</p>
            </div>
            <ul class="dropdownnn">
                <li><a href="{{ route('agence.dashboard', auth()->guard('agency')->user()->id) }}">Dashboard</a></li>
                
                <li>
                    <a href="{{ route('logout') }}" style="color: red"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class='bx bx-log-out'></i> Déconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @else
        {{-- Not authenticated --}}
        <a href="{{ route('home.connexion') }}" class="cnx">
            <i class="bi bi-box-arrow-in-right"></i> Connexion
        </a>
    @endauth
</div>

    <button class="hamburger" aria-label="Menu">
        <i class="bi bi-list"></i>
    </button>
</header>



    {{-- <div class="container">

      
    </div> --}}
    
    @yield('content')



    
    <footer>
        <section class="links-cards">
            <div class="company-name">
              <div class="head">
                  <h1>immobilier</h1>
              </div>
              <p>immobilier est un site spécialisé dans la publication de petites annonces immobilières en Algérie entre particuliers et professionnels</p>
            </div>
            <div class="links">
              <h2>les pages</h2>
               <ul>
                   <li><a href="">Accueil</a></li>
                   <li><a href="">Annonces</a></li>
                   <li><a href="">Agences</a></li>
                   <li><a href="">Vacances</a></li>
                   
               </ul>
             </div>
             <div class="links">
               <div class="head"><h2>Information</h2></div>
               <ul>
                   <li><a href="">Ajouter une annonce</a></li>
                   <li><a href="">Qui sommes-nous</a></li>
                   <li><a href="">Contactez-nous</a></li>
                   <li><a href="">Mon Compte</a></li>
               </ul>
             </div>
             <div class="links">
               <div class="head"><h2>Contact info</h2></div>
               <div class="logo-link">
                   <div class="email-div"><p><i class='bx bxs-map'></i>10 Rue lahcene Mimouni, Sidi Mhamed, Alger</p></div>
                   <div class="email-div"><p href=""><i class='bx bxs-envelope'></i> immo@gmail.com</p></div>
                   <div class="email-div"><p href=""><i class='bx bxs-phone'></i>+213 771016828</p></div>
                   <div class="email-div"><p href=""><i class='bx bxs-phone-call'></i>035 xx xx xx</p></div>
               </div>
             </div>
         </section>
         <div class="copyright">
           © 2025 Copyright:
           <a  href="">immobilier.com</a>
         </div>
       
    </footer>
    <button class="button" id="btn-up">
      <svg class="svgIcon" viewBox="0 0 384 512">
        <path
          d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
        ></path>
      </svg>
    </button>

  <script>
      document.querySelector(".hamburger").addEventListener("click", function () {
          document.querySelector(".nav-links").classList.toggle("active");
      });
      
      const information_user = document.querySelector('.information-users');
      const dropdownnn = document.querySelector('.dropdownnn');
      
      information_user.addEventListener("click", function () {
          dropdownnn.classList.toggle("active");
      });
      document.getElementById('open-chatbot').addEventListener('click', () => {
    document.getElementById('chatbot-modal').style.display = 'block';
});

document.getElementById('close-chatbot').addEventListener('click', () => {
    document.getElementById('chatbot-modal').style.display = 'none';
});

document.getElementById('send-btn').addEventListener('click', async () => {
    const input = document.getElementById('user-message');
    const chat = document.getElementById('chat-window');
    const message = input.value.trim();
    if (!message) return;

    chat.innerHTML += `<div><strong>👤 Vous:</strong> ${message}</div>`;
    input.value = '';
    chat.scrollTop = chat.scrollHeight;

    const response = await fetch("{{ route('agence.send') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message })
    });

    const data = await response.json();

    if (data.reply) {
        chat.innerHTML += `<div><strong>🤖 Bot:</strong> ${data.reply}</div>`;
    } else {
        chat.innerHTML += `<div style="color:red;"><strong>Erreur:</strong> Réponse indisponible.</div>`;
    }

    chat.scrollTop = chat.scrollHeight;
});
document.getElementById('open-chatbot').addEventListener('click', () => {
    document.getElementById('chatbot-modal').style.display = 'block';
});
document.getElementById('close-chatbot').addEventListener('click', () => {
    document.getElementById('chatbot-modal').style.display = 'none';
});

  </script>
  <script defer src="../assets/js/accueil/script.js"></script>

</body>
</html>