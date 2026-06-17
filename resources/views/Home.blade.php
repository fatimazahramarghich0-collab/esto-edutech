
<x-layout title="ESTO-EduTech">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** --><div>
  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <h6 id="welcome-title">
                  <span class="fade-in change-color">Bienvenue à </span>
                  <span class="fade-in change-color">E</span>
                  <span class="fade-in change-color">S</span>
                  <span class="fade-in change-color">T</span>
                  <span class="fade-in change-color">O</span>
                  <span class="fade-in change-color">-</span>
                  <span class="fade-in change-color">E</span>
                  <span class="fade-in change-color">d</span>
                  <span class="fade-in change-color">u</span>
                  <span class="fade-in change-color">-</span>
                  <span class="fade-in change-color">T</span>
                  <span class="fade-in change-color">e</span>
                  <span class="fade-in change-color">c</span>
                  <span class="fade-in change-color">h</span>
                </h6>
                
                                <h2>Où nous facilitons la vie pour <em>Les Étudiants</em> &amp; <span>Les Enseignants</span></h2>
                  <p>ESTO-EduTech est une plateforme dédiée à l'école supérieure de technologie d'Oujda, axée sur la gestion complète des cours, des examens, des notes, des absences et d'autres aspects essentiels.</p>
                <style>
          
                #welcome-title {
                  display: inline-block;
                  font-size: 24px;
                }
                
                .fade-in {
                  opacity: 0;
                  transition: opacity 0.5s ease-in-out;
                }
                
                .fade-in.active {
                  opacity: 1;
                }
                
                .change-color {
                  animation: changeColor 4s infinite alternate;
                }
                
                @keyframes changeColor {
                  0% { color: rgb(63, 130, 255); }
                  25% { color: rgb(255, 17, 17); }
                  50% {color:yellow}
                  100% { color: rgb(60, 241, 154) }
                }
                
                </style>
                <script>
// Function to animate the title
function animateTitle() {
  var fadeIns = $('#welcome-title .fade-in');
  fadeIns.each(function(index) {
    var element = $(this);
    setTimeout(function() {
      element.addClass('active');
    }, 500 * index);
  });
}

// Function to reset the animation after completion
function resetAnimation() {
  $('#welcome-title .fade-in').removeClass('active');
}

// Call the function to start the animation
animateTitle();

// Call the function to reset the animation after completion
setTimeout(resetAnimation, 7500); // 7.5 seconds

// Call the function to loop the animation indefinitely
setInterval(function() {
  animateTitle();
  setTimeout(resetAnimation, 7500); // 7.5 seconds
}, 8000); // Repeat every 8 seconds (including the delay for the initial animation)

                </script>
               
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight home-img" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{ asset('assets/images/robo.png') }}" alt="Our robo">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
          <div class="col-lg-4 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
              <div class="left-image">
                  <img src="{{ asset("assets/images/serviceLeft.png")}}"  alt="">
              </div>
          </div>
          <div class="col-lg-7 align-self-center">
            <div class="services">
              <div class="row">
                <div class="col-lg-6">
                  <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="icon">
                      <img src="{{ asset('assets/images/serviceImg1.png') }}" alt="reporting">
                    </div>
                    <div class="right-text">
                      <h4>Gestion complète des étudiants</h4>
                      <p>Les administrateurs ont la capacité de gérer les informations des étudiants, tandis que les étudiants peuvent accéder à leurs cours et voir leurs informations personnelles.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                    <div class="icon">
                      <img src="{{ asset('assets/images/serviceImg2.png') }}" alt="">
                    </div>
                    <div class="right-text">
                      <h4>Suivi des Cours et Évaluations</h4>
                      <p>Les enseignants suivent les cours et gèrent les évaluations. Les étudiants visualisent leurs notes et participent aux évaluations.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                    <div class="icon">
                      <img src="{{ asset('assets/images/serviceImg3.png') }}" alt="">
                    </div>
                    <div class="right-text">
                      <h4>Organisation des Horaires et Charges</h4>
                      <p>Les enseignants et les administrateurs planifient les horaires et gèrent les charges horaires.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
                    <div class="icon">
                      <img src="{{ asset('assets/images/serviceImg4.png') }}" alt="">
                    </div>
                    <div class="right-text">
                      <h4>Suivi des Filères et Départements</h4>
                      <p>Les administrateurs gèrent les filières et départements. Les enseignants sont affectés aux cours. Les étudiants sont associés à une filière.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
  {{-- <div id="services" class="our-services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="{{ asset('assets/images/aboutus.png') }}" alt=" ff">
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>L'école Supérieure de Technologie En <span>Chiffre</span></h2>
            <p>ESTO est en croissance continue pour correspondre aux exigences de développement de l’économie de la Région.</p>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="first-bar progress-skill-bar">
                <h4>Enseignants et assistants</h4>
                <span>+45</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="second-bar progress-skill-bar">
                <h4>Personnels</h4>
                <span>+102</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="third-bar progress-skill-bar">
                <h4>Etudiants</h4>
                <span>+1000</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

  <div id="services" class="our-services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="{{ asset('assets/images/aboutus.png') }}" alt=" ff">
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>L'école Supérieure de Technologie En <span>Chiffre</span></h2>
            <p style="font-size: 16px; color: #333; font-family: Arial, sans-serif; font-weight: bold;">ESTO est en croissance continue pour correspondre aux exigences de développement de l’économie de la Région.</p>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="first-bar progress-skill-bar">
                <h4>Enseignants</h4>
                <span>{{ '+'.$nbrTeachers }}</span>
                <div class="filled-bar" style="width: {{ $nbrTeachers }}%;"></div>
                <div class="full-bar"></div>
            </div>
            </div>
            <div class="col-lg-12">
              <div class="second-bar progress-skill-bar">
                <h4>Étudiants</h4>
                <span>{{ '+'.$nbrStudents }}</span>
                <div class="filled-bar"  style="width: {{ $nbrStudents }}%;"></div>
                <div class="full-bar"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="third-bar progress-skill-bar">
                  <h4>Filières</h4>
                <span>{{ '+'.$nbrSectors }}</span>
                <div class="filled-bar" style="width: {{ $nbrSectors }}%;"></div>
                <div class="full-bar"></div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- ----------------------------------------------------------------------- --}}
  <div id="portfolio" class="our-portfolio section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading  wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <h2><em>Membres de</em> <span>l'équipe de production de la</span> plateforme</h2>
          </div>
        </div>
      </div>
  <div class="container">


    <div class="row justify-content-center">
      <!-- Première ligne avec 3 éléments -->
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        
          <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
            <div class="hidden-content">
              <h4>Abderrahim EL OURIACHI</h4>
              <p>Etudiant en génie informatique 2022-2024</p>
              <a href="https://www.linkedin.com/in/abderrahim-el-ouariachi-a1b2c3/" target="blank" class="linkedin-link">Voir le compte LinkedIn</a>
            </div>
            <div class="showed-content">
              <img class="rounded-xl portfolio-image" src="https://picsum.photos/seed/{{ rand(0, 1000000) }}/100/100" alt="Portfolio Image" data-linkedin="URL_LINKEDIN_SPECIFIQUE">
            </div>
          </div>
    
      </div>
      <style>
.item {
  position: relative;
}

.hidden-content {
  padding: 20px;
  background: linear-gradient(135deg, #3498db, #e74c3c); /* Dégradé de bleu à rouge */
  position: absolute;
  top: -10px;
  left: 0;
  right: 0;
  z-index: 1;
  transition: all 0.3s ease;
  opacity: 0;
  visibility: hidden;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border: 1px solid #2980b9; /* Bordure légère bleue */
}

/* .item:hover .hidden-content {
  top: calc(100% + 10px);
  visibility: visible;
  opacity: 1;
  transition: all 0.3s ease;
} */
/* 
.item {
  position: relative;
  overflow: hidden;
} */


.showed-content:hover {
  opacity: 1;
}


      </style>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4" >
       
          <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.4s">
            <div class="hidden-content">
              <h4>Ayoub BERHILI</h4>
              <p>Etudiant en génie informatique 2022-2024</p>
              <a href="https://www.linkedin.com/in/ayoub-berhili-3a6212290/" target="blank" class="linkedin-link">Voir le compte LinkedIn</a>
            </div>
            <div class="showed-content">
              <img class="rounded-xl portfolio-image" src="https://picsum.photos/seed/{{ rand(0, 1000000) }}/300/300" alt="Portfolio Image" data-linkedin="URL_LINKEDIN_SPECIFIQUE">
            </div>
          </div>
        
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 ">
        
          <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="hidden-content">
              <h4>Aya OUZARF</h4>
              <p>Etudiante en génie informatique 2022-2024</p>
              <a href="https://www.linkedin.com/in/aya-ouzarf-386b28267/" target="blank" class="linkedin-link">Voir le compte LinkedIn</a>
            </div>
            <div class="showed-content">
              <img class="rounded-xl portfolio-image" src="{{ asset('assets/images/Aya.jpeg') }}" alt="Portfolio Image" data-linkedin="URL_LINKEDIN_SPECIFIQUE">
            </div>
          </div>
      </div>
    </div>


    <!-- Deuxième ligne avec 2 éléments -->
    <div class="row mt-4 justify-content-center">
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.6s">
            <div class="hidden-content">
              <h4>Wissal BENALI</h4>
              <p>Etudiante en génie informatique 2022-2024</p>
              <a href="https://www.linkedin.com/in/wissal-benali-9992a7271/" target="blank" class="linkedin-link">Voir le compte LinkedIn</a>
            </div>
            <div class="showed-content">
              <img class="rounded-xl portfolio-image" src="{{ asset('assets/images/wissal.jpeg') }}" alt="Portfolio Image" data-linkedin="URL_LINKEDIN_SPECIFIQUE">
            </div>
          </div>
      
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.7s">
            <div class="hidden-content">
              <h4>Fatima Zahra MARGHICH</h4>
              <p>Etudiante en génie informatique 2022-2024</p>
              <a href="https://www.linkedin.com/in/fatima-zahra-marghich-b4b4b62b6/" target="blank" class="linkedin-link">Voir le compte LinkedIn</a>
            </div>
            <div class="showed-content">
              <img class="rounded-xl portfolio-image" src="{{ asset('assets/images/Fati.jpeg') }}" alt="Portfolio Image" data-linkedin="URL_LINKEDIN_SPECIFIQUE">
            </div>
          </div>
      </div>
    </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
  $('.hidden-content').hide(); // Cacher le contenu caché initialement
  
  $('.portfolio-image').mouseenter(function(){
    // Afficher le contenu caché lorsque l'utilisateur survole l'image
    $(this).closest('.item').find('.hidden-content').slideDown();
  });
  
  $('.item').mouseleave(function(){
    // Cacher le contenu lorsque la souris quitte l'élément
    $(this).find('.hidden-content').slideUp();
  });
  
  // Lien LinkedIn
  $('.portfolio-image').click(function(){
    var linkedinURL = $(this).data('linkedin');
    if(linkedinURL){
      window.location.href = linkedinURL;
    } else {
      alert("Lien LinkedIn non disponible.");
    }
  });
});

</script>
{{-- -------------------------------------------------------------------- --}}
<div id="blog" class="our-blog section">
  <div class="container">
      <div class="row">
          <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
              <div class="section-heading">
                  <h2>Découvrez les nouvelles <em>Filières</em> dans notre <span>École</span></h2>
              </div>
          </div>
          <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
              <div class="top-dec">
                  <div class="height-div"></div>
              </div>
          </div>
      </div>
      @if($sectors->isEmpty())
    <div class="row">
        <div class="col-lg-12">
            <p>Aucun secteur n'est disponible pour le moment.</p>
        </div>
    </div>
      @else
      <div class="row">
          <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
              <div class="left-image">
                  <img src="{{ asset('assets/images/bureaux-33.jpeg') }}" alt="Workspace Desktop">
                  <div class="info">
                      <div class="inner-content">
                          <ul>
                              <li><i class="fa fa-calendar"></i> {{$sectors[0]->created_at->format('Y-m-d')}}</li>
                          </ul>
                        <h4>{{$sectors[0]->name}}</h4>
                          <p class="description-short">{{ strlen($sectors[0]->description) > 50 ? substr($sectors[0]->description, 0, 50).'...' : $sectors[0]->description }}</p>
                          <p class="description-full" style="display:none;">{{$sectors[0]->description}}</p>
                          @if(strlen($sectors[0]->description) > 50)
                              <a href="#" class="voir-plus">Voir plus</a>
                              <a href="#" class="cacher" style="display:none;">Cacher</a>

                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
              <div class="right-list">
                  <ul>
                      <li>
                          <div class="left-content align-self-center">
                              <span><i class="fa fa-calendar"></i>{{$sectors[1]->created_at->format('Y-m-d')}}</span>
                             <h4>{{$sectors[1]->name}}</h4>
                              <p class="description-short">{{ strlen($sectors[1]->description) > 50 ? substr($sectors[1]->description, 0, 50).'...' : $sectors[1]->description }}</p>
                                <p class="description-full" style="display:none;">{{$sectors[1]->description}}</p>
                                @if(strlen($sectors[1]->description) > 50)
                                    <a href="#" class="voir-plus">Voir plus</a>
                                    <a href="#" class="cacher" style="display:none;">Cacher</a>

                                @endif
                          </div>
                          <div class="right-image">
                             
                            <img src="{{ asset('assets/images/icon-news-1.png') }}" alt="">
                          </div>
                      </li>
                      <li>
                          <div class="left-content align-self-center">
                              <span><i class="fa fa-calendar"></i>{{$sectors[2]->created_at->format('Y-m-d')}}</span>
                              <h4>{{$sectors[2]->name}}</h4>
                              <p class="description-short">{{ strlen($sectors[2]->description) > 50 ? substr($sectors[2]->description, 0, 50).'...' : $sectors[2]->description }}</p>
                              <p class="description-full" style="display:none;">{{$sectors[2]->description}}</p>
                              @if(strlen($sectors[2]->description) > 50)
                                  <a href="#" class="voir-plus">Voir plus</a>
                                  <a href="#" class="cacher" style="display:none;">Cacher</a>

                              @endif
                          </div>
                          <div class="right-image">
                             <img src="{{ asset('assets/images/icon-news-22.png') }}" alt="">
                          </div>
                      </li>
                      <li>
                          <div class="left-content align-self-center">
                              <span><i class="fa fa-calendar"></i>{{$sectors[3]->created_at->format('Y-m-d')}}</span>
                              <h4>{{$sectors[3]->name}}</h4>
                              <p class="description-short">{{ strlen($sectors[3]->description) > 50 ? substr($sectors[3]->description, 0, 50).'...' : $sectors[3]->description }}</p>
                              <p class="description-full" style="display:none;">{{$sectors[3]->description}}</p>
                              @if(strlen($sectors[3]->description) > 50)
                                  <a href="#" class="voir-plus">Voir plus</a>
                                  <a href="#" class="cacher" style="display:none;">Cacher</a>

                              @endif
                          </div>
                          <div class="right-image">
                             <img src="{{ asset('assets/images/icon-news-graph.png') }}" alt="">
                          </div>
                      </li>
                      <!-- Ajoutez les autres éléments de la liste ici -->
                  </ul>
              </div>
          </div>
      </div>
      @endif
  </div>
</div>

<script>
  $(document).ready(function(){
      $(".voir-plus").click(function(event){
          event.preventDefault(); // Empêche le lien de déclencher le comportement par défaut
  
          // Récupère la description complète
          var description_full = $(this).siblings('.description-full').html();
  
          // Affiche la description complète
          $(this).siblings('.description-short').html(description_full);
  
          // Masque le lien "Voir plus"
          $(this).hide();
  
          // Affiche le lien "Cacher"
          $(this).siblings('.cacher').show();
      });
  
      $(".cacher").click(function(event){
          event.preventDefault(); // Empêche le lien de déclencher le comportement par défaut
  
          // Récupère la description courte
          var description_short = $(this).siblings('.description-short').attr('data-short');
  
          // Affiche la description courte
          $(this).siblings('.description-short').html(description_short);
  
          // Masque le lien "Cacher"
          $(this).hide();
  
          // Affiche le lien "Voir plus"
          $(this).siblings('.voir-plus').show();
      });
  
      // Limiter la longueur de la description initiale à 50 caractères
      $(".description-full").each(function(){
          var description_full = $(this).html();
          if(description_full.length > 50){
              var description_short = description_full.substring(0, 50) + "...";
              $(this).siblings('.description-short').attr('data-short', description_short);
              $(this).siblings('.description-short').html(description_short);
              $(this).siblings('.voir-plus').show();
          }
      });
  });
  </script>
  {{-- ------------------------------------------------------------------------ --}}

  <div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <!-- Colonne pour le formulaire -->
            <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
                <div class="section-heading container">
                    <h2 style="text-align: center">Explorez notre emplacement</h2>
                    <!-- Carte Google Maps intégrée -->
                    <div id="map-container" style="border-radius: 6%;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3333.727777926506!2d-1.9020194999999997!3d34.64917750000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd787cbd8186f0b7%3A0x5226a42c88c53d39!2sEST%20%3A%20Ecole%20Sup%C3%A9rieure%20de%20Technologie_Oujda!5e0!3m2!1sen!2sma!4v1622666030667!5m2!1sen!2sma" width="100%" height="450" style="border-radius: 6%;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <noscript>
                  </noscript>
                    <div class="phone-info" style="margin-top: 20px;">
                        <h4>Appelez-nous : <span><i class="fa fa-phone"></i> <a href="#">05365-00224</a></span></h4>
                        <p style="text-align: center; color:yellow;">Impossible de charger la carte. Veuillez vérifier votre connexion Internet | activer JavaScript dans votre navigateur ou réessayer plus tard!</p>
                    </div>
                </div>
            </div>
            <script>
              // Fonction pour vérifier si la carte Google Maps est chargée correctement
              function checkMapLoaded() {
                  var mapFrame = document.getElementById('google-map');
                  if (!mapFrame.contentWindow || !mapFrame.contentWindow.document || !mapFrame.contentWindow.document.documentElement) {
                      // La carte n'est pas chargée correctement
                      document.getElementById('map-error-message').style.display = 'block';
                      document.getElementById('map-container').style.display = 'none';
                  }
              }
          
              // Vérifier si la carte est chargée après un certain délai
              setTimeout(checkMapLoaded, 5000); // 5000 millisecondes (5 secondes)
          </script>
            <style>
              @keyframes rotate3D {
  0% {
    transform: rotateY(0deg);
  }
  100% {
    transform: rotateY(360deg);
  }
}.fa-phone:hover {
  animation: rotate3D 1s linear infinite; /* Nom de l'animation, durée, type de transition, nombre de répétitions */
} 
#success-message {
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #28a745;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  z-index: 9999;
  animation: slideIn 0.5s ease forwards, fadeOut 2s 1s ease forwards;
}

@keyframes slideIn {
  from {
    transform: translateX(-50%) translateY(100%);
  }
  to {
    transform: translateX(-50%) translateY(0);
  }
}

@keyframes fadeOut {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}
#error-message {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #dc3545; /* Red color for error message */
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    display: none; /* Hide the error message by default */
}
            </style>
            <!-- Colonne pour le formulaire -->
            <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
                <div class="section-heading">
                 
                    <h2 style="text-align: center">Contactez-nous</h2>
                </div>
                <!-- Ajoutez jQuery à votre page -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Votre message de succès -->
<div id="success-message" style="display: none;">Message envoyé avec succès !</div>

<!-- Votre message d'erreur -->
<div id="error-message" style="display: none;">Veuillez remplir tous les champs !</div>
                <form id="contact-form" action="{{route('home.store')}}" method="post" >
                  @csrf
                  <div id="success-message" style="display: none;">Message envoyé avec succès !</div> 
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" id="name" placeholder="Nom" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="surname" id="surname" placeholder="Prénom" required>
                        </div>
                        <div class="col-md-12">
                            <input type="email" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="message" id="message" placeholder="Message" rows="7" required></textarea>
                        </div>
                        <div class="col-md-12">
                          <button class="unique-button main-button" type="submit" id="submit-form">
                            <div class="svg-wrap">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                              >
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                  fill="currentColor"
                                  d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                                ></path>
                              </svg>
                            </div>
                            <span>Envoyer</span>
                          </button>
                          
                        </div>
                    </div>
                </form>
                <div id="success-message" style="display: none;">Message envoyé avec succès !</div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                $(document).ready(function(){
                  // Function to check if all fields are filled
                  function validateForm() {
                      var isValid = true;
                      $('#contact-form input[required], #contact-form textarea[required]').each(function() {
                          if ($(this).val() === '') {
                              isValid = false;
                              return false; // Stop the loop if a field is empty
                          }
                      });
                      return isValid;
                  }
              
                  // Handle form submission using AJAX
                  $('#submit-form').click(function() {
                      // Check if all fields are filled
                      if (validateForm()) {
                          // Serialize form data
                          var formData = $('#contact-form').serialize();
              
                          // Submit form data using AJAX
                          $.ajax({
                              type: 'POST',
                              url: '{{ route('home.store') }}',
                              data: formData,
                              success: function(response) {
                                  // Show success message
                                  $('#success-message').fadeIn();
                                  // Hide the success message after 5 seconds
                                  setTimeout(function(){
                                      $('#success-message').fadeOut();
                                  }, 5000);
                                  
                                  // Reset form fields
                                  $('#contact-form')[0].reset();
                              },
                              error: function(xhr, status, error) {
                                  // Show error message
                                  $('#error-message').fadeIn();
                                  // Hide the error message after 5 seconds
                                  setTimeout(function(){
                                      $('#error-message').fadeOut();
                                  }, 5000);
                              }
                          });
                      } else {
                          // Add shake effect to the button
                          $('#submit-form').addClass('shake');
                          
                          // Remove shake effect after 0.5 seconds
                          setTimeout(function() {
                              $('#submit-form').removeClass('shake');
                          }, 500);
                          
                          $('#error-message').fadeIn();
                         // Hide the error toast after 5 seconds
                          setTimeout(function(){
                           $('#error-message').fadeOut();
                           }, 5000);
                      }
                  });
              
                  // Prevent form submission from reloading the page
                  $('#contact-form').submit(function(event) {
                      event.preventDefault();
                  });
              });
            </script>              
            </div>
        </div>
    </div>
</div>
<style>
  .unique-button {
  display: flex;
  align-items: center;
  position: relative;
  width: 150px; /* Nouvelle largeur */
  height: 50px; /* Nouvelle hauteur */
  padding: 10px 20px; /* Nouveau padding */
  font-size: 16px; /* Nouvelle taille de police */
  text-decoration: none;
  color: #fff;
  background-color: #a634db;
  border: none;
  border-radius: 10px;
  overflow: hidden;
  cursor: pointer;
  transition: 0.3s all ease-in-out;
}

.unique-button:hover {
  transition: 0.3s all ease-in-out;
  box-shadow: 5px 10px 30px #a634db;
}

.unique-button span {
  display: block;
  margin-left: 0.3em;
  transition: all 0.3s ease-in-out;
}

.unique-button:hover span {
  transform: translateX(7em);
}

.unique-button:hover .svg-wrap {
  animation: fly-1 0.6s ease-in-out infinite alternate;
  z-index: 1;
}

.unique-button svg {
  display: block;
  transform-origin: center center;
  transition: transform 0.3s ease-in-out;
}

.unique-button:hover svg {
  transform: translateX(2.5em) rotate(45deg) scale(1.2);
}

.unique-button:active {
  transform: scale(0.95);
}

@keyframes fly-1 {
  from {
    transform: translateY(0.1em);
  }

  to {
    transform: translateY(-0.1em);
  }
}

.unique-button::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 0;
  height: 80%;
  border-bottom-left-radius: 60px;
  border-top-right-radius: 60px;
  border-top-left-radius: 20px;
  border-bottom-right-radius: 20px;
  background-color: #2c3e50;
  transition: all 0.2s ease-in-out;
}

.unique-button:hover::before {
  width: 100%;
}

.unique-button::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%;
  height: 0;
  border-bottom-left-radius: 20px;
  border-top-right-radius: 20px;
  border-top-left-radius: 60px;
  border-bottom-right-radius: 60px;
  background-color: #2c3e50;
  transition: all 0.3s ease-in-out;
}

.unique-button:hover::after {
  height: 100%;
}

  /* Styles spécifiques au formulaire */
    /* Style du formulaire */
    #contact-form {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Style des champs de saisie */
    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
        background-color: #f9f9f9;
    }

    /* Style du bouton Envoyer */
    #submit-form {
        background-color: #007bff;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    /* Style du bouton Envoyer au survol */
    #submit-form:hover {
        background-color: #0056b3;
    }

    .shake {
    animation: shake 0.5s;
}

@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
}


</style>


</div>


  </x-layout>
  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/animation.js') }}"></script>
  <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
  <script src="{{ asset('assets/js/templatemo-custom.js')}}"></script>


