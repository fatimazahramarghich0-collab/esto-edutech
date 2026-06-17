<!-- Modal structure -->
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStudentModalLabel">Ajouter un étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <div class="col">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dateNaissance" class="form-label">Date de naissance</label>
                        <input type="text" class="form-control" id="dateNaissance" name="dateNaissance">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col">
                            <label for="sellphone" class="form-label">Numero de téléphone</label>
                            <input type="text" class="form-control" id="sellphone" name="sellphone">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="codeApogee" class="form-label">Apogee</label>
                            <input type="text" class="form-control" id="codeApogee" name="codeApogee">
                        </div>
                        <div class="col">
                            <label for="CodeMassar" class="form-label">CNE</label>
                            <input type="text" class="form-control" id="CodeMassar" name="CodeMassar">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sector_id" class="form-label">Filière</label>
                        <select class="form-select" id="sector_id" name="sector_id">
                            @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
