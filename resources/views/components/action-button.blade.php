@php
    // Variables: $id (optional), $type (optional, default 'button'), $text (required), $class (optional), $attrs (optional raw attrs string)
    $btnType = $type ?? 'button';
    $btnClass = $class ?? 'bg-[#15395c] text-white px-6 py-2 rounded-full border border-[#15395c] hover:bg-[#1c4974] hover:border-[#1c4974] transition';
@endphp

<button
    type="{{ $btnType }}"
    @if(!empty($id)) id="{{ $id }}" @endif
    class="{{ $btnClass }}"
    @if(!empty($attrs)) {!! $attrs !!} @endif
    @if(isset($onclick)) onclick="{!! $onclick !!}" @endif
>
    {{ $text ?? '' }}
</button>
