<div class="card-body p-3">
    <a href="{{ route('department') }}">
        <div class="flecha_div">
            <img class="flecha-edit-img" src="{{ asset('admin_style/images/flecha-correcta.png') }}" alt="Retourner">
            <span class="text_retour">Retour</span>
        </div>

        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
    </a>


    <ul class="list-group">
        <form action="{{ route('department.store') }}" method="POST" class="needs-validation"
              novalidate>
            @csrf
            <!-- Input for Name -->
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name"
                       class="form-control" required>
                <x-form-error class="alert-message color-red" name="name"></x-form-error>
            </div>

            <!-- Input for cheDep -->
            <div class="form-group">
                <label for="chefDep">Chef Département:</label>
                <select class="form-control" name="chefDep">
                    <option value="" selected disabled>Sélectionner un enseignant</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </ul>
</div>
