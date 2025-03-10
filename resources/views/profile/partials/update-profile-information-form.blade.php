<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="form-label">
                <i class="fas fa-user-circle me-2"></i>
                {{ __('Name') }}
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            @error('name')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">
                <i class="fas fa-envelope me-2"></i>
                {{ __('Email') }}
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-at"></i>
                </span>
                <input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            @error('email')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 ms-2">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save me-2"></i>
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ __('Profile updated successfully!') }}
                </div>
            @endif
        </div>
    </form>
</section>

<style>
.input-group {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.input-group-text {
    padding: 0.75rem 1rem;
    background: rgba(79, 70, 229, 0.05);
    color: var(--primary-color);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.input-group .form-control {
    border: none;
    padding-left: 0;
}

.input-group .form-control:focus {
    box-shadow: none;
}

.form-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
}

.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    color: #B45309;
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.btn-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.btn-link:hover {
    text-decoration: underline;
}
</style>
