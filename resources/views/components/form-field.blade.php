{{--
    Shared auth form field: floating-label text input with an animated
    underline. Used by the login and signup forms.

    Mechanism: the label is raised by CSS via :focus and
    :not(:placeholder-shown), which is why every rendered input carries
    placeholder=" " here — call sites must not override it with real
    placeholder text (the label IS the placeholder). Validation state is
    read from $errors so the input announces itself to assistive tech and
    points at its error message (rendered by <x-error-message> with the
    matching id "{id}-error").

    Password inputs are never repopulated from old() input.
--}}
@props([
    'name',
    'icon' => '',
    'type' => 'text',
])

@php
    $fieldId = $attributes->get('id', $name);
    $hasError = $errors->has($name);
@endphp

<div class="form-group{{ $hasError ? ' form-group--error' : '' }}">
    <input
        type="{{ $type }}"
        id="{{ $fieldId }}"
        name="{{ $name }}"
        placeholder=" "
        @if ($type !== 'password' && old($name) !== null) value="{{ old($name) }}" @endif
        @if ($hasError) aria-invalid="true" aria-describedby="{{ $fieldId }}-error" @endif
        {{ $attributes->except('id') }}
    />
    <label for="{{ $fieldId }}">
        @if ($icon)<i class="{{ $icon }}" aria-hidden="true"></i>@endif
        {{ $slot }}
    </label>
    <span class="input-line" aria-hidden="true"></span>
</div>
