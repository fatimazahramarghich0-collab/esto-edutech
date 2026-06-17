<!-- Modal structure -->
<div class="modal fade" id="importStudentModal" tabindex="-1" aria-labelledby="importStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importStudentModalLabel">Importer le fichier des étudiants</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('students.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="sector_id" class="form-label">Filière</label>
                        <select class="form-select" id="sector_id" name="sector_id" required>
                            @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Importer le fichier CSV</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <div class="mb-3">
                        <p class="text-secondary text-xs">*Prière d'importer un fichier qui respecte les colonnes suivantes: Nom, e-mail, Date de naissance, Mot de passe, Massar, Apogee, Numéro de téléphone, Lien vers la photo</p>
                    </div>
                    <button type="submit" class="btn bg-gradient-primary w-100 px-3 mb-2 active">Importer CSV</button>

                </form>
            </div>
        </div>
    </div>
</div>