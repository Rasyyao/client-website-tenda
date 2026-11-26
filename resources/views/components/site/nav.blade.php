@props(['dark' => true])

@php
    $links = [
        ['label' => 'Beranda', 'route' => 'home', 'active' => request()->routeIs('home')],
        ['label' => 'Layanan & Harga', 'route' => 'services', 'active' => request()->routeIs('services*')],
        ['label' => 'Tentang Kami', 'route' => 'about', 'active' => request()->routeIs('about')],
    ];
    $whatsappUrl = 'https://wa.me/'.config('site.whatsapp');
@endphp

<header
    {{ $attributes->merge([
        'class' => $dark
            ? 'pointer-events-none sticky top-0 z-50 h-0'
            : 'pointer-events-none sticky top-0 z-50',
    ]) }}
    data-nav
    data-dark="{{ $dark ? 'true' : 'false' }}"
    data-scrolled="false"
    data-menu-open="false">
    <div data-menu-backdrop class="pointer-events-none fixed inset-0 bg-ink/40 opacity-0 backdrop-blur-[2px] transition-opacity duration-300 ease-out md:hidden" aria-hidden="true"></div>

    <div data-nav-inner @class([
        'relative transition-transform duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]',
        'px-7 pt-8 sm:px-12 sm:pt-14 lg:px-[60px]' => $dark,
        'mx-auto max-w-[1600px] px-4 pt-5 sm:px-6 sm:pt-7 lg:px-10' => ! $dark,
    ])>
        <div class="relative">
            <nav data-nav-bar class="pointer-events-auto flex items-center justify-between gap-6 rounded-full transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]" aria-label="Navigasi utama">
                <x-site.logo :dark="$dark" />

                <div data-nav-pill @class([
                    'relative hidden items-center gap-1 rounded-full bg-white p-1.5 text-[15px] font-medium transition-all duration-300 md:flex',
                    'shadow-[0_0_0_1px_var(--color-line)]' => ! $dark,
                ])>
                    <span data-nav-indicator aria-hidden="true" class="pointer-events-none absolute top-1.5 bottom-1.5 left-0 rounded-full bg-ink opacity-0"></span>
                    @foreach ($links as $index => $link)
                        <a href="{{ route($link['route']) }}"
                           data-nav-link
                           data-nav-index="{{ $index }}"
                           data-active="{{ $link['active'] ? 'true' : 'false' }}"
                           @if ($link['active']) aria-current="page" @endif
                           @class([
                               'relative z-10 rounded-full px-[18px] py-2 transition-colors duration-300',
                               'bg-ink text-white' => $link['active'],
                               'text-ink hover:bg-sand' => ! $link['active'],
                           ])>{{ $link['label'] }}</a>
                    @endforeach
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="group relative z-10 inline-flex items-center gap-1 rounded-full bg-brand px-[18px] py-2 text-white transition-colors hover:bg-brand-600">
                        Kontak
                        <x-icon name="arrow-up-right" class="size-4 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
                    </a>
                </div>

                <button type="button" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu" @class([
                    'grid size-11 place-items-center rounded-full transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)] active:scale-90 md:hidden',
                    'bg-white text-ink' => $dark,
                    'bg-ink text-white' => ! $dark,
                ])>
                    <span class="sr-only">Buka menu</span>
                    <x-icon name="menu" class="col-start-1 row-start-1 size-5 transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]" data-menu-icon-open />
                    <x-icon name="close" class="col-start-1 row-start-1 size-5 scale-50 rotate-90 opacity-0 transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]" data-menu-icon-close />
                </button>
            </nav>

            <div id="mobile-menu" data-menu hidden class="pointer-events-none absolute inset-x-0 top-full mt-3 origin-top -translate-y-3 scale-[0.96] rounded-3xl bg-white p-3 opacity-0 shadow-2xl shadow-black/25 ring-1 ring-ink/8 transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)] md:hidden">
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                       data-menu-item
                       style="transition-delay: {{ $loop->index * 45 }}ms"
                       @class([
                           'flex translate-y-2 items-center justify-between rounded-2xl px-4 py-3.5 text-lg font-medium opacity-0 transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]',
                           'bg-ink text-white' => $link['active'],
                           'text-ink hover:bg-sand' => ! $link['active'],
                       ])>
                        {{ $link['label'] }}
                        <x-icon name="arrow-right" class="size-4 opacity-60" />
                    </a>
                @endforeach
                <a href="{{ $whatsappUrl }}"
                   target="_blank"
                   rel="noopener"
                   data-menu-item
                   style="transition-delay: {{ count($links) * 45 }}ms"
                   class="mt-2 flex translate-y-2 items-center justify-center gap-2 rounded-2xl bg-brand px-4 py-3.5 text-lg font-medium text-white opacity-0 transition-all duration-300 ease-[cubic-bezier(0.22,1,0.36,1)] hover:bg-brand-600">
                    Kontak via WhatsApp <x-icon name="arrow-up-right" />
                </a>
            </div>
        </div>
    </div>
</header>
