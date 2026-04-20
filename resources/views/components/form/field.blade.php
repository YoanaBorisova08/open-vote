@props(['name', 'label' => null, 'placeholder' => '', 'type' => 'text', 'value' => ''])

<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block text-xs font-medium text-text-on-primary mb-1.5">{{ $label }}</label>
    @endif
    @if($type === "textarea")
        <textarea id="{{ $name }}" name="{{ $name }}"
                  class="w-full h-32 border border-border rounded-lg px-3 py-2 text-sm text-text bg-surface-light focus:outline-none focus:border-primary"
                  placeholder="{{ $placeholder }}"
                  required {{$attributes}}>{{ old($name, $value) }}</textarea>
    @else
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
           class="w-full h-10 border border-border rounded-lg px-3 text-sm text-text bg-surface-light focus:outline-none focus:border-primary"
           placeholder="{{ $placeholder }}"
           required {{$attributes}}/>
    @endif
    <x-form.error name="{{ $name }}"/>
</div>
