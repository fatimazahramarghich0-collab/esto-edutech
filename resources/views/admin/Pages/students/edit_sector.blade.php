<!-- Modal structure -->
<div class="modal fade" id="modifySectorModal" tabindex="-1" aria-labelledby="modifySectorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifySectorModalLabel">Modifier la filière de l'étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label for="sector_id" class="form-label">Filière</label>
                        <select class="form-select" id="sector_id" name="sector_id">
                            @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}" {{ $student->sector_id == $sector->id ? 'selected' : '' }}>
                                {{ $sector->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>