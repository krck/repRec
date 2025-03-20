<!-- 
    Form-Input-Select
    (Anonymous component: no associated class in app/view/components - Blade Template only) 
-->

@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,  // Selected value for edit forms
    'key' => 'id',  // Key used for option values (for DB collections)
    'text' => 'name'  // Text used for display (for DB collections)
])

<fieldset class="fieldset mb-1 p-1">
    @if ($label)
        <legend class="fieldset-legend">{{ $label }}</legend>
    @endif

    <select {{ $attributes->merge(['class' => 'select select-accent w-full']) }}
            id="{{ $name }}" name="{{ $name }}">
        @foreach ($options as $option)
            @php
                // If options are associative (hardcoded array), use key as value and text as label
                $optionValue = is_array($option) ? $option[$key] : (is_object($option) ? $option->$key : $option);
                $optionText = is_array($option) ? $option[$text] : (is_object($option) ? $option->$text : $option);
            @endphp
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                {{ $optionText }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
</fieldset>
