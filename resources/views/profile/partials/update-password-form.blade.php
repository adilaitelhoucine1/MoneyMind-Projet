<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="form-label">
                <i class="fas fa-key me-2"></i>
                {{ __('Current Password') }}
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            </div>
            @error('current_password')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password" class="form-label">
                <i class="fas fa-key me-2"></i>
                {{ __('New Password') }}
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
            </div>
            @error('password')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation" class="form-label">
                <i class="fas fa-key me-2"></i>
                {{ __('Confirm Password') }}
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            </div>
            @error('password_confirmation')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save me-2"></i>
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ __('Password updated successfully!') }}
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
</style>
