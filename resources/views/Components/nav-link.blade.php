@props(['routeName', 'buttonName', 'login' => false])

@if(Route::is('home') && $login == false)
        <a href="#{{ $buttonName }}" class="{{ Route::is('home') ? 'active' : '' }}"> {{ $slot }}</a>
    @elseif(Route::is('home') && $login == true)
        <a href="{{ route('login') }}" class="{{ Route::is('home') ? 'active' : '' }}"> {{ $slot }}</a>
    @elseif($routeName === 'login' && $login)
        <span></span>
@else
        <a href="{{ route('home') }}#{{ $buttonName }}"> {{ $slot }} </a>
@endif
