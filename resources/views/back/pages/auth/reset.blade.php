@extends('back.layouts.mzk-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Le titre Ici')
@section('content')

    <form class="card card-md" action="{{ route('admin.reset_password_handler',['token'=>$token]) }}" method="POST">

         <x-form-alerts></x-form-alerts>
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Rénitialisation de Mot de Passe') }}</h2>

            <div class="mb-3">
                <label class="form-label">{{ __('Nouveau mot de passe') }}</label>
                <div class="input-group input-group-flat">
                    <input type="password" id="password-new" name="new_password" class="form-control"
                        placeholder="Password" autocomplete="off">
                    <span class="input-group-text">
                        <span class="link-secondary toggle-password" data-target="password-new"
                            style="cursor: pointer; user-select: none;">
                            {{-- Eye (masqué) --}}
                            <svg class="icon icon-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                            {{-- Eye-off (visible) --}}
                            <svg class="icon icon-eye-off d-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 3l18 18" />
                                <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" />
                                <path d="M9.363 5.365A9.466 9.466 0 0 1 12 5c3.6 0 6.6 2 9 6c-.82 1.37 -1.716 2.505 -2.669 3.395" />
                                <path d="M6.487 6.487C4.954 7.482 3.584 8.972 2.451 11c2.4 4 5.4 6 9 6a9.31 9.31 0 0 0 4.65 -1.25" />
                            </svg>
                        </span>
                    </span>
                </div>
                  @error('new_password')
                        <span class="text-danger mt-2 ml-1">{{ $message }}</span>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Comfirmer le Nouveau mot de passe') }}</label>
                <div class="input-group input-group-flat">
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control"
                        placeholder="Password" autocomplete="off">
                    <span class="input-group-text">
                        <span class="link-secondary toggle-password" data-target="password-confirm"
                            style="cursor: pointer; user-select: none;">
                            {{-- Eye (masqué) --}}
                            <svg class="icon icon-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                            {{-- Eye-off (visible) --}}
                            <svg class="icon icon-eye-off d-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 3l18 18" />
                                <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" />
                                <path d="M9.363 5.365A9.466 9.466 0 0 1 12 5c3.6 0 6.6 2 9 6c-.82 1.37 -1.716 2.505 -2.669 3.395" />
                                <path d="M6.487 6.487C4.954 7.482 3.584 8.972 2.451 11c2.4 4 5.4 6 9 6a9.31 9.31 0 0 0 4.65 -1.25" />
                            </svg>
                        </span>
                    </span>
                </div>
                  @error('password_confirmation')
                        <span class="text-danger mt-2 ml-1">{{ $message }}</span>
                    @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{ __('Réinitialiser le mot de passe') }}</button>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            const targetId = this.dataset.target;
            const input    = document.getElementById(targetId);
            const eyeOn    = this.querySelector('.icon-eye');
            const eyeOff   = this.querySelector('.icon-eye-off');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOn.classList.add('d-none');
                eyeOff.classList.remove('d-none');
            } else {
                input.type = 'password';
                eyeOn.classList.remove('d-none');
                eyeOff.classList.add('d-none');
            }
        });
    });
</script>
@endpush