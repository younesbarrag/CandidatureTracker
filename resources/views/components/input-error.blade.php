@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[11px] text-rose-600 font-bold space-y-0.5 mt-1 ml-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
