{{-- @props(['for'=>''])
<div class="signup-input-group">
    <label for="{{ $for }}" class="signup-label">{{ $slot }}</label>
    <input {{ $attributes }} />
    fas fa-envelope icon
</div> --}}
@props(['for'=>'', 'icon'=>''])
<div class="form-group">
    <input {{ $attributes }} />
    <label for="{{ $for }}">
        <i class="{{ $icon }}"></i> {{ $slot }}
    </label>
    <span class="input-line"></span>
</div>