<x-auth-shell title="Sign Up | to-day" heading="Create Your Account" subheading="Join to-day and start organizing your life!">
    <form action="{{ route('signupgo') }}" method="POST" id="signupForm" class="auth-form">
        @csrf

        <x-form-field name="firstName" type="text" icon="fas fa-user" required autocomplete="given-name">
            First Name
        </x-form-field>
        <x-error-message field="firstName"></x-error-message>

        <x-form-field name="lastName" type="text" icon="fas fa-user" required autocomplete="family-name">
            Last Name
        </x-form-field>
        <x-error-message field="lastName"></x-error-message>

        <x-form-field name="email" type="email" icon="fas fa-envelope" required autocomplete="email">
            Email Address
        </x-form-field>
        <x-error-message field="email"></x-error-message>

        <x-form-field name="password" type="password" icon="fas fa-lock" required autocomplete="new-password">
            Password
        </x-form-field>
        <x-error-message field="password"></x-error-message>

        <div class="auth-form-options auth-terms">
            <label class="auth-remember">
                <input type="checkbox" name="terms" required>
                I agree to the <a href="#" class="auth-inline-link">Terms &amp; Conditions</a>
            </label>
        </div>

        <button type="submit" class="cta-button auth-submit">
            Sign Up <i class="fas fa-arrow-right" aria-hidden="true"></i>
        </button>
    </form>

    <x-slot:footer>
        <p>Already have an account? <a href="{{ route('logingo') }}" class="auth-inline-link auth-inline-link--strong">Log In</a></p>
    </x-slot:footer>
</x-auth-shell>
