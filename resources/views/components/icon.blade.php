<!-- Google Material Icon Component -->
@props(['img'])
<i {{ $attributes->merge(['class' => 'material-icons']) }}>{{ strtolower($img) }}</i>