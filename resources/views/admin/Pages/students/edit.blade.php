<!-- Modal structure -->
<div class="modal fade" id="modifyStudentModal" tabindex="-1" aria-labelledby="modifyStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyStudentModalLabel">Modifier les informations de l'étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <div class="col">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $student->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="codeApogee" class="form-label">Apogee</label>
                        <input type="text" class="form-control" id="codeApogee" name="codeApogee" value="{{ $student->codeApogee }}">
                    </div>
                    <div class="mb-3">
                        <label for="dateNaissance" class="form-label">Date de naissance</label>
                        <input type="text" class="form-control" id="dateNaissance" name="dateNaissance" value="{{ $student->dateNaissance }}">
                    </div>
                    <div class="mb-3">
                        <label for="sellphone" class="form-label">Numero de téléphone</label>
                        <input type="text" class="form-control" id="sellphone" name="sellphone" value="{{ $student->sellphone }}">
                    </div>

                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
