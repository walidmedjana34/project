@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title')Créer une annonce  @endsection
@section("content")

<div class="form-container">
    <h1 class="form-title">Créer une annonce - Vacances</h1>
  
    <form action="{{ route('vacances.store') }}" method="POST" class="form" enctype="multipart/form-data">
     
      @csrf
      @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
      <fieldset>
        @unless(auth('agency')->check())
        <div>
            <label for="agency_id">Agence :</label>
            <div class="select-wrapper">
                <select id="agency_id" name="agency_id" required class="form-input">
                    <option value="">Sélectionnez une agence</option>
                    @foreach(App\Models\Agency::where('status', 'approved')->get() as $agency)
                        <option value="{{ $agency->id }}" 
                            @if(auth()->check() && auth()->user()->agency_id == $agency->id) 
                                selected 
                            @endif>
                            {{ $agency->name }} - {{ $agency->wilaya }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @else
        <!-- Hidden input with the agency's ID when authenticated as agency -->
        <input type="hidden" name="agency_id" value="{{ auth('agency')->user()->id }}">
    @endunless
      <div class="form-row">
        <div class="form-group">
          <label for="titre">Titre de l'annonce</label>
          <input type="text" id="titre" name="titre" class="form-input" required placeholder="Ex : Charmant appartement à la mer">
        </div>
        <div class="form-group">
          <label for="type">Type</label>
          <select id="type" name="type" class="form-input" required>
            <option value="">-- Choisissez un type --</option>
            <option value="appartement">Appartement</option>
            <option value="maison">Maison</option>
            <option value="villa">Villa</option>
            <option value="chalet">Chalet</option>
          </select>
        </div>
      </div>
  
 

<div class="form-group">
    <label for="description">Description du bien :</label>
    <textarea id="description" name="description" rows="5" placeholder="Décrivez le bien en détail..." required></textarea>
</div>
</fieldset>

      <div class="form-group">
        <label for="localisation">Localisation</label>
        <input type="text" id="localisation" name="localisation" class="form-input" required placeholder="Ex : Rue 550 logh">
      </div>
  
      <div class="form-row">
        <div class="form-group">
             <label for="wilaya">Wilaya :</label>
<select id="wilaya" name="wilaya" onchange="updateCommunes()" required>
    <option value="">Sélectionnez une wilaya</option>
    @foreach(config('wilayas') as $code => $name)
        <option value="{{ $code }}">{{ $code }} - {{ $name }}</option>
    @endforeach
</select>

        </div>
        
      </div>
      <div >
        <label for="commune ">Commune :</label>
        <select id="commune" name="commune">
          <option value="">Sélectionnez une commune</option>
          <!-- Communes will be populated dynamically -->
      </select>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="prix_nuit">Prix / nuit</label>
          <input type="number" id="prix_nuit" name="prix_nuit" class="form-input" placeholder="Ex : 12000 DA">
        </div>
        <div class="form-group">
          <label for="chambres">Chambres</label>
          <input type="number" id="chambres" name="chambres" class="form-input" placeholder="Ex : 3">
        </div>
      </div>
  
      <div class="form-row">
        <div class="form-group">
          <label for="salles_bain">Salles de bain</label>
          <input type="number" id="salles_bain" name="salles_bain" class="form-input" placeholder="Ex : 2">
        </div>
        <div class="form-group">
          <label for="capacite">Capacité</label>
          <select id="capacite" name="capacite" class="form-input" title="Choisir la capacité">
              <option value="1-2">1-2</option>
              <option value="3-4">3-4</option>
              <option value="+5">+5</option>
          </select>
      </div>
      
        
      </div>
  
      <div class="form-group">
        <label for="superficie">Superficie (m²)</label>
        <input type="number" id="superficie" name="superficie" class="form-input" placeholder="Ex : 85">
      </div>
  
      <div class="form-group">
        <label for="type_annonce">Type d'annonce</label>
        <select id="type_annonce" name="type_annonce" class="form-input">
          <option value="">-- Choisissez un type --</option>
          <option value="location">Location</option>
          <option value="vente">Vente</option>
        </select>
      </div>
  
      <div class="form-group">
        <label>Commodités</label>
        <div class="form-options">
          <label><input type="checkbox" name="wifi" value="1" {{ old('wifi') ? 'checked' : '' }}> Wifi</label>
          <label><input type="checkbox" name="parking" value="1" {{ old('parking') ? 'checked' : '' }}> Parking</label>
          <label><input type="checkbox" name="piscine" value="1" {{ old('piscine') ? 'checked' : '' }}> Piscine</label>
          <label><input type="checkbox" name="cuisine" value="1" {{ old('cuisine') ? 'checked' : '' }}> Cuisine</label>
          <label><input type="checkbox" name="television" value="1" {{ old('television') ? 'checked' : '' }}> Télévision</label>
          <label><input type="checkbox" name="climatisation" value="1" {{ old('climatisation') ? 'checked' : '' }}> Climatisation</label>
          <label><input type="checkbox" name="eau" value="1" {{ old('eau') ? 'checked' : '' }}> Eau</label>
          
        </div>
      </div>
  
      <div class="form-row">
        <div class="form-group">
          <label for="disponible_de">Disponible à partir de</label>
          <input type="date" id="disponible_de" name="disponible_de" class="form-input">
        </div>
        <div class="form-group">
          <label for="disponible_jusqua">Disponible jusqu'à</label>
          <input type="date" id="disponible_jusqua" name="disponible_jusqua" class="form-input">
        </div>
      </div>
  
      <div class="form-group">
        <label for="statut">Statut</label>
        <select id="statut" name="statut" class="form-input">
          <option value="">-- Sélectionnez un statut --</option>
          <option value="disponible">Disponible</option>
          <option value="reserve">Réservé</option>
          <option value="loue">Loué</option>
        </select>
      </div>

      <!-- Section 5 : Photos du bien -->
   <fieldset>
    <legend>Photos du bien</legend>
    <div>
        <label for="main_image">Image principale :</label>
        
        <input type="file" name="main_image[]" id="main_image" accept="image/jpeg,image/png,image/jpg" multiple>
    </div>
</fieldset>
  
      <button type="submit" class="button2">Publier l'annonce</button>
    </form>
  </div>
  <!-- Modal de confirmation -->
<div id="confirmationModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
  <div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 30px; border-radius: 10px; width: 50%; box-shadow: 0 5px 15px rgba(0,0,0,0.3); text-align: center;">
      <span class="close" style="float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
      <h2 style="color: #af4c75;">Votre demande sera traitée</h2>
      <p>Vous recevrez un message lorsque votre demande sera approuvée.</p>
      <div class="progress-bar" style="height: 5px; background: #ddd; margin-top: 20px;">
          <div class="progress" style="height: 100%; background: #4CAF50; width: 100%;"></div>
      </div>
  </div>
</div>
  <script>
    // This object contains all wilayas with their communes
    const wilayasCommunes = {
        /* 01 */ "1": ["Adrar", "Tamest", "Reggane", "In Zghmir", "Tit", "Ksar Kaddour", "Zaouiet Kounta", "Aoulef", "Timokten", "Tamentit", "Fenoughil", "Tinerkouk", "Deldoul", "Sali", "Akabli", "Metarfa", "Ouled Ahmed Timmi", "Bouda", "Aougrout", "Talmine", "Ouled Said", "Timiaouine"],
        /* 02 */ "2": ["Chlef", "Ténès", "Benairia", "El Karimia", "Tadjna", "Taougrite", "Beni Haoua", "Sobha", "Harchoun", "Ouled Fares", "Zeboudja", "Oued Goussine", "Dahra", "Oued Sly", "Bouzghaia", "Beni Rached", "El Marsa", "Chettia", "Sidi Abderrahmane", "Moussadek", "Labiod Medjadja", "Oued Fodda", "Ouled Ben Abdelkader", "Boukadir", "Beni Bouateb", "Talassa", "Herenfa", "Oggaz"],
        /* 03 */ "3": ["Laghouat", "Ksar El Hirane", "Benacer Ben Chohra", "Hassi Delaa", "Hassi R'Mel", "Tadjmout", "Kheneg", "Gueltat Sidi Saad", "Ain Madhi", "Tadjrouna", "El Ghicha", "Hadj Mechri", "Sebgag", "Taouiala", "El Assafia", "Brida", "Sidi Makhlouf", "Hassi M'Hamed", "Ain Sidi Ali", "El Beidha", "Oued Morra", "Oued M'Zi", "El Haouaita", "Touggourt", "Sidi Slimane"],
        /* 04 */ "4-el-bouaghi": ["Oum El Bouaghi", "Ain Beida", "Ain Babouche", "Berriche", "Ouled Hamla", "Dhalaa", "Ain Kercha", "Hanchir Toumghani", "Sigus", "El Amiria", "Ain Diss", "Fkirina", "Ouled Zouai", "Souk Naamane", "Meskiana", "Ain Zitoun", "El Belala", "Ouled Gacem", "Bir Chouhada", "Ksar Sbahi", "Ouled Maallah", "El Harmilia", "Ain M'Lila", "El Djazia", "El Fedjoudj"],
        /* 05 */ "5": ["Batna", "Merouana", "Seriana", "Menaa", "El Madher", "Tazoult", "N'Gaous", "Guigba", "Inoughissen", "Ouyoun El Assafir", "Djerma", "Ichmoul", "Fesdis", "Lazrou", "Bouzina", "Chemora", "Ouled Selam", "Timgad", "Ras El Aioun", "Chir", "Ouled Ammar", "El Hassi", "Boumagueur", "Barika", "Djezzar", "T'Kout", "Ain Touta", "Arris", "Kais", "Ouled Aouf"],
        /* 06 */ "6": ["Béjaïa", "Amizour", "Feraoun", "Tala Hamza", "Barbacha", "Boudjellil", "El Kseur", "Seddouk", "Tichy", "Aokas", "Darguina", "Sidi Aich", "Chemini", "Souk El Tenine", "Tibane", "Tala Yfassene", "Akbou", "Souamaa", "Timezrit", "M'Cisna", "Ighil Ali", "Adekar", "Akfadou", "Tifra", "Beni Djellil", "Semaoun", "Kendira", "Tizi N'Berber", "Ait Smail", "Bouhamza"],
        /* 07 */ "7": ["Biskra", "Sidi Okba", "Ouled Djellal", "Tolga", "Djemorah", "El Outaya", "M'Lili", "Foughala", "Branis", "Chetma", "Oumache", "El Haouch", "Ain Naga", "Zeribet El Oued", "El Kantara", "Ain Zaatout", "El Feidh", "Khanguet Sidinadji", "Ourlal", "M'Chouneche", "Bouchagroune", "Mekhadma", "El Ghrous", "Lioua"],
        /* 08 */ "8": ["Béchar", "Ouled Khoudir", "Meridja", "Taghit", "Beni Ounif", "Mogheul", "Abadla", "Boukais", "Erg Ferradj", "Beni Abbes", "Timoudi", "Kerzaz", "Ouled Sidi Brahim", "Tabelbala", "Beni Ikhlef", "El Ouata", "Igli", "Tabalbala", "Boukais", "Mechraa Houari Boumediene"],
        /* 09 */ "9": ["Blida", "Chebli", "Bouinan", "Oued El Alleug", "Ouled Yaich", "Chiffa", "Mouzaia", "Bouarfa", "Beni Tamou", "Boufarik", "Guerrouaou", "Ain Romana", "Djebabra", "Meftah", "Souhane", "Soumaa", "Beni Mered", "Bougara", "Ouled Slama", "Larbaa", "El Affroun", "Chrea", "Ben Choud", "Beni Sala", "Oued Djer", "Beni Misra", "Bouinan", "Ouled Sellam", "Souagui", "Hammedi", "Ain Taya"],
        /* 10 */ "10": ["Bouira", "El Asnam", "Souk El Khemis", "Ain Bessem", "Bechloul", "Bir Ghbalou", "M'Chedallah", "El Hachimia", "Haizer", "Lakhdaria", "Maala", "Sour El Ghozlane", "Taghzout", "Z'barbar", "Ahl El Ksar", "Ain El Hadjar", "Bordj Okhriss", "Dechmia", "Djebahia", "El Adjiba", "El Khabouzia", "Ouled Rached", "Raouraoua", "Saharidj"],
        /* 11 */ "11": ["Tamanrasset", "Abalessa", "In Ghar", "In Guezzam", "Tin Zaouatine", "Tazrouk", "Idles", "Tinerkouk", "In Amguel", "Ain Salah"],
        /* 12 */ "12": ["Tébessa", "Bir El Ater", "Cheria", "Stah Guentis", "El Kouif", "Morsott", "Negrine", "Bir Mokadem", "Boulhaf Dir", "El Aouinet", "El Ogla", "Guorriguer", "Bekkaria", "Boukhadra", "Ouenza", "El Ma Labiodh", "Saf Saf El Ouesra", "Hammamet", "El Meridj", "El Mezeraa"],
        /* 13 */ "13": ["Tlemcen", "Beni Snous", "Hennaya", "Maghnia", "Remchi", "Sebdou", "Beni Boussaid", "Ghazaouet", "Souahlia", "Msirda Fouaga", "Ain Fezza", "Ouled Mimoun", "Amieur", "Sabra", "Beni Semiel", "Bab El Assa", "Dar Yaghmouracen", "Fellaoucene", "El Gor", "Chetouane", "Mansourah", "Beni Mester", "Sidi Djillali", "Bensekrane", "Ain Tallout"],
        /* 14 */ "14": ["Tiaret", "Aïn Deheb", "Aïn Kermes", "Dahmouni", "Frenda", "Hamadia", "Ksar Chellala", "Mahdia", "Mechraa Safa", "Medroussa", "Meghila", "Nadorah", "Naima", "Oued Lilli", "Rahouia", "Rechaiga", "Sebaine", "Sebt", "Serghine", "Si Abdelghani", "Sidi Ali Mellal", "Sidi Hosni", "Sougueur", "Tagdemt", "Takhemaret", "Tousnina", "Zmalet El Emir Abdelkader"],
        /* 15 */ "15": ["Tizi Ouzou", "Aïn El Hammam", "Akbil", "Azeffoun", "Beni Douala", "Beni Yenni", "Boghni", "Boudjima", "Draâ Ben Khedda", "Draâ El Mizan", "Freha", "Frikat", "Iboudraren", "Idjeur", "Iferhounène", "Ifigha", "Iflissen", "Illilten", "Illoula Oumalou", "Imsouhal", "Irdjen", "Larbaâ Nath Irathen", "Mâatkas", "Makouda", "Mekla", "Mizrana", "Ouacif", "Ouadhia", "Ouaguenoun", "Sidi Namane", "Souamaâ", "Tadmaït", "Tigzirt", "Timizart", "Tirmitine", "Tizi Gheniff", "Tizi N'Tleta", "Tizi Rached", "Yakouren", "Zekri"],
        /* 16 */ "16": ["Alger-Centre", "Sidi M'Hamed", "El Madania", "El Biar", "Oued Koriche", "Bouzareah", "Birkhadem", "El Harrach", "Baraki", "Oued Smar", "Bourouba", "Hussein Dey", "Kouba", "Bachedjerah", "Dar El Beida", "Bab Ezzouar", "Bordj El Kiffan", "El Magharia", "Ben Aknoun", "Dely Ibrahim", "El Hammamet", "Rais Hamidou", "Djasr Kasentina", "El Mouradia", "Hydra", "Mohammadia", "Bordj El Bahri", "El Marsa", "Hamma Annassers", "Bab El Oued", "Casbah", "Oued Kniss", "Bologhine", "Ain Benian", "Ouled Chebel", "Tessala El Merdja", "Zeralda", "Mahelma", "Rahmania", "Souidania", "Staoueli", "Ouled Fayet", "Chéraga", "Draria", "Douera", "Birtouta", "Les Eucalyptus", "Saoula"],
        /* 17 */ "17": ["Djelfa", "Aïn El Ibel", "Aïn Oussera", "Birine", "Charef", "Dar Chioukh", "El Guedid", "El Idrissia", "Faidh El Botma", "Guernini", "Hassi Bahbah", "Messaad", "Sed Rahal", "Selmana", "Sidi Baizid", "Sidi Ladjel", "Tadmit", "Zaafrane", "Zaccar", "Amourah", "Benhar", "Bouira Lahdab", "Douis", "El Khemis", "Had Sahary", "Moudjebara", "Oum Laadham"],
        /* 18 */ "18": ["Jijel", "El Ancer", "Sidi Maarouf", "Taher", "Chekfa", "Emir Abdelkader", "El Aouana", "Ziama Mansouriah", "Texenna", "Djemaa Beni Habibi", "Bordj Taher", "Oudjana", "Settara", "El Kennar Nouchfi", "Ghebala", "Boussif Ouled Askeur", "Selma Benziada", "Kaous", "Erraguene", "Chahna", "El Milia", "Sidi Abdelaziz", "Ouled Yahia Khadrouch", "Bouraoui Belhadef", "Djemaa Ouled Cheikh"],
        /* 19 */ "19": ["Sétif", "Aïn Arnat", "Aïn Azel", "Aïn El Kébira", "Aïn Oulmane", "Amoucha", "Babor", "Bazer Sakhra", "Beidha Bordj", "Belaa", "Beni Aziz", "Beni Chebana", "Beni Fouda", "Beni Hocine", "Beni Ourtilane", "Bir El Arch", "Bouandas", "Bougaa", "Bousselam", "Dehamcha", "El Eulma", "El Ouldja", "Guellal", "Guelta Zerka", "Hammam Guergour", "Hammam Sokhna", "Maoklane", "Mezloug", "Ouled Addouane", "Ouled Sabor", "Ouled Si Ahmed", "Ouled Tebben", "Rasfa", "Salah Bey", "Serdj El Ghoul", "Tachouda", "Talaifacene", "Taya", "Tella"],
        /* 20 */ "20": ["Saïda", "Aïn El Hadjar", "Aïn Sekhouna", "Doui Thabet", "El Hassasna", "Hounet", "Maamora", "Ouled Brahim", "Ouled Khaled", "Sidi Amar", "Sidi Boubekeur", "Tircine", "Youb", "Zahana"],
        /* 21 */ "21": ["Skikda", "Aïn Bouziane", "Aïn Charchar", "Aïn Kechra", "Aïn Zouit", "Azzaba", "Ben Azzouz", "Beni Bechir", "Beni Oulbane", "Beni Zid", "Bouchtata", "Cheraia", "Collo", "Djendel Saadi Mohamed", "El Ghedir", "El Hadaiek", "El Marsa", "Emdjez Edchich", "Essebt", "Filfila", "Hamadi Krouma", "Kanoua", "Kerkera", "Kheneg Mayoum", "Oued Zehour", "Ouldja Boulballout", "Ouled Attia", "Ouled Hebaba", "Oum Toub", "Ramdane Djamel", "Salah Bouchaour", "Sidi Mezghiche", "Tamalous", "Zitouna"],
        /* 22 */ "22": ["Sidi Bel Abbès", "Aïn Adden", "Aïn El Berd", "Aïn Thrid", "Aïn Tindamine", "Amarnas", "Badredine El Mokrani", "Belarbi", "Ben Badis", "Benachiba Chelia", "Bir El Hammam", "Boudjebaa El Bordj", "Boukhanafis", "Chetouane Belaila", "Dhaya", "El Hacaiba", "Hassi Dahou", "Hassi Zehana", "Lamtar", "Makedra", "Marhoum", "Mcid El Kebir", "Merine", "Mezaourou", "Mostefa Ben Brahim", "Moulay Slissen", "Oued Sebaa", "Oued Sefioun", "Oued Taourira", "Ras El Ma", "Redjem Demouche", "Sehala Thaoura", "Sfisef", "Sidi Ali Benyoub", "Sidi Ali Boussidi", "Sidi Brahim", "Sidi Chaib", "Sidi Dahou Dehors", "Sidi Hamadouche", "Sidi Khaled", "Sidi Lahcene", "Sidi Yacoub", "Tabia", "Tafissour", "Taoudmout", "Teghalimet", "Telagh", "Teneira", "Tessala", "Tilmouni", "Zerouala"],
        /* 23 */ "23": ["Annaba", "Aïn Berda", "Berrahal", "Chetaibi", "El Bouni", "El Hadjar", "Eulma", "Oued El Aneb", "Seraidi", "Sidi Amar", "Treat"],
        /* 24 */ "24": ["Guelma", "Aïn Ben Beida", "Aïn Hessania", "Aïn Larbi", "Aïn Makhlouf", "Aïn Reggada", "Aïn Sandel", "Belkheir", "Ben Djarah", "Beni Mezline", "Bordj Sabat", "Bou Hachana", "Bou Hamdane", "Bouati Mahmoud", "Bouchegouf", "Boumahra Ahmed", "Dahouara", "Djeballah Khemissi", "El Fedjoudj", "Ferdjioua", "Guelaat Bou Sbaa", "Hammam Debagh", "Hammam Maskhoutine", "Hammam N'Bails", "Heliopolis", "Khezara", "Medjez Amar", "Medjez Sfa", "Nechmaya", "Oued Cheham", "Oued Fragha", "Oued Zenati", "Ras El Agba", "Roknia", "Salaoua Announa", "Tamlouka"],
        /* 25 */ "25": ["Constantine", "Aïn Abid", "Aïn Smara", "Ben Badis", "Didouche Mourad", "El Khroub", "Hamma Bouziane", "Ibn Ziad", "Messaoud Boudjeriou", "Ouled Rahmoune", "Zighoud Youcef"],
        /* 26 */ "26": ["Médéa", "Aïn Boucif", "Aïn Ouksir", "Aissaouia", "Aziz", "Baata", "Benchicao", "Beni Slimane", "Berrouaghia", "Boghar", "Bouaichoune", "Bouaiche", "Bouskene", "Chahbounia", "Chellalet El Adhaoura", "Cheniguel", "Derrag", "Djouab", "Draa Essamar", "El Azizia", "El Omaria", "El Guelbelkebir", "Hannacha", "Kef Lakhdar", "Khams Djouamaa", "Ksar El Boukhari", "Meftaha", "Mezerana", "Mihoub", "Ouamri", "Oued Harbil", "Ouled Antar", "Ouled Bouachra", "Ouled Deide", "Ouled Hellal", "Ouled Maaref", "Rebaia", "Saneg", "Sedraia", "Seghouane", "Si Mahdjoub", "Sidi Damed", "Sidi Errabia", "Sidi Naamane", "Sidi Zahar", "Sidi Ziane", "Souagui", "Tablat", "Tafraout", "Tamesguida", "Tizi Mahdi", "Zoubiria"],
        /* 27 */ "27": ["Mostaganem", "Abdelmalek Ramdane", "Achaacha", "Aïn Boudinar", "Aïn Nouissy", "Aïn Sidi Cherif", "Aïn Tedeles", "Benabdelmalek Ramdane", "Bouguirat", "El Hassiane", "Fornaka", "Hadjadj", "Hassi Mameche", "Khadra", "Kheir Eddine", "Mansourah", "Mesra", "Nekmaria", "Oued El Kheir", "Ouled Boughalem", "Ouled Maallah", "Safsaf", "Sayada", "Sidi Ali", "Sidi Bellater", "Sidi Lakhdar", "Sirat", "Souaflia", "Sour", "Stidia", "Tazgait", "Touahria"],
        /* 28 */ "28": ["M'Sila", "Aïn El Hadjel", "Aïn El Melh", "Aïn Fares", "Aïn Khadra", "Belaiba", "Ben Srour", "Berhoum", "Bir Foda", "Bou Saada", "Bouti Sayah", "Chellal", "Dehahna", "Djebel Messaad", "El Hamel", "El Houamed", "Hammam Dhalaa", "Khoubana", "Maadid", "Magra", "Medjedel", "Menaa", "Mohamed Boudiaf", "Ouanougha", "Ouled Addi Guebala", "Ouled Atia", "Ouled Derradj", "Ouled Madhi", "Ouled Mansour", "Ouled Sidi Brahim", "Ouled Slimane", "Oultene", "Sidi Aissa", "Sidi Ameur", "Sidi Hadjeres", "Sidi M'Hamed", "Souamaa", "Tamsa", "Tarmount", "Zarzour"],
        /* 29 */ "29": ["Mascara", "Aïn Farès", "Aïn Fekan", "Aïn Ferah", "Aïn Fras", "Alaimia", "Aouf", "Beniane", "Bou Hanifia", "El Bordj", "El Gaada", "El Ghomri", "Ghriss", "Guittena", "Hachem", "Khalouia", "Makdha", "Maoussa", "Mohammadia", "Nesmoth", "Oggaz", "Oued El Abtal", "Oued Taria", "Ras El Aïn Amirouche", "Sedjerara", "Sehaïl", "Sidi Abdelmoumene", "Sidi Boussaid", "Sidi Kada", "Sig", "Tighennif", "Tizi", "Zahana", "Zelameta"],
        /* 30 */ "30": ["Ouargla", "Aïn Beida", "Balidat Ameur", "El Allia", "El Borma", "El Hadjira", "El Khoubna", "Hassi Ben Abdellah", "Hassi Messaoud", "N'Goussa", "Rouissat", "Sidi Khouiled", "Taibet", "Tebesbest", "Touggourt"],
        /* 31 */ "31": ["Oran", "Aïn El Turk", "Arzew", "Bethioua", "Bir El Djir", "Boufatis", "Bousfer", "Boutlelis", "Es Senia", "Gdyel", "Hassi Bounif", "Hassi Mefsoukh", "Mers El Kebir", "Misserghin", "Oued Tlelat", "Sidi Benyebka", "Sidi Chami", "Tafraoui"],
        /* 32 */ "32": ["El Bayadh", "Arbaouat", "Boualem", "Bougtoub", "Boussemghoun", "Brezina", "Cheguig", "Chellala", "El Abiodh Sidi Cheikh", "El Bnoud", "Ghassoul", "Kef El Ahmar", "Rogassa", "Sidi Ameur", "Sidi Slimane", "Sidi Tifour", "Stitten", "Tousmouline"],
        /* 33 */ "33": ["Illizi", "Bordj Omar Driss", "Debdeb", "In Amenas"],
        /* 34 */ "34": ["Bordj Bou Arreridj", "Aïn Taghrout", "Belimour", "Ben Daoud", "Bir Kasdali", "Bordj Ghdir", "Bordj Zemoura", "Colla", "Djaafra", "El Ach", "El Achir", "El Anseur", "El Hamadia", "El M'hir", "Ghilassa", "Haraza", "Hasnaoua", "Khelil", "Ksour", "Mansoura", "Medjana", "Ouled Brahem", "Ouled Dahmane", "Ouled Sidi Brahim", "Rabta", "Ras El Oued", "Sidi Embarek", "Tafreg", "Taglait", "Teniet En Nasr", "Tixter"],
        /* 35 */ "35": ["Boumerdès", "Baghlia", "Bordj Menaïel", "Boudouaou", "Boudouaou El Bahri", "Bouzegza Keddara", "Chabet El Ameur", "Corso", "Dellys", "Djinet", "El Kharrouba", "Hammedi", "Isser", "Khemis El Khechna", "Larbatache", "Legata", "Naciria", "Ouled Aissa", "Ouled Hedadj", "Ouled Moussa", "Si Mustapha", "Sidi Daoud", "Thenia", "Timezrit", "Zemmouri"],
        /* 36 */ "36": ["El Tarf", "Ben M'Hidi", "Berrihane", "Besbes", "Bougous", "Bouhadjar", "Bouteldja", "Chebaita Mokhtar", "Echatt", "El Aioun", "El Kala", "Hammam Beni Salah", "Lac des Oiseaux", "Souarekh", "Zerizer", "Zitouna"],
        /* 37 */ "37": ["Tindouf", "Oum El Assel"],
        /* 38 */ "38": ["Tissemsilt", "Ammari", "Bordj Bou Naama", "Bordj El Emir Abdelkader", "Boucaid", "Khemisti", "Lardjem", "Lazharia", "Maacem", "Melaab", "Ouled Bessem", "Sidi Abed", "Sidi Boutouchent", "Sidi Lantri", "Sidi Slimane", "Tamalaht", "Théniet El Had", "Tizi", "Youssoufia"],
        /* 39 */ "39": ["El Oued", "Bayadha", "Debila", "Djamaa", "Douar El Ma", "Guemar", "Hassi Khalifa", "Kouinine", "Magrane", "Mih Ouansa", "M'Rara", "Nakhla", "Oued El Alenda", "Oum Touyour", "Ourmes", "Reguiba", "Robbah", "Sidi Amrane", "Sidi Aoun", "Still", "Taghzout", "Taleb Larbi", "Tendla", "Trifaoui"],
        /* 40 */ "40": ["Khenchela", "Aïn Touila", "Babar", "Baghous", "Bouhmama", "Chelia", "Chechar", "Djellal", "El Hamma", "El Mahmal", "Ensigha", "Fais", "Kaïs", "Khirane", "M'Sara", "M'Toussa", "Ouled Rechache", "Remila", "Tamza", "Yabous"],
        /* 41 */ "41": ["Souk Ahras", "Aïn Zana", "Bir Bouhouche", "Drea", "Haddada", "Hanencha", "Khedara", "Khemissa", "M'Daourouche", "Mechroha", "Merahna", "Oued Kebrit", "Ouled Driss", "Ouled Moumen", "Oum El Adhaïm", "Ragouba", "Safel El Ouiden", "Sedrata", "Sidi Fredj", "Taoura", "Terraguelt", "Tiffech", "Zaarouria"],
        /* 42 */ "42": ["Tipaza", "Ahmer El Aïn", "Aïn Tagourait", "Attatba", "Beni Mileuk", "Bou Ismaïl", "Bouharoun", "Bourkika", "Chaiba", "Cherchell", "Damous", "Douaouda", "Fouka", "Gouraya", "Hadjout", "Khemisti", "Kolea", "Larhat", "Menaceur", "Messelmoun", "Nador", "Sidi Amar", "Sidi Ghiles", "Sidi Rached", "Sidi Semiane"],
        /* 43 */ "43": ["Mila", "Aïn Beida Harriche", "Aïn Mellouk", "Aïn Tine", "Amira Arras", "Benyahia Abderrahmane", "Bouhatem", "Chelghoum Laïd", "Chigara", "Derradji Bousselah", "El Mechira", "Elayadi Barbes", "Ferdjioua", "Grarem Gouga", "Hamala", "M'Cif", "Minar Zarza", "Oued Athmania", "Oued Endja", "Oued Seguen", "Ouled Khalouf", "Rouached", "Sidi Khelifa", "Sidi Merouane", "Tadjenanet", "Tassadane Haddada", "Teleghma", "Terrai Bainen", "Tiberguent", "Yahia Beni Guecha", "Zeghaia"],
        /* 44 */ "44": ["Aïn Defla", "Aïn Bouyahia", "Aïn Lechiakh", "Aïn Soltane", "Aïn Torki", "Arib", "Bathia", "Belaas", "Ben Allal", "Bir Ould Khelifa", "Bordj Emir Khaled", "Boumedfaa", "Bourached", "Djelida", "Djemaa Ouled Cheikh", "El Abadia", "El Amra", "El Attaf", "El Hassania", "El Maine", "Hammam Righa", "Hoceinia", "Khemis Miliana", "Mekhatria", "Miliana", "Oued Chorfa", "Oued Djemaa", "Rouina", "Sidi Lakhdar", "Tacheta Zougagha", "Tarik Ibn Ziad", "Tiberkanine", "Zeddine"],
        /* 45 */ "45": ["Naâma", "Aïn Ben Khelil", "Aïn Safra", "Asla", "El Biod", "Kasdir", "Makman Ben Amer", "Mecheria", "Moghrar", "Sfissifa", "Tiout"],
        /* 46 */ "46": ["Aïn Témouchent", "Aïn Kihal", "Aïn Tolba", "Beni Saf", "Bou Zedjar", "Chaabet El Leham", "Chentouf", "El Amria", "El Emir Abdelkader", "El Malah", "El Messaid", "Hammam Bou Hadjar", "Oued Berkeche", "Oued Sabah", "Ouled Boudjemaa", "Ouled Kihal", "Ouled Mimoun", "Sidi Ben Adda", "Sidi Boumediene", "Sidi Ouriache", "Sidi Safi", "Tamzoura", "Terga"],
        /* 47 */ "47": ["Ghardaïa", "Berriane", "Bounoura", "Dhayet Bendhahoua", "El Atteuf", "El Guerrara", "El Meniaa", "Metlili", "Sebseb", "Zelfana"],
        /* 48 */ "48": ["Relizane", "Aïn Rahma", "Aïn Tarek", "Ammi Moussa", "Beni Dergoun", "Beni Zentis", "Bendaoud", "Bouzegza", "Dar Ben Abdellah", "Djidiouia", "El Guettar", "El Hamri", "El Hassi", "El Matmar", "El Ouldja", "Had Echkalla", "Hamri", "Kalaa", "Lahlef", "Mazouna", "Mediouna", "Mendes", "Merdja Sidi Abed", "Ouarizane", "Oued Essalem", "Oued El Djemaa", "Ouled Aiche", "Ouled Sidi Mihoub", "Ramka", "Sidi Khettab", "Sidi Lazreg", "Sidi M'Hamed Ben Ali", "Sidi M'Hamed Benaouda", "Sidi Saada", "Souk El Had", "Yellel", "Zemmoura"],
        /* 49 */ "49": ["Timimoun", "Aïn El Beïda", "Aïn Ghoraba", "Aïn Kerma", "Aïn Salah", "Aïn Sfar", "Aougrout", "Bendida", "Beni Abbes", "Bordj Badji Mokhtar", "Charouine", "Deldoul", "El Menea", "Fenoughil", "Hassi Bel Guebbour", "Hassi Gara", "Ksar Kaddour", "Metarfa", "Ouled Aïssa", "Ouled Said", "Ouled Slimane", "Ouled Youcef", "Reggane", "Sali", "Sebaa", "Tabelbala", "Talmine", "Tamantit", "Tamest", "Tazrouk", "Tinerkouk", "Tit", "Zaouiet Kounta"],
        /* 50 */ "50": ["Bordj Badji Mokhtar", "Timiaouine"],
        /* 51 */ "51": ["Ouled Djellal", "Doucen", "Ras El Miaad", "Sidi Khaled", "Tolga"],
        /* 52 */ "52": ["Béni Abbès", "Igli", "Kerzaz", "Ouled Khoudir", "Tabalbala", "Taghit", "Timoudi"],
        /* 53 */ "53": ["In Salah", "Fenoughil", "Hassi Lahdjar", "In Ghar", "Tazrouk"],
        /* 54 */ "54": ["In Guezzam", "Tin Zaouatine"],
        /* 55 */ "55": ["Touggourt", "El Alia", "El Hadjira", "El Allouna", "El Borma", "El Ghrouss", "El Haoudh", "El Nezla", "El Oued", "El Ouata", "Hassi Ben Abdellah", "Hassi Messaoud", "M'Naguer", "Megarine", "Mih Ouensa", "N'Goussa", "Ouargla", "Rouissat", "Sidi Khouiled", "Taibet", "Tebesbest", "Temacine", "Zaouia El Abidia"],
        /* 56 */ "56": ["Djanet", "Bordj El Haouas"],
        /* 57 */ "57": ["El M'Ghair", "El Menea", "Hassi Gara", "Still"],
        /* 58 */ "58": ["El Meniaa", "Hassi Fehal", "Hassi Gara", "Metarfa"]
    };
    
    function updateCommunes() {
        const wilayaSelect = document.getElementById('wilaya');
        const communeSelect = document.getElementById('commune');
        const selectedWilaya = wilayaSelect.value;
        
        // Clear previous options
        communeSelect.innerHTML = '<option value="">Sélectionnez une commune</option>';
        
        if (selectedWilaya && wilayasCommunes[selectedWilaya]) {
            // Add communes for the selected wilaya
            wilayasCommunes[selectedWilaya].forEach(commune => {
                const option = document.createElement('option');
                option.value = commune.toLowerCase().replace(/ /g, '-');
                option.textContent = commune;
                communeSelect.appendChild(option);
            });
        }
    }
    document.getElementById('creer-annonce-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Show the modal
        const modal = document.getElementById('confirmationModal');
        modal.style.display = 'block';
        
        // Close button functionality
        modal.querySelector('.close').addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        // Submit the form after 10 seconds
        setTimeout(() => {
            // Hide the modal after submission
            modal.style.display = 'none';
            
            // Submit the form programmatically
            this.submit();
        }, 10000); // 10 seconds = 10000 milliseconds
    });
    
 
    </script>

@endsection