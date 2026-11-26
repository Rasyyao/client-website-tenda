@props(['number' => null])

<p {{ $attributes->merge(['class' => 'flex items-center gap-3 text-[13px] font-bold tracking-[0.18em] text-brand uppercase']) }}>
    <span class="size-2 rounded-full bg-brand" aria-hidden="true"></span>
    {{ $slot }}
    @if ($number)
        <span class="font-medium tracking-normal text-muted/60">({{ $number }})</span>
    @endif
</p>
