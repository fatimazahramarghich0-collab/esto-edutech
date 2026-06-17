<div class="modal fade" id="semesterGradesModal" tabindex="-1" aria-labelledby="semesterGradesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="semesterGradesModalLabel">Notes de {{ $student->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semestre</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->semestreGrade as $semesterGrade)
                            <tr>
                                <td class="text-xs font-weight-bold mb-0">{{ $semesterGrade->semester->semesterName }}</td>
                                <td class="text-xs font-weight-bold mb-0">{{ $semesterGrade->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
