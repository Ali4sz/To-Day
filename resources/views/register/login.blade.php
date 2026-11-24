<x-auth-shell title="Login | to-day" heading="Welcome Back!" subheading="Ready to conquer your tasks?">
    <form action="{{ route('login') }}" method="POST" id="loginForm" class="auth-form">
        @csrf

        <x-form-field name="email" type="email" icon="fas fa-envelope" required autocomplete="email">
            Email Address
        </x-form-field>
        <x-error-message field="email"></x-error-message>

        <x-form-field name="password" type="password" icon="fas fa-lock" required autocomplete="current-password">
            Password
        </x-form-field>
        <x-error-message field="password"></x-error-message>

        <div class="auth-form-options">
            <label class="auth-remember">
                <input type="checkbox" name="remember">
                Remember Me
            </label>
            <a href="#" class="auth-inline-link">Forgot Password?</a>
        </div>

        <button type="submit" class="cta-button auth-submit">
            Log In <i class="fas fa-arrow-right" aria-hidden="true"></i>
        </button>
    </form>

    <x-slot:footer>
        <p>Don't have an account? <a href="{{ route('signupgo') }}" class="auth-inline-link auth-inline-link--strong">Sign Up</a></p>
    </x-slot:footer>
</x-auth-shell>
