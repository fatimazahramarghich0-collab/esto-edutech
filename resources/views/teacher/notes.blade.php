<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoest.png') }}">
    <title>Les Notes</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    <x-teacher.sidebar :user="$user" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbar-teacher :pageName="'Notes'" :user="$user" />
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="card-body pt-sm-3 pt-0">
                        <div class="d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" id="search-input" class="form-control" placeholder="Rechercher l'étudiant...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-body pt-sm-3 pt-0">
                        <div class="d-flex align-items-center">
                            <select id="subject-select" class="form-select">
                                <option value="">Selectionner votre classe :</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <form id="notes-form">
                                    @csrf
                                    <input type="hidden" id="subject-id" name="subject_id" value="">
                                    <div id="table-container">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Etudiant</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Apogee</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de naissance</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note Examen</th>
                                            </tr>
                                        </thead>
                                        <tbody id="students-tbody">
                                            <!-- Students will be fetched and displayed here -->
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="d-flex justify-content-end m-2">
                                        <button type="submit" class="btn btn-primary" style="display: none" id="save-notes-btn">Enregistrer les notes</button>
                                        <div class="ms-5"></div> 
                                        <button type="button" class="btn btn-secondary ml-2" onclick="printTable()">Imprimer</button>
                                    </div>
                                    <div id="success-message" class="alert alert-success" style="display: none;">
                                        Notes enregistrées avec succès !
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-footerAdmin />
        </div>
    </main>
    <style>
        /* Cacher tous les éléments sauf le tableau lors de l'impression */
            /* Cacher tous les éléments sauf le tableau lors de l'impression */
    @media print {
        body * {
            visibility: hidden;
        }
        #table-container, #table-container * {
            visibility: visible;
        }
    }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const subjectSelect = document.getElementById('subject-select');
            const studentsTbody = document.getElementById('students-tbody');
            const subjectIdInput = document.getElementById('subject-id');
            const saveNotesButton = document.getElementById('save-notes-btn'); // Cibler le bouton
    
            // Afficher ou masquer le bouton en fonction de la sélection de la classe
            subjectSelect.addEventListener('change', function() {
                subjectIdInput.value = subjectSelect.value;
    
                if (subjectSelect.value) {
                    console.log('Option sélectionnée :', subjectSelect.value);
                    saveNotesButton.style.display = 'inline-block'; // Afficher le bouton
                } else {
                    console.log('Aucune option sélectionnée');
                    saveNotesButton.style.display = 'none'; // Masquer le bouton
                }
    
                fetchStudents(); // Appeler la fonction pour récupérer les étudiants une fois la classe sélectionnée
            });
    
            searchInput.addEventListener('input', function() {
                fetchStudents();
            });
    
            function fetchStudents() {
                const query = searchInput.value;
                const subjectId = subjectSelect.value;
    
                if (!subjectId) {
                    studentsTbody.innerHTML = '<tr><td colspan="6" class="text-center">Prière de choisir la classe</td></tr>';
                    return;
                }
    
                fetch(`{{ route('Listsearch') }}?query=${query}&subject_id=${subjectId}`)
                    .then(response => response.json())
                    .then(data => {
                        studentsTbody.innerHTML = data;
                        // Recharger les données sauvegardées
                        loadSavedNotes();
                    });
            }
    
            // Charger les données sauvegardées depuis le stockage local
            function loadSavedNotes() {
                const savedNotes = JSON.parse(localStorage.getItem('savedNotes'));
                if (savedNotes) {
                    const noteInputs = document.querySelectorAll('.form-control-sm');
                    noteInputs.forEach(input => {
                        const parts = input.name.split('][');
                        const studentId = parts[0].replace('exam_note[', '');
                        const examId = parts[1].replace(']', '');
                        if (savedNotes[studentId] && savedNotes[studentId][examId]) {
                            input.value = savedNotes[studentId][examId];
                        }
                    });
                }
            }
    
            // Sauvegarder les notes dans le stockage local
            function saveNotesToLocal(notes) {
                localStorage.setItem('savedNotes', JSON.stringify(notes));
            }
    
            // Fonction de traitement des notes
  // Fonction de traitement des notes
function saveNotes() {
    console.log('Début de la sauvegarde des notes...');

    const noteInputs = document.querySelectorAll('.form-control-sm');
    console.log('Nombre de champs de notes trouvés :', noteInputs.length);

    const notes = {};
    let hasError = false; // Déclaration de la variable pour suivre si une erreur est détectée

    noteInputs.forEach(input => {
        const parts = input.name.split('][');
        const studentId = parts[0].replace('exam_note[', '');
        const examId = parts[1].replace(']', '');
        const note = parseFloat(input.value);

        console.log('Étudiant ID:', studentId, 'Examen ID:', examId, 'Note:', note);

        // Vérifier si la note est valide
        if (note < 0 || note > 20 || isNaN(note)) {
            console.error('Note invalide pour l\'étudiant', studentId, 'dans l\'examen', examId);
            hasError = true;
            // Afficher le message d'erreur sous le champ de saisie
            const errorMessage = input.nextElementSibling;
            errorMessage.textContent = 'La note doit être un nombre entre 0 et 20.';
            // Ajoutez ici du code pour marquer visuellement le champ de note comme invalide si nécessaire
        } else {
            if (!notes.hasOwnProperty(studentId)) {
                notes[studentId] = {};
            }
            notes[studentId][examId] = note;
        }
    });

    if (hasError) {
        // Afficher un message d'erreur global
        console.error('Des notes invalides ont été détectées. Veuillez vérifier et corriger les champs de note.');
        return; // Arrêter la sauvegarde si des erreurs sont détectées
    }

    console.log('Données des notes à envoyer au serveur :', notes);

    fetch('{{ route("saveLesNotes") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(notes)
    })
    .then(response => {
        if (response.ok) {
            console.log('Notes enregistrées avec succès !');
            // Sauvegarder les données dans le stockage local
            saveNotesToLocal(notes);

            // Afficher le message de succès
            const successMessage = document.getElementById('success-message');
            successMessage.style.display = 'block';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000); // Masquer le message après 3 secondes

            // Ajoutez ici tout code de gestion supplémentaire si nécessaire
        } else {
            console.error('Une erreur s\'est produite lors de l\'enregistrement des notes.');
        }
    })
    .catch(error => {
        console.error('Erreur lors de l\'envoi de la requête AJAX :', error);
    });
}

    
            // Initialiser les événements
            saveNotesButton.addEventListener('click', function(event) {
                event.preventDefault();
                saveNotes();
            });
    
            // Charger les données sauvegardées au chargement de la page
            loadSavedNotes();
        });
        function printTable() {
            window.print();
        }
    </script>
    
</body>

</html>
