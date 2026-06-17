<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/images/logoest.png">
  <title>
    Admin | ESTO EDU-TECH
  </title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Autres balises meta, liens et scripts... -->
  <!-- Balise meta CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--     Fonts and icons     -->
  <link href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700') }}" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e39df68516.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <link href="{{asset('public.admin_style.Accueil.style.css')}}" rel="stylesheet"/>
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
  <!-- Inclusion de SweetAlert -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar')
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

      })
      calendar.render()
    })
  </script>

</head>



<body class="g-sidenav-show  bg-gray-100">
  <x-sidebar-admin />
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <x-navbarAdmin :pageName="'Tableau de bord'" :$user/>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Etudiants</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{$nbrStudents}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="fa-solid fa-graduation-cap text-lg opacity-10" aria-hidden="true"></i>                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Enseignants</p>
                    <h5 class="font-weight-bolder mb-0">
                     {{$nbrTeachers}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="fa-solid fa-chalkboard-user text-lg opacity-10" aria-hidden="true"></i>                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Matières</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{$nbrSubjects}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Messages</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">{{ $nombreMessagesLus }}</span> lus
                    <span class="font-weight-bold ms-1">{{ $nombreMessagesNonLus }}</span> non lus
                </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div id="messages-lus-container"></div>
                  <div class="dropdown float-lg-end pe-4">
                      <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                      </a>
                      <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                        <li><a class="dropdown-item border-radius-md"  id="del-read">Supprimer les messages lus</a></li>
                          <li><a class="dropdown-item border-radius-md"  id="supprimer-tous">Supprimer tous ! ❌</a></li>
                      </ul>
                  </div>
              </div>
              </div>
            </div>

            <script>
              $(document).ready(function() {
                  // Supprimer les messages lus
                  $('#del-read').click(function(e) {
                      e.preventDefault();
                      $.ajax({
                          url: "{{ route('messages.delete-read') }}",
                          type: "DELETE",
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          success: function(response) {
                              console.log(response); // Afficher la réponse dans la console
                              // Masquer visuellement les messages supprimés
                              $('.read-message').fadeOut();
                              alert('Tous les messages lus sont supprimés avec succès.');

                          },
                          error: function(xhr, status, error) {
                              console.error(xhr.responseText); // Afficher l'erreur dans la console
                              alert('Une erreur s\'est produite. Veuillez réessayer plus tard.');
                          }
                      });
                  });
              });
          </script>
            <script>
              // Attend que le DOM soit complètement chargé
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne les éléments du menu déroulant

    var supprimerTousLink = document.getElementById("supprimer-tous");
//-------------------------------------------------------------------------------------

    //------------------------------------------------------------------------------------
// Ajoutez un gestionnaire d'événements "click" au lien "Supprimer tous"
supprimerTousLink.addEventListener("click", function(event) {
    event.preventDefault();

    // Confirmation de la suppression
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer tous les messages ?");

    // Si l'utilisateur confirme la suppression
    if (confirmation) {
        // Récupérer le jeton CSRF à partir des métadonnées de la page
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Envoyer une requête AJAX DELETE pour supprimer tous les messages
        $.ajax({
            url: '{{ route("message.deleteAll") }}',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Inclure le jeton CSRF dans les en-têtes de la requête
            },
            success: function(response) {
                // Si la suppression est réussie, affichez un message de succès ou actualisez la page
                console.log(response.message);
                // Vous pouvez actualiser la page pour mettre à jour la liste des messages
                location.reload();
            },
            error: function(xhr, status, error) {
                // En cas d'erreur lors de la suppression, affichez un message d'erreur
                console.error("Une erreur s'est produite lors de la suppression des messages :", error);
            }
        });
    }
  });
});
            </script>
           {{-- Début du tableau --}}
           <div style="position: relative;">
            <p class="success-message" style="display: none; z-index: 999; position: absolute; top: -50px; right: 10px; background-color: #007bff; color: #fff; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 15px; width: 250px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
            </p>
        </div>

<div class="card-body px-0 pb-2">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom complet</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">E-mail</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date d'envoi</th>
          <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opération</th>
        </tr>
      </thead>
      <tbody id="corps-tableau-messages">
        @foreach ($messages as $message)
        <tr id="message-row-{{ $message->id }}" class="message-row">
          <td>
            <div class="px-2 py-1">
              <h6 class="mb-0 text-sm">{{ $message->name }} {{ $message->surname }}</h6>
            </div>
          </td>
          <td>
            <div class="mt-2">
              <span class="text-xs">{{ $message->email }}</span>
            </div>
          </td>
          <td class="align-middle text-center text-sm">
            <span class="text-xs font-weight-bold">{{ $message->created_at->format('d F Y') }}</span>
          </td>
          <td class="text-center">
            <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
              @method('DELETE')
              @csrf
              <!-- Bouton pour supprimer -->
              <a href="#" class="delete-button" data-id="{{ $message->id }}">
                <i class="fas fa-trash-alt"></i> <!-- Icône de la corbeille -->
              </a>
            </form>
            <style> .delete-button {
              color: #333; /* Couleur initiale du lien */
              transition: color 0.3s ease, transform 0.3s ease; /* Effet de transition pour la couleur et le zoom */
              text-decoration: none; /* Supprimer le soulignement du lien */
          }
      
          .delete-button:hover {
              color: red; /* Couleur rouge au survol */
              transform: scale(1.2); /* Zoom au survol */
          }

    
              .marquer-lu {
                  background-color: transparent;
                  border: none;
                  cursor: pointer;
                  padding: 0;
                  transition: transform 0.3s ease; /* Effet de transition */
              }
          
              .marquer-lu i {
                  font-size: 20px; /* Taille de l'icône */
                  color: #333; /* Couleur initiale de l'icône */
              }
          
              .marquer-lu:hover i {
                  color: green; /* Couleur de l'icône au survol */
              }
          
              .marquer-lu:hover {
                  transform: scale(1.2); /* Zoom au survol */
              }
          </style>
            <div>

              {{-- <p class="message {{ $message->estLu ? 'message-lu' : '' }}">{{ $message->message }}</p> --}}
             
                  <form action="{{ route('marquerLu', $message->id) }}" method="POST">
                      @csrf
                      <button class="marquer-lu" data-message-id="{{ $message->id }}" type="submit"><i class="fa-solid fa-eye"></i></button>
                  </form>
             
          </div> 

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{-- Fin du tableau --}}

            <hr>
            <div>
              {{ $messages->links() }}
            </div>
            {{-- Fin du tableau --}}
          </div>
        </div>
        <!-- Affichage du calendrier -->

        <div class="col-lg-4 col-md-6">
          <div class="card h-100 d-flex flex-column">
            <div class="card-header pb-0">
              <h6>Calendrier</h6>
            </div>
            <div class="card-body p-3 flex-grow-1" style="max-height: 600px;">
              <div id="calendar" class="h-100"></div>
            </div>
          </div>
        </div>
        <!-- Fin de l'affichage du calendrier -->

      </div>
      <!-- footer -->
      <x-footerAdmin />
      <!-- footer -->
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

  <script type="text/javascript">
    // Fonction pour supprimer un message
    function deleteMessage(messageId) {
      $.ajax({
        url: '/admin/messages/' + messageId + '/delete', // Route pour la suppression
        type: 'DELETE', // Utiliser DELETE
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          // Si la suppression réussit, supprime la ligne de la table avec un effet de disparition
          $('#message-row-' + messageId).fadeOut(500, function() {
            $(this).remove();
          });
          // Affiche une notification de suppression réussie
          Swal.fire({
            title: 'Supprimé!',
            text: 'Le message a été supprimé avec succès.',
            icon: 'success',
            timer: 1500 // Ferme automatiquement après 1,5 seconde
          });
        },
        error: function(xhr, status, error) {
          // En cas d'erreur, affiche un message d'erreur
          Swal.fire({
            title: 'Erreur!',
            text: 'Une erreur est survenue lors de la suppression du message.',
            icon: 'error'
          });
        }
      });
    }

    $(document).ready(function() {
      // Gérer le clic sur le bouton de suppression
      $(document).on('click', '.delete-button', function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien

        var messageId = $(this).data('id'); // Récupère l'ID du message à supprimer

        // Affiche une boîte de confirmation personnalisée
        Swal.fire({
          title: 'Êtes-vous sûr?',
          text: "Vous ne pourrez pas revenir en arrière!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Oui, supprimer',
          cancelButtonText: 'Annuler'
        }).then((result) => {
          if (result.isConfirmed) {
            // Si l'utilisateur confirme la suppression, appeler la fonction de suppression
            deleteMessage(messageId);
          }
        });
      });
    });

  </script>
  <script>
$(document).ready(function() {
    $('.marquer-lu').on('click', function(event) {
        event.preventDefault();

        var messageId = $(this).data('message-id');

        $.ajax({
            url: '/admin/messages/' + messageId + '/marquer-lu',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('.success-message').html('<br>' + response.message).show();

                var nombreMessagesLus = parseInt($('#nombre-messages-lus').text()) + 1;
                $('#nombre-messages-lus').text(nombreMessagesLus);

                $('.success-message').append('<span class="close-message" style="position: absolute; top: 0; right: 0; cursor: pointer;color:red;font-size:20px;">&#10006;</span>');
            },
            error: function(xhr, status, error) {
                alert('Une erreur s\'est produite : ' + error);
            }
        });
    });

    $(document).on('click', '.close-message', function() {
        $('.success-message').hide();
    });
});

</script>
</body>

</html>
