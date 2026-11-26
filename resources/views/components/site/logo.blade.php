@props(['dark' => false])

<a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 font-bold tracking-wide']) }}>
    <span class="grid size-9 place-items-center rounded-lg bg-brand">
        <svg viewBox="0 0 24 24" class="size-5 text-white" aria-hidden="true"><path d="M12 5 21 19H3z" fill="currentColor"/></svg>
    </span>
    <span data-logo-text @class(['text-xl uppercase transition-colors duration-300', 'text-white' => $dark, 'text-ink' => ! $dark])>{{ config('site.name') }}</span>
</a>
