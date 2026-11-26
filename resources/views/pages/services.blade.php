@php
    $whatsappUrl = 'https://wa.me/'.config('site.whatsapp');
    $productList = collect($products)->map(fn (array $product, string $slug) => [...$product, 'slug' => $slug])->values();

    $steps = [
        ['icon' => 'chat', 'when' => 'Hari ini', 'title' => 'Konsultasi via WhatsApp', 'text' => 'Kirim tanggal, jenis acara (konser, pameran, korporat, atau resepsi), lokasi venue, serta kebutuhan tenda dan alat.'],
        ['icon' => 'pin', 'when' => '1 — 2 hari', 'title' => 'Survei & penawaran', 'text' => 'Tim kami survei venue gratis, lalu kirim penawaran lengkap beserta layout tenda dan panggung.'],
        ['icon' => 'file', 'when' => 'Setelah deal', 'title' => 'DP & kunci tanggal', 'text' => 'Bayar DP 50% — tanggal dan unit langsung terkunci untuk acara Anda.'],
        ['icon' => 'truck', 'when' => 'H-2 / H-1', 'title' => 'Kirim & pasang', 'text' => 'Kru dan truk tiba di venue, tenda serta perlengkapan dipasang dan diuji.'],
        ['icon' => 'tent', 'when' => 'Hari H', 'title' => 'Acara & bongkar', 'text' => 'Teknisi standby selama acara, lalu semua dibongkar dan venue bersih kembali.'],
    ];

    $benefits = [
        ['icon' => 'box', 'title' => 'Alat milik sendiri', 'text' => 'Tanpa sub-vendor — jadwal, stok, dan kualitas alat kami kendalikan sendiri.'],
        ['icon' => 'hammer', 'title' => 'Pasang & bongkar oleh kru', 'text' => 'Sudah termasuk harga. Kru terlatih memasang dan membongkar tepat waktu.'],
        ['icon' => 'pin', 'title' => 'Survei venue gratis', 'text' => 'Kami ukur lahan, cek akses truk, dan titik listrik sebelum penawaran.'],
        ['icon' => 'shield', 'title' => 'Cek keamanan struktur', 'text' => 'Beban angin dan titik rigging diperiksa sebelum acara dimulai.'],
        ['icon' => 'clock', 'title' => 'Teknisi standby', 'text' => 'Satu teknisi siaga di venue selama acara berlangsung.'],
        ['icon' => 'card', 'title' => 'Asuransi peralatan', 'text' => 'Peralatan diasuransikan selama masa sewa — Anda tenang.'],
    ];
@endphp

<x-layout title="Layanan & Harga">
    <x-site.page-hero
        image="crowd-orange.jpg"
        badge="Katalog sewa {{ now()->year }} · Tenda & {{ count($products) }} kategori perlengkapan event"
        left-note="Termasuk pasang & bongkar"
        right-note="Tangerang & Purwokerto · gratis transport"
        scroll-label="Scroll ke katalog"
        scroll-target="#katalog">
        <x-slot:title>Layanan <span class="text-brand">&amp;</span> Harga</x-slot:title>
        <x-slot:subtitle>Mulai dari sewa tenda roder &amp; sarnafil untuk berbagai acara, hingga paket FOH, lighting, stage, LED screen, dan genset berstandar konser — milik sendiri dengan harga yang jelas sejak awal.</x-slot:subtitle>
        <x-slot:actions>
            <a href="#katalog" class="group inline-flex items-center justify-center gap-2 rounded-full bg-brand px-7 py-4 text-[17px] font-bold transition-colors hover:bg-brand-600">
                Lihat Katalog <x-icon name="arrow-down" class="transition-transform group-hover:translate-y-0.5" />
            </a>
            <a href="#" class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-7 py-4 text-[17px] font-bold backdrop-blur transition-colors hover:bg-white/20">Unduh Price List (PDF)</a>
        </x-slot:actions>
    </x-site.page-hero>

    <div class="dotted-guides">
        {{-- ============================== KATALOG ============================== --}}
        <section id="katalog" class="relative scroll-mt-20 overflow-hidden pt-24 pb-28 lg:pt-32" aria-labelledby="catalog-title" data-carousel>
            <div class="mx-auto max-w-[1600px] px-4 text-center sm:px-6 lg:px-10">
                <p class="absolute top-24 right-10 hidden text-sm text-muted/60 lg:block lg:top-32">(01)</p>
                <div data-reveal>
                    <x-site.eyebrow class="justify-center">Katalog sewa</x-site.eyebrow>
                    <h2 id="catalog-title" class="mt-5 text-[40px] leading-[1.02] font-medium tracking-[-0.03em] sm:text-[64px]">Pilih tenda &amp; alat untuk acara Anda.</h2>
                </div>

                <div class="no-scrollbar -mx-5 mt-8 overflow-x-auto px-5" data-reveal>
                    <div class="mx-auto flex w-max gap-1 rounded-full bg-sand p-1.5 text-[15px]" role="group" aria-label="Filter kategori">
                        <button type="button" data-carousel-filter="all" aria-pressed="true" class="rounded-full px-[18px] py-2.5 text-muted transition-colors hover:text-ink aria-pressed:bg-ink aria-pressed:font-bold aria-pressed:text-white">Semua</button>
                        @foreach ($categories as $key => $label)
                            <button type="button" data-carousel-filter="{{ $key }}" aria-pressed="false" class="rounded-full px-[18px] py-2.5 text-muted transition-colors hover:text-ink aria-pressed:bg-ink aria-pressed:font-bold aria-pressed:text-white">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="relative mt-16 h-[440px] sm:h-[560px]" data-reveal>
                <x-icon name="sparkle" class="absolute top-[-14px] left-[calc(50%+230px)] z-20 hidden size-7 animate-float text-brand md:block" />
                <x-icon name="sparkle" class="absolute bottom-[-30px] left-[calc(50%-250px)] z-20 hidden size-4 text-ink md:block" />
                <div class="absolute bottom-[-40px] left-1/2 h-16 w-[600px] max-w-[90vw] -translate-x-1/2 rounded-[50%] bg-brand/10 blur-md" aria-hidden="true"></div>

                <ul class="relative size-full" aria-live="polite">
                    @foreach ($productList as $index => $product)
                        <li class="absolute top-1/2 left-1/2 w-[280px] sm:w-[410px]" data-carousel-item data-category="{{ $product['category'] }}"
                            data-kicker="{{ $product['kicker'] }}" data-name="{{ $product['name'] }}" data-price="Rp {{ number_format($product['starting_price'], 0, ',', '.') }}"
                            data-unit="/ {{ $product['unit'] }} · {{ $product['summary'] }}" data-url="{{ route('services.show', $product['slug']) }}">
                            <button type="button" class="group relative block h-[380px] w-full overflow-hidden rounded-[28px] bg-ink text-left shadow-[0_30px_60px_-25px_rgba(17,18,20,0.5)] sm:h-[530px]" data-carousel-select="{{ $index }}" aria-label="Tampilkan {{ $product['name'] }}">
                                <img src="{{ asset('images/'.$product['image']) }}" alt="" class="size-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                                <span class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></span>
                                <span class="absolute top-5 left-5 rounded-full bg-white px-3 py-1.5 text-[13px] font-bold text-ink" data-active-only>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} / {{ str_pad($productList->count(), 2, '0', STR_PAD_LEFT) }}</span>
                                @isset($product['badge'])
                                    <span class="absolute top-5 right-5 inline-flex items-center gap-1 rounded-full bg-brand px-3 py-1.5 text-[13px] font-bold text-white" data-active-only><x-icon name="star" class="size-3" />{{ $product['badge'] }}</span>
                                @endisset
                                <span class="absolute bottom-6 left-5 text-[15px] font-bold text-white" data-inactive-only>{{ $product['service'] }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mx-auto mt-14 max-w-[1600px] px-4 text-center sm:px-6 lg:px-10">
                <div class="relative mx-auto max-w-[840px]">
                    <p class="text-[13px] font-bold tracking-[0.18em] text-muted/80 uppercase" data-carousel-kicker>{{ $productList[0]['kicker'] }}</p>
                    <h3 class="mt-3 text-[40px] font-medium tracking-[-0.03em] sm:text-5xl" data-carousel-name>{{ $productList[0]['name'] }}</h3>
                    <p class="mt-3 text-[15px] text-muted">Mulai <span class="text-2xl font-bold text-brand" data-carousel-price>Rp {{ number_format($productList[0]['starting_price'], 0, ',', '.') }}</span> <span data-carousel-unit>/ {{ $productList[0]['unit'] }} · {{ $productList[0]['summary'] }}</span></p>

                    <button type="button" data-carousel-prev class="absolute top-1/2 left-0 hidden size-14 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border border-line bg-white transition-colors hover:border-ink md:grid lg:-translate-x-full" aria-label="Sebelumnya"><x-icon name="arrow-left" class="size-5" /></button>
                    <button type="button" data-carousel-next class="absolute top-1/2 right-0 hidden size-14 translate-x-1/2 -translate-y-1/2 place-items-center rounded-full bg-ink text-white transition-colors hover:bg-brand md:grid lg:translate-x-full" aria-label="Berikutnya"><x-icon name="arrow-right" class="size-5" /></button>
                </div>

                <div class="mt-7 flex flex-wrap justify-center gap-3">
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-full bg-brand px-6 py-3.5 text-[15px] font-bold text-white transition-colors hover:bg-brand-600" data-carousel-whatsapp>Tanya via WhatsApp <x-icon name="arrow-up-right" /></a>
                    <a href="{{ route('services.show', $productList[0]['slug']) }}" class="inline-flex items-center rounded-full border-[1.5px] border-ink px-6 py-3.5 text-[15px] font-bold transition-colors hover:bg-ink hover:text-white" data-carousel-link>Lihat spesifikasi</a>
                </div>

                <div class="mt-8 flex items-center justify-center gap-2">
                    <button type="button" data-carousel-prev class="grid size-11 place-items-center rounded-full border border-line md:hidden" aria-label="Sebelumnya"><x-icon name="arrow-left" /></button>
                    <div class="flex items-center gap-2" data-carousel-dots>
                        @foreach ($productList as $index => $product)
                            <button type="button" data-carousel-select="{{ $index }}" class="h-1.5 w-1.5 rounded-full bg-line transition-all aria-current:w-8 aria-current:bg-brand" aria-label="{{ $product['name'] }}"></button>
                        @endforeach
                    </div>
                    <button type="button" data-carousel-next class="grid size-11 place-items-center rounded-full bg-ink text-white md:hidden" aria-label="Berikutnya"><x-icon name="arrow-right" /></button>
                </div>
            </div>
        </section>

        {{-- ============================== ALUR PEMESANAN ============================== --}}
        <section class="mx-auto max-w-[1600px] px-4 pb-24 sm:px-6 lg:px-10 lg:pb-32" aria-labelledby="flow-title">
            <div class="grid gap-8 lg:grid-cols-[1fr_420px]">
                <div data-reveal>
                    <x-site.eyebrow>Alur pemesanan</x-site.eyebrow>
                    <h2 id="flow-title" class="mt-5 text-[40px] leading-[1.02] font-medium tracking-[-0.03em] sm:text-[64px]">Dari chat sampai<br>tenda &amp; panggung berdiri.</h2>
                </div>
                <div class="flex flex-col justify-between gap-5 lg:items-end" data-reveal>
                    <p class="hidden text-sm text-muted/60 lg:block">(02)</p>
                    <p class="text-[17px] leading-relaxed text-muted">Lima langkah sederhana. Rata-rata klien kami hanya butuh 3—5 hari dari chat pertama sampai tanggal terkunci.</p>
                </div>
            </div>

            <ol class="relative mt-16 grid gap-8 lg:grid-cols-5 lg:gap-6" data-steps>
                {{-- timeline track (desktop) --}}
                <li role="presentation" class="pointer-events-none absolute top-[152px] right-0 left-12 hidden h-px bg-line lg:block" aria-hidden="true">
                    <span class="absolute inset-y-0 left-0 block w-full origin-left scale-x-0 bg-brand transition-transform duration-[1600ms] ease-out" data-steps-line></span>
                    <x-icon name="arrow-right" class="absolute -top-2 -right-1 size-4 text-[#cfcac0]" />
                </li>
                @foreach ($steps as $index => $step)
                    <li class="relative grid grid-cols-[64px_1fr] items-start gap-x-5 lg:block" data-reveal style="--reveal-delay: {{ $index * 120 }}ms">
                        @if (! $loop->last)
                            <span class="pointer-events-none absolute top-16 -bottom-8 left-8 w-px -translate-x-1/2 bg-line lg:hidden" aria-hidden="true">
                                <span class="block size-full origin-top scale-y-0 bg-brand transition-transform duration-700 ease-out" style="transition-delay: {{ $index * 150 }}ms" data-steps-line-y></span>
                            </span>
                        @endif
                        <div @class([
                            'relative z-10 grid size-16 place-items-center rounded-2xl transition-transform hover:-translate-y-1 lg:size-24 lg:rounded-[22px]',
                            'bg-brand text-white shadow-[0_20px_40px_-12px_rgba(255,90,31,0.55)]' => $index === 0,
                            'border border-line bg-white text-brand' => $index !== 0,
                        ])>
                            <x-icon :name="$step['icon']" class="size-7 lg:size-9" :stroke="1.6" />
                        </div>
                        <span class="ml-12 hidden h-8 border-l border-dashed border-[#d9d4ca] lg:block" aria-hidden="true"></span>
                        <div class="lg:contents">
                            <div class="flex flex-wrap items-center gap-2.5 lg:contents">
                                <span @class([
                                    'relative z-10 grid size-8 place-items-center rounded-full text-xs font-bold lg:mt-0 lg:ml-[26px] lg:size-11 lg:text-[15px]',
                                    'bg-brand text-white ring-4 ring-brand/15 lg:ring-8' => $index === 0,
                                    'border-[1.5px] border-brand bg-white text-brand' => $index !== 0,
                                ])>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <p @class([
                                    'inline-block rounded-full px-3 py-1 text-[13px] font-bold lg:mt-7',
                                    'bg-ink text-white' => $index === 0,
                                    'border border-line text-ink/80' => $index !== 0,
                                ])>{{ $step['when'] }}</p>
                            </div>
                            <h3 class="mt-2.5 text-[20px] font-medium tracking-tight sm:text-[22px] lg:mt-3">{{ $step['title'] }}</h3>
                            <p class="mt-2 text-[15px] leading-relaxed text-muted lg:mt-3">{{ $step['text'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>

            <div class="mt-16 flex flex-col items-start gap-4 rounded-[28px] border border-line p-3 pl-6 sm:flex-row sm:items-center sm:justify-between sm:rounded-full sm:pl-7" data-reveal>
                <p class="pt-3 text-[17px] sm:pt-0">Siap mulai? Langkah pertama cukup satu chat — kami balas di jam kerja dalam 15 menit.</p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="inline-flex shrink-0 items-center gap-2.5 rounded-full bg-brand px-6 py-3.5 text-[17px] font-bold text-white transition-colors hover:bg-brand-600">
                    <span class="size-2 rounded-full bg-white"></span> Mulai langkah 01 <x-icon name="arrow-up-right" />
                </a>
            </div>
        </section>
    </div>

    {{-- ============================== KEUNTUNGAN ============================== --}}
    <section class="px-4 pb-24 sm:px-6 lg:px-10 lg:pb-[104px]" aria-labelledby="benefits-title">
        <div class="relative mx-auto max-w-[1600px] overflow-hidden rounded-[32px] bg-ink px-6 py-14 text-white sm:px-10 lg:px-14 lg:py-[72px]" data-reveal>
            <div class="pointer-events-none absolute -top-[120px] -right-[60px] size-[380px]" aria-hidden="true">
                <div class="absolute inset-0 rounded-full border border-white/10"></div>
                <div class="absolute inset-[80px] animate-spin-slow rounded-full border border-dashed border-brand/40"></div>
            </div>
            <x-icon name="sparkle" class="absolute top-12 right-20 size-7 animate-float text-brand" />

            <div class="relative grid gap-8 lg:grid-cols-[1fr_380px] lg:items-end">
                <div>
                    <x-site.eyebrow>Keuntungan sewa di kami</x-site.eyebrow>
                    <h2 id="benefits-title" class="mt-5 text-[36px] leading-[1.05] font-medium tracking-[-0.03em] sm:text-[56px]">Yang Anda dapat<br>di setiap sewa.</h2>
                </div>
                <p class="text-[16px] leading-relaxed text-white/65">Semua sudah termasuk dalam harga sewa — tanpa biaya tersembunyi, tanpa sub-vendor.</p>
            </div>

            <ul class="relative mt-12 grid gap-x-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($benefits as $index => $benefit)
                    <li class="group border-t border-white/12 py-7" data-reveal style="--reveal-delay: {{ ($index % 3) * 100 }}ms">
                        <span class="grid size-12 place-items-center rounded-xl bg-brand transition-transform group-hover:-rotate-6"><x-icon :name="$benefit['icon']" class="size-6" :stroke="1.8" /></span>
                        <h3 class="mt-5 text-[21px] font-medium">{{ $benefit['title'] }}</h3>
                        <p class="mt-4 max-w-[340px] text-[15px] leading-relaxed text-white/55">{{ $benefit['text'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-site.cta class="pb-16 lg:pb-[60px]" />
</x-layout>
