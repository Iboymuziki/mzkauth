@extends('back.layouts.mzk-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Le titre Ici')
@section('content')

    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>
            <form action="{{ route('admin.login_handler') }}" method="POST">

                <x-form-alerts></x-form-alerts>

                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Email address') }}</label>
                    <input type="text" name="login_id" class="form-control" placeholder="your@email.com"
                        value="{{ old('login_id') }}">
                    @error('login_id')
                        <span class="text-danger mt-2 ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-flat">
                        <input type="password" id="password-input" name="password" class="form-control"
                            placeholder="Your password" autocomplete="off">

                        <span class="input-group-text">
                            <span id="toggle-password" class="link-secondary"
                                title="Show password" style="cursor: pointer; user-select: none;">

                                {{-- Eye icon (password masqué) --}}
                                <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>

                                {{-- Eye-off icon (password visible) --}}
                                <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" class="icon d-none" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
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
                    @error('password')
                        <span class="text-danger mt-2 ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-check">
                        <span class="form-label-description">
                            <a href="{{ route('admin.forgot') }}">I forgot password</a>
                        </span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        const input = document.getElementById('password-input');
        const iconEye    = document.getElementById('icon-eye');
        const iconEyeOff = document.getElementById('icon-eye-off');

        if (input.type === 'password') {
            input.type = 'text';
            iconEye.classList.add('d-none');
            iconEyeOff.classList.remove('d-none');
        } else {
            input.type = 'password';
            iconEye.classList.remove('d-none');
            iconEyeOff.classList.add('d-none');
        }
    });
</script>
@endpush


