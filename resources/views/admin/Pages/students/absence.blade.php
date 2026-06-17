<div class="modal fade" id="absencesModal" tabindex="-1" aria-labelledby="absencesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="absencesModalLabel">Absences de {{ $student->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Total des absences: {{ $totalAbsences }}</strong>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom de la matière</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date d'absence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->absence as $absence)
                            <tr>
                                <td class="text-xs font-weight-bold mb-0">{{ $absence->subject->name }}</td>
                                <td class="text-xs font-weight-bold mb-0">{{ $absence->dateAbsence }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
