<div class="modal fade" id="createLoadModal" tabindex="-1" aria-labelledby="createLoadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLoadModalLabel">Ajouter une nouvelle charge horaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST" action="{{ route('hourlyloads.store') }}" enctype="multipart/form-data" id="create-load-form">
                    @csrf

                    <div class="row mb-3">
                        <div class="col">
                            <label for="subject_id" class="form-label">Matière</label>
                            <select class="form-select" id="subject_id" name="subject_id" required>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cm" class="form-label">CM (heures)</label>
                            <input type="number" class="form-control" id="cm" name="cm">
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">TD (heures)</label>
                            <input type="number" class="form-control" id="td" name="td">
                        </div>
                        <div class="col">
                            <label for="tp" class="form-label">TP (heures)</label>
                            <input type="number" class="form-control" id="tp" name="tp">
                        </div>
                    </div>

                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
