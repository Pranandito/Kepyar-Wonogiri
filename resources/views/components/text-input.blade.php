@props(['disabled' => false, 'type' => 'text', 'name', 'value' => ''])

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
       {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>
