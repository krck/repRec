<!-- 
    Form-Input-Text
    (Anonymous component: no associated class in app/view/components - Blade Template only) 
-->

@props([
    'name',
    'label' => null,
    'placeholder' => '...',
    'required' => false,
    'value' => null  // Accept an optional default value
])

<fieldset class="fieldset mb-1 p-1">
    @if ($label)
        <legend class="fieldset-legend">{{ $label }}</legend>
    @endif 
    <input
        {{ $attributes->merge(['class' => 'input input-accent w-full']) }} 
        type="text" id="{{ $name }}" name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if ($required) required @endif
        value="{{ old($name, $value) }}"   
    />
    <!-- Use old() first, fallback to provided value 
        - old('field_name'): Helper function to retrieve the old input value in case of validation errors.
        - error('field_name'): Blade directive to display the error message for the given field.

        If validation fails, Laravel will redirect back to the form and display the error messages automatically -->
    @error($name)
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
</fieldset>
