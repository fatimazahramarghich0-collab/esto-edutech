<link rel="stylesheet" href="{{ asset('auth/form-checkbox-style.css') }}">
@props(['name'])

<div class="customCheckBoxHolder">

    <input name="{{ $name }}" type="checkbox" id="cCB1" class="customCheckBoxInput">
    <label for="cCB1" class="customCheckBoxWrapper">
        <div class="customCheckBox">
            <div class="inner">{{ $slot }}</div>
        </div>
    </label>

</div>
