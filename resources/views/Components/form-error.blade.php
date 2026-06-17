@props(['name'])

@error($name)
<span {{ $attributes->merge(['class' => 'error']) }}> {{ $message }}</span>
@enderror

