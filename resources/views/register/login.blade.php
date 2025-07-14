<x-layout class="login-page-body">
    <x-slot:title>Login | to-day</x-slot:title>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <a href="{{ route('home') }}" class="logo login-logo">
                    to-<span class="logo-accent">day</span>
                </a>
                <h2>Welcome Back!</h2>
                <p>Ready to conquer your tasks?</p>
            </div>

            <form action="{{ route('login') }}" method="POST" id="loginForm" class="login-form">
                @csrf
                <x-form-field for="email" icon="fas fa-envelope icon" type="email" id="email" name="email" required
                    autocomplete="email">Email Address</x-form-field>
                <x-error-message field="email"></x-error-message>

                <x-form-field for="password" icon="fas fa-lock icon" type="password" id="password" name="password"
                    required autocomplete="current-password">Password</x-form-field>
                <x-error-message field="password"></x-error-message>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Remember Me
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="login-button">
                    Log In <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-footer">
                <p>Don't have an account? <a href="{{ route('signupgo') }}" class="signup-link">Sign Up</a></p>
            </div>
        </div>
    </div>

    <!-- Subtle background elements -->
    <div class="shape-blob one"></div>
    <div class="shape-blob two"></div>
    <div class="shape-blob three"></div>

</x-layout>