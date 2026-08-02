@extends('back.layouts.mzk-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Le titre Ici')
@section('content')
    
<div class="container container-tight py-4">
        
        <form class="card card-md" action="{{ route('admin.send_password_reset_link') }}" method="POST" id="forgotForm">
             
        @csrf
          <div class="card-body">
            <x-form-alerts></x-form-alerts>
            <h2 class="card-title text-center mb-4">{{ __('Mot de passe oublié') }}</h2>
            <p class="text-secondary mb-4">{{ __('Saisissez votre adresse e-mail et votre mot de passe sera réinitialisé et vous sera envoyé par e-mail.') }}</p>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" placeholder="Votre Email">
            </div>
             @error('email')
                <span class="text-danger mt-2 ml-1">{{ $message }}</span>
                @enderror

            {{-- <div class="form-footer">
              <a href="{{ route('admin.send_password_reset_link') }}" class="btn btn-primary w-100"
              onclick="event.preventDefault();document.getElementById('forgotForm').submit();">
                <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path><path d="M3 7l9 6l9 -6"></path></svg>
                Send me new password
              </a>
              {{-- <button type="submit">Ok</button> --}}
            {{-- </div> --}} 

                <div class="form-footer">
    <button type="submit" class="btn btn-primary w-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
             fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
            <path d="M3 7l9 6l9 -6"></path>
        </svg>
       Envoyez-moi un nouveau mot de passe
    </button>
</div>
          </div>
        </form>
        <div class="text-center text-secondary mt-3">
          Laissez tomber, <a href="{{ route('admin.login') }}">renvoyez-moi</a> à l'écran de connexion.
        </div>
      </div>
    
@endsection