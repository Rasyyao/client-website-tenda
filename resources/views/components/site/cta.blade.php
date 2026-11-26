@php
    $whatsappUrl = 'https://wa.me/'.config('site.whatsapp').'?text='.rawurlencode('Halo Pratama Jaya, saya ingin minta penawaran untuk acara saya.');
@endphp

<section {{ $attributes->merge(['class' => 'px-4 sm:px-6 lg:px-10']) }} aria-labelledby="cta-title">
    <div class="relative mx-auto max-w-[1600px] overflow-hidden rounded-[32px] bg-brand px-6 py-12 text-white sm:px-10 lg:px-14 lg:py-16" data-reveal>
        {{-- decorative lines --}}
        <svg class="pointer-events-none absolute inset-0 size-full" viewBox="0 0 1280 540" preserveAspectRatio="none" aria-hidden="true">
            <circle cx="40" cy="60" r="200" fill="none" stroke="white" stroke-opacity=".18" stroke-dasharray="3 6" />
            <path d="M240 0v540" stroke="white" stroke-opacity=".15" />
            <path d="M660 540 880 300M860 540l120-260M1220 540l-140-260" stroke="white" stroke-opacity=".2" stroke-width="1.5" />
        </svg>

        <div class="relative grid items-center gap-12 lg:grid-cols-[1fr_480px]">
            <div>
                <h2 id="cta-title" class="max-w-[560px] text-[40px] leading-[0.98] font-medium tracking-[-0.03em] sm:text-6xl lg:text-[72px]">Siap wujudkan panggung &amp; acara terbaik Anda?</h2>
                <p class="mt-8 max-w-[480px] text-lg leading-relaxed text-white/90">Mulai dari konser musik, festival, pameran, hingga acara korporat dan resepsi outdoor — kirim tanggal, lokasi venue, serta kebutuhan tenda atau panggung Anda. Penawaran lengkap kami kirim dalam 1×24 jam.</p>

                <div class="mt-9 flex flex-wrap items-center gap-x-6 gap-y-5">
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="group inline-flex items-center gap-3 rounded-full bg-ink py-4 pr-7 pl-6 text-lg font-medium transition-transform hover:-translate-y-0.5">
                        <span class="relative flex size-2.5">
                            <span class="absolute inline-flex size-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex size-2.5 rounded-full bg-green-400"></span>
                        </span>
                        Chat via WhatsApp
                    </a>
                    <div>
                        <p class="text-[13px] text-white/75">atau telepon</p>
                        <a href="tel:+{{ config('site.whatsapp') }}" class="text-lg font-bold hover:underline">{{ config('site.phone') }}</a>
                    </div>
                    <svg class="ml-auto hidden h-6 w-32 text-white xl:block" viewBox="0 0 124 24" fill="none" aria-hidden="true">
                        <path d="M2 14c10-12 20-12 30 0s20 12 30 0 20-12 30 0 20 12 30 0" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <div class="relative mx-auto h-[360px] w-full max-w-[480px] sm:h-[440px]">
                <x-icon name="sparkle" class="absolute top-0 -left-12 hidden size-7 text-white lg:block" />
                <figure class="absolute top-[4%] left-[2%] w-[58%] -rotate-[5deg] rounded-[22px] bg-white p-[6px] shadow-2xl shadow-black/25 transition-transform duration-500 hover:-rotate-[2deg]">
                    <img src="{{ asset('images/heart-hands.jpg') }}" alt="Penonton membentuk hati dengan tangan di depan panggung" class="aspect-[3/4] w-full rounded-[18px] object-cover" loading="lazy">
                </figure>
                <figure class="absolute top-[22%] right-0 w-[56%] rotate-[4deg] rounded-[22px] bg-white p-[6px] shadow-2xl shadow-black/30 transition-transform duration-500 hover:rotate-[1deg]">
                    <img src="{{ asset('images/crowd-orange.jpg') }}" alt="Penonton konser dengan lampu panggung oranye" class="aspect-[3/4] w-full rounded-[18px] object-cover" loading="lazy">
                </figure>
                <div class="absolute bottom-[2%] left-[-2%] grid size-[120px] -rotate-[8deg] place-items-center rounded-full bg-ink text-center sm:left-[-6%]">
                    <div>
                        <p class="text-[32px] leading-none font-bold text-brand">1×24</p>
                        <p class="mt-1 text-[11px] font-bold tracking-[0.2em] uppercase">Jam respon</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
