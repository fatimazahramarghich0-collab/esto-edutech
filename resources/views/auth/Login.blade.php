<x-layout title="Login">

    <link rel="stylesheet" href="{{ asset('auth/login-style.css') }}"/>

    <form id="form_id" method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="form">
            <div class="title title2">Login</div>
            <div class="input-container ic1">
                <input id="email" name="email" class="input" value="{{ old('email') }}" type="email" placeholder=""
                       required/>
                <div class="cut"></div>
                <label for="email" class="placeholder">Email</label>
            </div>
            <x-form-error name="email"></x-form-error>
            <div class="input-container ic2">
                <input id="password" name="password" class="input" type="password" placeholder="" required/>
                <div class="cut"></div>
                <label for="password" class="placeholder">Password</label>
            </div>
            <x-form-error name="password"></x-form-error>
            <x-form-checkbox name="remember">Remember Me</x-form-checkbox>
            <x-form-submit>Se Connecter</x-form-submit>
        </div>
    </form>


</x-layout>
