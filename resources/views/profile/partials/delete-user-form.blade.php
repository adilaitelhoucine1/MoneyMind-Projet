<section>
    <div class="delete-account-section">
        <div class="warning-box">
            <i class="fas fa-exclamation-triangle warning-icon"></i>
            <p class="warning-text">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
            </p>
        </div>

        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="delete-account-btn"
        >
            <i class="fas fa-trash-alt me-2"></i>
            {{ __('Delete Account') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="modal-header">
                <div class="modal-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h2 class="modal-title">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
            </div>

            <p class="modal-description">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="form-group mt-6">
                <label for="password" class="form-label">
                    <i class="fas fa-key me-2"></i>
                    {{ __('Password') }}
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="form-control"
                        placeholder="{{ __('Enter your password') }}"
                    />
                </div>
                @error('password')
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-secondary" x-on:click="$dispatch('close')">
                    <i class="fas fa-times me-2"></i>
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

<style>
.delete-account-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 1rem;
    align-items: flex-start;
}

.warning-box {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: 0.5rem;
}

.warning-icon {
    color: #DC2626;
    font-size: 1.5rem;
}

.warning-text {
    color: #DC2626;
    margin: 0;
    font-size: 0.875rem;
}

.modal-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.modal-icon {
    width: 3rem;
    height: 3rem;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #DC2626;
    font-size: 1.5rem;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark-color);
    margin: 0;
}

.modal-description {
    color: var(--gray-color);
    margin: 0 0 1.5rem;
    font-size: 0.875rem;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-secondary {
    background: #F3F4F6;
    color: #374151;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-secondary:hover {
    background: #E5E7EB;
}

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

.delete-account-btn {
    background: var(--danger-gradient);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
    width: auto;
    min-width: 200px;
}

.delete-account-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(239, 68, 68, 0.3);
    background: linear-gradient(135deg, #DC2626, #B91C1C);
}

.delete-account-btn i {
    font-size: 1rem;
}
</style>
