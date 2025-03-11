<!-- 
    Form-Input-Textarea
    (Anonymous component: no associated class in app/view/components - Blade Template only) 
-->

@props([
    'name',
    'label' => null,
    'placeholder' => '...',
    'required' => false,
    'value' => null  // Accept an optional default value
])

<fieldset class="fieldset mb-2 p-2">
    @if ($label)
        <legend class="fieldset-legend">{{ $label }}</legend>
    @endif
    <textarea 
        {{ $attributes->merge(['class' => 'textarea textarea-accent h-24 w-full']) }}
        id="{{ $name }}" name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        @if ($required) required @endif
    >{{ old($name, $value) }}</textarea> {{-- Use old() first, fallback to provided value --}}
    @error($name)
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
</fieldset>