document.querySelectorAll(".product").forEach(product => {
    let currentIndex = 0;
    const slides = product.querySelectorAll(".carousel-item");
    const totalSlides = slides.length;
    const prevBtn = product.querySelector(".prev");
    const nextBtn = product.querySelector(".next");

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove("active");
            if (i === index) slide.classList.add("active");
        });
    }

    prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
    });

    nextBtn.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    });  
});

let btn=document.getElementById('btn-up');
    // Écoute de l'événement de scroll
window.addEventListener("scroll", () => {
        btn.style.display = window.scrollY <= 531 ? "none" : "block";
});
    // Événement de clic sur le bouton
btn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
});

function toggleDropdown(id) {
    var dropdown = document.getElementById(id);
    dropdown.classList.toggle("open"); 
}

// Ajouter un gestionnaire d'événements pour activer/désactiver le checkbox lors du clic sur <li>
document.querySelectorAll('.dropdown-content li').forEach(function(li) {
    li.addEventListener('click', function(event) {
        // Trouver le checkbox à l'intérieur du <li>
        const checkbox = li.querySelector('.cyberpunk-checkbox');
        if (checkbox) {
            checkbox.checked = !checkbox.checked; // Inverser l'état du checkbox
            event.stopPropagation(); // ne pas fermer le dropdown
        }
    });
});


document.querySelectorAll('.cyberpunk-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('click', function(event) {
        event.stopPropagation(); 
    });
});

function toggleDropdownnn() {
    const options = document.querySelector('.custom-select .options');
    options.classList.toggle("open");
}

// Fermer le dropdown si on clique en dehors
document.addEventListener('click', function(event) {
    const customSelect = document.querySelector('.custom-select');
    if (!customSelect.contains(event.target)) {
        const options = document.querySelector('.custom-select .options');
        options.classList.remove('open');
    }
});

// Gérer la sélection d'une option
document.querySelectorAll('.custom-select .options li').forEach(option => {
    option.addEventListener('click', function() {
        const selectedOption = document.querySelector('.custom-select .selected-option');
        selectedOption.textContent = this.textContent;
        document.querySelector('.custom-select .options').classList.remove('open');
        // Vous pouvez également mettre à jour une valeur cachée pour le formulaire
    });
});


function toggleDropdownn(id) {
    const options = document.getElementById(`${id}-options`);
    options.classList.toggle("open");
}

document.addEventListener('click', function(event) {
    const customSelects = document.querySelectorAll('.custom-select');
    customSelects.forEach(select => {
        if (!select.contains(event.target)) {
            const options = select.querySelector('.options');
            options.classList.remove('open');
        }
    });
});

document.querySelectorAll('.custom-select .options li').forEach(option => {
    option.addEventListener('click', function() {
        const selectedOption = this.closest('.custom-select').querySelector('.selected-option');
        selectedOption.textContent = this.textContent;
        this.closest('.options').classList.remove('open');
    });
});


// page detail


let currentIndex = 0;
const carouselInner = document.querySelector('.carousell-inner');
const items = document.querySelectorAll('.carousell-item');
const totalItems = items.length;

document.querySelector('.carousell-next').addEventListener('click', () => {
  if (currentIndex < totalItems - 1) {
    currentIndex++;
  } else {
    currentIndex = 0;
  }
  updateCarousel();
});

document.querySelector('.carousell-prev').addEventListener('click', () => {
  if (currentIndex > 0) {
    currentIndex--;
  } else {
    currentIndex = totalItems - 1;
  }
  updateCarousel();
});

function updateCarousel() {
  const offset = -currentIndex * 100;
  carouselInner.style.transform = `translateX(${offset}%)`;
}

// Carte Google Maps
function initMap() {
  const location = { lat: 48.8566, lng: 2.3522 }; // Exemple : Paris
  const map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: location,
  });
  new google.maps.Marker({
    position: location,
    map: map,
  });
}

// Initialisation de la carte
initMap();

// Formulaire de contact
document.getElementById('contactForm').addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Votre message a été envoyé !');
  // Ici, vous pouvez ajouter une logique pour envoyer le formulaire à un serveur
});








