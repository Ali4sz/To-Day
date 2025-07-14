<x-layout class="login-page-body">
    <x-slot:title>Sign Up | to-day</x-slot:title>

    <div class="login-container">

        <div class="signup-card">

            <div class="login-header">

                <a href="{{ route('home') }}" class="logo login-logo">

                    to-<span class="logo-accent">day</span>
                </a>
                <h2>Create Your Account</h2>
                <p>Join to-day and start organizing your life!</p>
            </div>

            <form action="{{ route('signupgo') }}" method="POST" id="signupForm" class="login-form signup-form">
                @csrf
                <!-- Reusing login-form, adding signup-form -->
                <x-form-field for="firstName" icon="fas fa-user icon" type="text" id="firstName" name="firstName"
                    required autocomplete="name">First Name</x-form-field>
                <x-error-message field="firstName"></x-error-message>

                <x-form-field for="lastName" icon="fas fa-user icon" type="text" id="lastName" name="lastName" required
                    autocomplete="name">Last Name</x-form-field>
                <x-error-message field="lastName"></x-error-message>

                <x-form-field for="email" icon="fas fa-envelope icon" type="text" id="email" name="email" required
                    autocomplete="email">Email Address</x-form-field>
                <x-error-message field="email"></x-error-message>

                <x-form-field for="password" icon="fas fa-lock icon" type="password" id="password" name="password"
                    required autocomplete="new-password">Password</x-form-field>
                <x-error-message field="password"></x-error-message>



                <div class="form-options terms-agreement">
                    <label class="remember-me">
                        <!-- Re-using for structure, adjust text or class if needed -->
                        <input type="checkbox" name="terms" required />
                        I agree to the
                        <a href="#" class="inline-link">&nbsp Terms & Conditions</a>
                    </label>
                </div>

                <button type="submit" class="login-button">

                    Sign Up <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-footer">

                <p>
                    Already have an account?
                    <a href="{{ route('logingo') }}" class="signup-link">Log In</a>
                </p>

            </div>
        </div>
    </div>

    <div class="shape-blob one"></div>
    <div class="shape-blob two"></div>
    <div class="shape-blob three"></div>
</x-layout>