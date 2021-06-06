@php
if(!isset($id)) {
    $id = '';
}

if(!isset($inputClass)) {
    $inputClass = '';
}

if(!isset($labelClass)) {
    $labelClass = '';
}

if(!isset($readOnly)) {
    $readOnly = false;
} else {
    $readOnly = (bool) $readOnly;
}
@endphp

<div>
    <label class="{{ $labelClass }}" for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" class="form-control {{ $inputClass }}" {{ $id ? "id=$id" : '' }} name="{{ $name }}" value='{{ old($name, $value) }}' {{ $readOnly ? 'readOnly' : '' }}/>
    @include('common.errors', ['errors' => $errors->get($name)])
</div>
