@php
    $services = collect(config('site.products'))->take(4);
@endphp

<footer class="bg-ink text-white">
    <div class="mx-auto max-w-[1600px] px-4 pt-16 pb-10 sm:px-6 lg:px-10 lg:pt-[88px]">
        <div class="grid gap-12 lg:grid-cols-[1fr_auto]">
            <div class="max-w-[380px]">
                <x-site.logo dark />
                <p class="mt-6 text-[15px] leading-relaxed text-white/60">{{ config('site.tagline') }}</p>
                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach (config('site.socials') as $label => $url)
                        <a href="{{ $url }}" class="rounded-full border border-white/20 px-4 py-2 text-sm transition-colors hover:border-brand hover:bg-brand">{{ $label }}</a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-10 sm:grid-cols-[180px_200px_auto] lg:gap-10">
                <div>
                    <h2 class="text-[13px] font-bold tracking-[0.18em] text-brand uppercase">Halaman</h2>
                    <ul class="mt-5 space-y-3 text-base">
                        <li><a href="{{ route('home') }}" class="hover:text-brand">Beranda</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-brand">Layanan &amp; Harga</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-brand">Tentang Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-[13px] font-bold tracking-[0.18em] text-brand uppercase">Layanan</h2>
                    <ul class="mt-5 space-y-3 text-base">
                        @foreach ($services as $slug => $service)
                            <li><a href="{{ route('services.show', $slug) }}" class="hover:text-brand">{{ $service['service'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <h2 class="text-[13px] font-bold tracking-[0.18em] text-brand uppercase">Kontak</h2>
                    <ul class="mt-5 space-y-3 text-base">
                        <li><a href="tel:+{{ config('site.whatsapp') }}" class="hover:text-brand">{{ config('site.phone') }}</a></li>
                        <li><a href="mailto:{{ config('site.email') }}" class="hover:text-brand">{{ config('site.email') }}</a></li>
                        <li>{{ config('site.address') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-14 flex flex-col gap-4 border-t border-white/10 pt-7 text-sm text-white/50 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ now()->year }} {{ config('site.legal_name') }}. Semua hak dilindungi.</p>
            <a href="#main" class="inline-flex items-center gap-1 text-white/80 hover:text-brand">Kembali ke atas <x-icon name="arrow-up" class="size-3.5" /></a>
        </div>
    </div>
</footer>
