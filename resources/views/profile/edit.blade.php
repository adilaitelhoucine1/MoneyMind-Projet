@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
<style>
    .profile-container {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: calc(100vh - var(--topbar-height));
        padding: 2rem;
    }

    .user-info-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .user-info-header {
        background: var(--primary-gradient);
        padding: 2rem;
        color: white;
        text-align: center;
        position: relative;
    }

    .user-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        margin: 0 auto 1rem;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--primary-color);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .user-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .user-email {
        font-size: 1rem;
        opacity: 0.9;
        color:rgb(18, 14, 14)
    }

    .user-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        padding: 1.5rem;
        background: white;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        border-radius: 0.5rem;
        background: rgba(79, 70, 229, 0.05);
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--gray-color);
    }

    .profile-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 2rem;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .profile-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .profile-icon {
        width: 3rem;
        height: 3rem;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .profile-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
    }

    .profile-description {
        font-size: 0.875rem;
        color: var(--gray-color);
        margin: 0;
    }

    .profile-content {
        padding: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);
    }

    .btn-danger {
        background: var(--danger-gradient);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
    }

    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="max-w-7xl mx-auto">
        @if (session('success'))
            <div class="alert alert-success mb-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mb-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- User Information Card -->
        <div class="user-info-card">
            <div class="user-info-header">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </div>
            <div class="user-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ Auth::user()->created_at->format('M Y') }}</div>
                    <div class="stat-label">Member Since</div>
                </div>
          
                <div class="stat-item">
                    <div class="stat-value">{{ Auth::user()->role}}</div>
                    <div class="stat-label">Account Type</div>
                </div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h2 class="profile-title">Profile Information</h2>
                    <p class="profile-description">Update your account's profile information and email address.</p>
                </div>
            </div>
            <div class="profile-content">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password Update -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h2 class="profile-title">Update Password</h2>
                    <p class="profile-description">Ensure your account is using a long, random password to stay secure.</p>
                </div>
            </div>
            <div class="profile-content">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <div>
                    <h2 class="profile-title">Delete Account</h2>
                    <p class="profile-description">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                </div>
            </div>
            <div class="profile-content">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
