@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/nav_footer.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/service.css') }}">
@endpush
@section('title') Nos Services - Plateforme pour Agences Immobilières @endsection
@section("content")

    <!-- Hero Section -->
    <section class="banner curved hidden">
        <div class="wrapper">
            <div class="banner-content">
                <h1 class="hidden slide-left">Solutions Digitales pour Professionnels Immobiliers</h1>
                <p class="hidden slide-right">Plateforme tout-en-un avec IA pour maximiser vos ventes et optimiser votre temps</p>
                <div class="banner-btns">
                    <button class="btn btn-primary hidden slide-left">Essai gratuit de 30 jours</button>
                    <button class="btn btn-outline hidden slide-right">Voir la démo vidéo</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Plans Section -->
    <section class="section-block">
        <div class="wrapper">
            <div class="section-header">
                <h2 class="hidden slide-up">Nos Formules Adaptées</h2>
                <p class="hidden slide-up">Choisissez l'offre qui correspond à la taille et aux ambitions de votre agence</p>
            </div>
            
            <div class="pricing-container">
                <!-- Starter -->
                <div class="pricing-item item hidden slide-right">
                    <div class="mb-6">
                        <h3>FREE</h3>
                        <p>Pour agents indépendants et petites structures</p>
                    </div>
                    
                    <div class="mb-8">
                        <p class="pricing-cost">990DA <span>/mois</span></p>
                        <p class="text-sm text-gray-500 mt-1">Facturation annuelle ou 119 DA/mois</p>
                    </div>
                    
                    <ul class="pricing-features-list">
                        
                        <li class="included"><i class="fas fa-check"></i> 2 publications/jour max</li>
                        <li class="included"><i class="fas fa-check"></i> 1 description IA/jour</li>
                        <li class="not-included"><i class="fas fa-times"></i> Badge Premium</li>
                        <li class="not-included"><i class="fas fa-times"></i> Priorité des annonces</li>
                        <li class="not-included"><i class="fas fa-times"></i> Assistant IA</li>
                    </ul>
                    
                    <button class="btn btn-outline">Essai gratuit</button>
                </div>
                
                <!-- Pro -->
                <div class="pricing-item highlight item hidden slide-right">
                    <div class="highlight-badge">Le plus populaire</div>
                    
                    <div class="mb-6">
                        <h3>Professionnel</h3>
                        <p>Pour agences en croissance</p>
                    </div>
                    
                    <div class="mb-8">
                        <p class="pricing-cost">199 DA<span>/mois</span></p>
                        <p class="text-sm text-gray-500 mt-1">Facturation annuelle ou 22900 DA/mois</p>
                    </div>
                    
                    <ul class="pricing-features-list">
                       
                        <li class="included"><i class="fas fa-check"></i> 5 publications/jour max</li>
                        <li class="included"><i class="fas fa-check"></i> 5 descriptions IA/jour</li>
                        <li class="included"><i class="fas fa-check"></i> Badge Premium</li>
                        <li class="included"><i class="fas fa-check"></i> Priorité des annonces</li>
                        <li class="included"><i class="fas fa-check"></i> Assistant IA basique</li>
                    </ul>
                    
                    <button class="btn btn-primary">Essai gratuit</button>
                </div>
                
                <!-- Premium -->
                <div class="pricing-item item hidden slide-right">
                    <div class="mb-6">
                        <h3>Premium Illimité</h3>
                        <p>Pour agences haut de gamme et réseaux</p>
                    </div>
                    
                    <div class="mb-8">
                        <p class="pricing-cost">499 DA<span>/mois</span></p>
                        <p class="text-sm text-gray-500 mt-1">Facturation annuelle ou 5400DA/mois</p>
                    </div>
                    
                    <ul class="pricing-features-list">
                        <li class="included"><i class="fas fa-check"></i> <strong>Publications illimitées</strong></li>
                        <li class="included"><i class="fas fa-check"></i> <strong>Descriptions IA illimitées</strong></li>
                        <li class="included"><i class="fas fa-check"></i> Badge Premium exclusif</li>
                        <li class="included"><i class="fas fa-check"></i> Priorité maximale des annonces</li>
                        <li class="included"><i class="fas fa-check"></i> Assistant IA premium</li>
                        <li class="included"><i class="fas fa-check"></i> Support VIP 24/7</li>
                    </ul>
                    
                    <button class="btn btn-outline">Essai gratuit</button>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <p class="text-gray-600">Besoin d'une solution sur mesure ? <a href="#" class="text-main-color font-medium hover:underline">Contactez notre équipe</a> pour une offre personnalisée.</p>
            </div>
        </div>
    </section>

    <!-- Features Comparison Table -->
<section class="section-block bg-gray-50">
    <div class="wrapper">
        <div class="section-header">
            <h2 class="hidden slide-up">Comparaison Complète des Formules</h2>
            <p class="hidden slide-up">Toutes les différences entre nos offres en un coup d'œil</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="features-table">
                <thead>
                    <tr>
                        <th>Fonctionnalités</th>
                        <th class="text-center">Gratuit</th>
                        <th class="text-center">Professionnel</th>
                        <th class="text-center">Premium</th>
                    </tr>
                </thead>
                <tbody>
                   
                   
                    
                    <!-- Publications -->
                    <tr class="category-row">
                        <td colspan="4">Publications</td>
                    </tr>
                    <tr>
                        <td>Annonces/jour</td>
                        <td class="text-center">2 max</td>
                        <td class="text-center">5 max</td>
                        <td class="text-center"><strong>Illimité</strong></td>
                    </tr>
                    <tr>
                        <td>Badge Premium</td>
                        <td class="text-center"><i class="fas fa-times cross"></i></td>
                        <td class="text-center"><i class="fas fa-check check"></i></td>
                        <td class="text-center"><strong><i class="fas fa-check check"></i> Exclusif</strong></td>
                    </tr>
                    <tr>
                        <td>Priorité des annonces</td>
                        <td class="text-center"><i class="fas fa-times cross"></i></td>
                        <td class="text-center"><i class="fas fa-check check"></i></td>
                        <td class="text-center"><strong><i class="fas fa-check check"></i> Maximale</strong></td>
                    </tr>
                    
                    <!-- IA -->
                    <tr class="category-row">
                        <td colspan="4">Intelligence Artificielle</td>
                    </tr>
                    <tr>
                        <td>Chatbot Immo</td>
                        <td class="text-center"><i class="fas fa-check cross"></i></td>
                        <td class="text-center"><i class="fas fa-check cross"></i></td>
                        <td class="text-center"><strong><i class="fas fa-check check"></i></strong></td>
                    </tr>
                    <tr>
                        <td>Descriptions IA/jour</td>
                        <td class="text-center">1</td>
                        <td class="text-center">5</td>
                        <td class="text-center"><strong>Illimité</strong></td>
                    </tr>
                    <tr>
                        <td>Assistant IA</td>
                        <td class="text-center"><i class="fas fa-times cross"></i></td>
                        <td class="text-center">Basique</td>
                        <td class="text-center"><strong>Premium</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

    <!-- Demo Section -->
    <section class="section-block">
        <div class="wrapper">
            <div class="demo-container">
                <div class="w-full lg:w-1/2">
                    <div class="demo-video-container">
                        <img src="{{ asset('assets/images/walid.png') }}" alt="Démonstration plateforme" class="demo-thumbnail">
                        <div class="play-btn">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="demo-stats">
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Agences satisfaites</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Support disponible</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">95%</div>
                            <div class="stat-label">Clients renouvelés</div>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <div class="demo-content-block">
                        <h2 class="hidden slide-up">Prêt à révolutionner votre agence ?</h2>
                        <p class="hidden slide-up">Réservez une démonstration personnalisée avec l'un de nos experts et découvrez comment notre solution peut booster votre activité.</p>
                    </div>
                    
                    <form class="demo-form-container">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Votre nom*</label>
                                <input type="text" id="name" placeholder="Jean Dupont" required>
                            </div>
                            <div class="form-group">
                                <label for="company">Nom de l'agence*</label>
                                <input type="text" id="company" placeholder="Dupont Immobilier" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email professionnel*</label>
                                <input type="email" id="email" placeholder="contact@votreagence.fr" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Téléphone*</label>
                                <input type="tel" id="phone" placeholder="01 23 45 67 89" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="size">Taille de votre agence*</label>
                            <select id="size" required>
                                <option value="" disabled selected>Sélectionnez</option>
                                <option value="independant">Indépendant</option>
                                <option value="small">Petite agence (2-5 agents)</option>
                                <option value="medium">Moyenne agence (6-15 agents)</option>
                                <option value="large">Grande agence (15+ agents)</option>
                                <option value="network">Réseau d'agences</option>
                            </select>
                        </div>
                        
                        <div class="checkbox-container">
                            <input type="checkbox" id="consent" class="custom-checkbox" required>
                            <label for="consent" class="checkbox-label">J'accepte les conditions d'utilisation et la politique de confidentialité.</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Demander une démo</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
{{-- 
    <!-- Testimonials -->
    <section class="section-block bg-gray-50">
        <div class="wrapper">
            <div class="section-header">
                <h2 class="hidden slide-up">Ils nous font confiance</h2>
                <p class="hidden slide-up">Découvrez ce que disent les professionnels de notre solution</p>
            </div>
            
            <div class="testimonials-container">
                <div class="testimonial-item hidden slide-left">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "La génération automatique des descriptions nous fait gagner un temps considérable. Nos annonces sont maintenant plus percutantes et mieux référencées."
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="{{ asset('assets/images/avatar1.jpg') }}" alt="Sophie Martin">
                            </div>
                            <div class="author-info">
                                <div class="author-name">Sophie Martin</div>
                                <div class="author-title">Directrice, Luxe Immobilier Paris</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-item hidden slide-left">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "Le chatbot IA qualifie nos leads 24h/24. Nous avons augmenté nos ventes de 30% tout en réduisant notre temps de gestion des prospects."
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="{{ asset('assets/images/avatar2.jpg') }}" alt="Pierre Lambert">
                            </div>
                            <div class="author-info">
                                <div class="author-name">Pierre Lambert</div>
                                <div class="author-title">Fondateur, ImmoPro</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-item hidden slide-left">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "Avec les publications illimitées, nous pouvons maximiser la visibilité de tous nos biens sans nous soucier des coûts supplémentaires."
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="{{ asset('assets/images/avatar3.jpg') }}" alt="Élodie Rousseau">
                            </div>
                            <div class="author-info">
                                <div class="author-name">Élodie Rousseau</div>
                                <div class="author-title">Directrice Régionale, ImmoFrance</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section-block">
        <div class="wrapper">
            <div class="section-header">
                <h2 class="hidden slide-up">Questions Fréquentes</h2>
                <p class="hidden slide-up">Trouvez rapidement des réponses à vos questions</p>
            </div>
            
            <div class="faq-container">
                <!-- General -->
                <div class="faq-category">
                    <h3>Général</h3>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Quelle est la durée de l'essai gratuit ?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Nous offrons un essai gratuit de 30 jours sans engagement. Vous avez accès à toutes les fonctionnalités de la formule que vous choisissez pendant cette période. Aucune carte bancaire n'est requise pour commencer l'essai.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Puis-je changer de formule ultérieurement ?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Oui, vous pouvez passer à une formule supérieure à tout moment. Si vous souhaitez descendre à une formule inférieure, le changement prendra effet à la fin de votre période de facturation en cours.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Fonctionnalités -->
                <div class="faq-category">
                    <h3>Fonctionnalités</h3>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Comment fonctionne la génération automatique de descriptions ?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Notre IA analyse les caractéristiques techniques de votre bien (surface, nombre de pièces, localisation...) et génère une description optimisée en quelques secondes. Vous pouvez personnaliser le style (neutre, élégant, dynamique) et modifier le texte généré avant publication.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Le chatbot peut-il répondre à des questions spécifiques sur mes biens ?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Absolument ! Le chatbot se synchronise avec votre catalogue de biens et peut répondre précisément sur les caractéristiques, disponibilités, prix et visites. Il apprend également des questions fréquentes pour s'améliorer continuellement.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Technique -->
                <div class="faq-category">
                    <h3>Technique</h3>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Quelle est la durée d'intégration de la solution ?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p>La plupart de nos clients sont opérationnels en moins d'une semaine. Pour une intégration complète avec import des données existantes et formation de l'équipe, comptez 2 à 3 semaines selon la taille de votre agence.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Proposez-vous une application mobile ?</span>
                                <i class="fas fa-chevron-down faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Oui, notre plateforme est entièrement responsive et accessible sur mobile. Une application native est également disponible pour iOS et Android, incluant toutes les fonctionnalités principales comme la gestion des visites, la prise de photos et la signature électronique.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cta-block mt-12">
                <h3 class="hidden slide-up">Vous avez d'autres questions ?</h3>
                <p class="hidden slide-up">Notre équipe est à votre disposition pour y répondre.</p>
                <button class="btn btn-primary hidden slide-up">Contactez-nous</button>
            </div>
        </div>
    </section> --}}
    
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
        if (entry.isIntersecting) {
         entry.target.classList.add('show');
         observer.unobserve(entry.target); // Pour éviter l'animation répétée
        }
        });
        });
        
        const elementsToReveal = document.querySelectorAll('.hidden');
        elementsToReveal.forEach(el => observer.observe(el));
});
document.addEventListener('DOMContentLoaded', () => {
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate');
        observer.unobserve(entry.target); // Optional: stops observing after first reveal
      }
    });
  });

  const serviceItems = document.querySelectorAll('.item');
  serviceItems.forEach(item => observer.observe(item));
});
</script>

    @push('script')  
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                }
            });
            
            // FAQ Accordion
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                
                question.addEventListener('click', () => {
                    // Close all other items
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                        }
                    });
                    
                    // Toggle current item
                    item.classList.toggle('active');
                });
            });

            // Demo video play
            const playBtn = document.querySelector('.play-btn');
            const demoThumbnail = document.querySelector('.demo-thumbnail');
            
            playBtn.addEventListener('click', function() {
                // Replace with actual video embed code
                demoThumbnail.innerHTML = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/videoid" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            });
        });
    </script>
     @endpush
@endsection