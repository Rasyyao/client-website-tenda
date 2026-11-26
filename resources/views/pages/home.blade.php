@php
    $whatsappUrl = 'https://wa.me/'.config('site.whatsapp').'?text='.rawurlencode('Halo Pratama Jaya, saya ingin konsultasi sewa tenda & perlengkapan untuk acara saya.');

    // Card layout pattern for the documentation scroller: [card width, image height, top offset]
    $projectLayouts = [
        ['w-[300px] sm:w-[440px]', 'h-[220px] sm:h-[320px]', 'mt-0'],
        ['w-[260px] sm:w-[340px]', 'h-[300px] sm:h-[420px]', 'mt-10 sm:mt-[90px]'],
        ['w-[320px] sm:w-[480px]', 'h-[230px] sm:h-[330px]', 'mt-4 sm:mt-5'],
    ];

    // Map coverage coordinates in the 1280 × 560 design space of the Java map card.
    $mapLocations = [
        ['id' => 'tangerang', 'name' => 'Tangerang', 'zone' => 'tangerang', 'is_hub' => true, 'pin' => [239.5, 213.5], 'hub_pin' => [239.5, 213.5], 'label' => 'above'],
        ['id' => 'tangsel', 'name' => 'Tangerang Selatan', 'zone' => 'tangerang', 'is_hub' => false, 'pin' => [252.5, 252.5], 'hub_pin' => [239.5, 213.5], 'label' => 'below'],
        ['id' => 'kab-tangerang', 'name' => 'Kab. Tangerang', 'zone' => 'tangerang', 'is_hub' => false, 'pin' => [200.5, 239.5], 'hub_pin' => [239.5, 213.5], 'label' => 'left'],
        ['id' => 'serang', 'name' => 'Serang & Cilegon', 'zone' => 'tangerang', 'is_hub' => false, 'pin' => [174.5, 200.5], 'hub_pin' => [239.5, 213.5], 'label' => 'above'],
        ['id' => 'jakarta', 'name' => 'Jakarta & Sekitar', 'zone' => 'tangerang', 'is_hub' => false, 'pin' => [291.5, 200.5], 'hub_pin' => [239.5, 213.5], 'label' => 'right'],
        ['id' => 'purwokerto', 'name' => 'Purwokerto', 'zone' => 'purwokerto', 'is_hub' => true, 'pin' => [577.5, 330.5], 'hub_pin' => [577.5, 330.5], 'label' => 'above'],
        ['id' => 'banyumas', 'name' => 'Banyumas', 'zone' => 'purwokerto', 'is_hub' => false, 'pin' => [577.5, 369.5], 'hub_pin' => [577.5, 330.5], 'label' => 'below'],
        ['id' => 'purbalingga', 'name' => 'Purbalingga', 'zone' => 'purwokerto', 'is_hub' => false, 'pin' => [603.5, 317.5], 'hub_pin' => [577.5, 330.5], 'label' => 'right'],
        ['id' => 'cilacap', 'name' => 'Cilacap', 'zone' => 'purwokerto', 'is_hub' => false, 'pin' => [538.5, 369.5], 'hub_pin' => [577.5, 330.5], 'label' => 'left'],
        ['id' => 'kebumen', 'name' => 'Kebumen', 'zone' => 'purwokerto', 'is_hub' => false, 'pin' => [629.5, 369.5], 'hub_pin' => [577.5, 330.5], 'label' => 'right'],
    ];
    $pct = fn (float $x, float $y): string => 'left:'.round($x / 12.8, 3).'%;top:'.round($y / 5.6, 3).'%';
@endphp

<x-layout>
    <x-site.nav />

    {{-- ============================== HERO ============================== --}}
    <section class="p-3 sm:p-5">
        <div class="relative isolate overflow-hidden rounded-[28px] bg-ink px-4 pt-5 pb-6 text-white sm:rounded-[32px] sm:px-7 sm:pt-9 lg:min-h-[860px] lg:px-10">
            <img src="{{ asset('images/stage-burst.jpg') }}" alt="" class="absolute inset-0 -z-20 size-full scale-105 object-cover" data-parallax="0.15" fetchpriority="high">
            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#120d0b]/95 via-[#120d0b]/70 to-[#120d0b]/55"></div>
            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-[#0c0a09]/90 via-transparent to-[#0c0a09]/30"></div>

            <div class="h-11 md:h-[52px]" aria-hidden="true"></div>

            <div class="mt-14 grid gap-12 sm:mt-24 lg:mt-[108px] lg:grid-cols-[1fr_400px] lg:items-end">
                <div>
                    <p class="hidden items-center gap-2.5 rounded-full border border-white/25 bg-white/5 px-4 py-2 text-[15px] backdrop-blur sm:inline-flex" data-reveal>
                        <span class="size-2 rounded-full bg-brand"></span>
                        Sewa tenda &amp; produksi event — spesialis konser sejak 2012
                    </p>
                    <h1 class="mt-6 text-[46px] leading-[0.95] font-medium tracking-[-0.035em] sm:text-7xl lg:text-[104px] lg:leading-[0.92]" data-reveal style="--reveal-delay:100ms">
                        Dari tenda acara<br>hingga panggung<br><span class="text-brand">konser besar.</span>
                    </h1>

                    <div class="mt-16 hidden w-[268px] rounded-3xl bg-white p-6 text-ink lg:block" data-reveal style="--reveal-delay:250ms">
                        <div class="flex -space-x-2.5" aria-hidden="true">
                            <span class="size-7 rounded-full bg-brand ring-2 ring-white"></span>
                            <span class="size-7 rounded-full bg-ink ring-2 ring-white"></span>
                            <span class="size-7 rounded-full bg-peach ring-2 ring-white"></span>
                            <span class="size-7 rounded-full bg-[#d8d6d1] ring-2 ring-white"></span>
                        </div>
                        <p class="mt-4 text-5xl font-medium tracking-tight" data-count-to="650" data-count-suffix="+">650+</p>
                        <p class="mt-1 text-sm text-muted">Konser, pameran &amp; event sukses digelar</p>
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="mt-3 flex items-center justify-center rounded-full bg-ink py-3 text-[15px] font-bold text-white transition-colors hover:bg-brand">Minta Penawaran</a>
                    </div>
                </div>

                <div class="lg:pb-2" data-reveal style="--reveal-delay:200ms">
                    <p class="max-w-[380px] text-[17px] leading-relaxed text-white/85">Sewa tenda roder, sarnafil, dan dekorasi untuk berbagai skala acara — lengkap dengan FOH sound, stage, lighting, hingga LED screen berstandar konser. Dipasang kru sendiri, tepat waktu, harga transparan.</p>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="group inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-4 font-bold text-ink transition-colors hover:bg-brand hover:text-white">
                            Konsultasi Gratis <x-icon name="arrow-up-right" class="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
                        </a>
                        <a href="{{ route('services') }}" class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-6 py-4 font-bold backdrop-blur transition-colors hover:bg-white/20">Lihat Layanan</a>
                    </div>
                    <div class="mt-8 flex items-center gap-6">
                        <button type="button" class="group relative h-[140px] w-[196px] shrink-0 overflow-hidden rounded-2xl border border-white/20 text-left" aria-label="Putar showreel 2025">
                            <img src="{{ asset('images/studio.jpg') }}" alt="" class="absolute inset-0 size-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <span class="absolute inset-0 bg-black/35"></span>
                            <span class="absolute top-3 left-3 text-[13px] font-bold">Showreel 2025</span>
                            <span class="absolute top-1/2 left-1/2 grid size-12 -translate-1/2 place-items-center rounded-full bg-white/90 text-ink transition-transform group-hover:scale-110">
                                <x-icon name="play" class="size-5" />
                            </span>
                            <span class="absolute inset-x-3 bottom-3 h-[3px] overflow-hidden rounded-full bg-white/30">
                                <span class="block h-full w-1/3 animate-[showreel_6s_linear_infinite] rounded-full bg-brand"></span>
                            </span>
                        </button>
                        <div>
                            <p class="text-6xl font-medium tracking-tight" data-count-to="12" data-count-suffix="+">12+</p>
                            <p class="mt-1 text-[15px] text-white/75">Tahun di belakang panggung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="dotted-guides">
        {{-- ============================== TENTANG KAMI ============================== --}}
        <section class="relative mx-auto max-w-[1600px] px-4 pt-16 pb-24 sm:px-6 lg:px-10 lg:pt-28 lg:pb-32" aria-labelledby="intro-title">
            <div class="pointer-events-none absolute top-0 right-0 hidden size-[400px] translate-x-[110px] lg:block" aria-hidden="true">
                <div class="absolute inset-0 rounded-full border border-line"></div>
                <div class="absolute inset-[70px] animate-spin-slow rounded-full border border-dashed border-line"></div>
                <div class="absolute top-[0px] left-[140px] grid size-[140px] place-items-center rounded-full border border-peach">
                    <span class="absolute size-7 animate-pulse-ring rounded-full bg-brand/40"></span>
                    <span class="size-7 rounded-full bg-brand"></span>
                </div>
            </div>

            <div class="relative grid gap-10 lg:grid-cols-[280px_1fr]">
                <div data-reveal>
                    <x-site.eyebrow>Tentang kami</x-site.eyebrow>
                    <div class="mt-9 flex h-12 items-center gap-[5px]" aria-hidden="true">
                        @foreach ([18, 34, 26, 48, 22, 40, 30, 46, 20, 32, 14] as $i => $height)
                            <span class="w-[3px] origin-center animate-[eq_1.2s_ease-in-out_infinite] rounded-full bg-brand" style="height: {{ $height }}px; animation-delay: -{{ $i * 110 }}ms"></span>
                        @endforeach
                    </div>
                    <p class="mt-9 text-sm text-muted/60">(01)</p>
                </div>

                <div>
                    <h2 id="intro-title" class="max-w-[790px] text-[28px] leading-[1.22] font-medium tracking-[-0.02em] text-[#9a9a9f] sm:text-[44px]" data-reveal>
                        <span class="text-ink">Kami bukan sekadar rental tenda dan alat.</span> Kami kru yang memastikan setiap tenda berdiri kokoh, area tamu nyaman, hingga panggung konser siap <span class="text-brand">tepat sebelum acara dimulai.</span>
                    </h2>
                    <div class="mt-16 flex flex-wrap items-center gap-x-12 gap-y-8" data-reveal>
                        <div>
                            <p class="text-[28px] font-medium">4.000 m²</p>
                            <p class="mt-1 text-sm text-muted">Gudang tenda &amp; peralatan sendiri</p>
                        </div>
                        <div>
                            <p class="text-[28px] font-medium">80+ kru</p>
                            <p class="mt-1 text-sm text-muted">Teknisi &amp; rigger bersertifikat</p>
                        </div>
                        <a href="{{ route('about') }}" class="group inline-flex items-center gap-2 rounded-full border-[1.5px] border-ink px-6 py-3.5 text-[15px] font-bold transition-colors hover:bg-ink hover:text-white">
                            Kenali kami <x-icon name="arrow-up-right" class="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================== DOKUMENTASI PROYEK ============================== --}}
        <section aria-labelledby="projects-title">
            <div class="mx-auto grid max-w-[1600px] gap-8 px-4 sm:px-6 lg:grid-cols-[1fr_460px] lg:px-10">
                <div class="relative" data-reveal>
                    <x-site.eyebrow>Dokumentasi proyek</x-site.eyebrow>
                    <h2 id="projects-title" class="mt-5 text-[40px] leading-[1] font-medium tracking-[-0.03em] sm:text-[64px]">650+ tenda &amp; panggung,<br>satu per satu.</h2>
                    <x-icon name="sparkle" class="absolute top-6 left-[570px] hidden size-7 animate-float text-brand lg:block" />
                    <x-icon name="sparkle" class="absolute top-0 left-[602px] hidden size-4 text-ink lg:block" />
                </div>
                <div class="flex flex-col justify-between gap-4 lg:items-end" data-reveal>
                    <p class="hidden text-sm text-muted/60 lg:block">(02)</p>
                    <p class="text-[17px] leading-relaxed text-muted">Dokumentasi asli dari berbagai acara yang kami tangani — mulai dari konser musik &amp; festival besar, pameran korporat, wisuda kampus, hingga resepsi outdoor. Terus scroll untuk menjelajah.</p>
                </div>
            </div>

            {{-- Pinned horizontal scroller: vertical scroll drives the track to the right until the last card, then the page continues. --}}
            <div class="relative" data-hscroll>
                <div class="sticky top-0 flex h-screen flex-col justify-center overflow-hidden" data-hscroll-viewport>
                    <div class="relative flex w-max items-start gap-6 px-4 will-change-transform sm:gap-9 sm:px-6 lg:px-10" data-hscroll-track>
                        <svg class="pointer-events-none absolute top-[110px] left-0 -z-0 h-[200px] w-full sm:top-[150px]" viewBox="0 0 1000 200" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M0 120 C 40 40, 80 40, 125 110 S 210 190, 250 110 S 330 30, 375 110 S 460 190, 500 110 S 580 30, 625 110 S 710 190, 750 110 S 830 30, 875 110 S 960 190, 1000 110" fill="none" stroke="var(--color-brand)" stroke-width="4" vector-effect="non-scaling-stroke" />
                        </svg>

                        @foreach ($projects as $index => $project)
                            @php [$width, $height, $offset] = $projectLayouts[$index % 3]; @endphp
                            <article class="group relative shrink-0 {{ $width }} {{ $offset }}" data-hscroll-item>
                                <div class="relative overflow-hidden rounded-[24px] shadow-[0_24px_40px_-20px_rgba(17,18,20,0.35)] {{ $height }}">
                                    <img src="{{ asset('images/'.$project['image']) }}" alt="{{ $project['title'] }} — {{ $project['meta'] }}" class="size-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                                    <span class="absolute top-4 left-4 rounded-full bg-white px-3 py-1.5 text-[13px] font-bold">{{ $project['year'] }}</span>
                                </div>
                                <h3 class="mt-6 text-[22px] font-medium tracking-tight">{{ $project['title'] }}</h3>
                                <p class="mt-1.5 text-[15px] text-muted">{{ $project['meta'] }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="pointer-events-none absolute top-1/2 left-1/2 hidden size-28 -translate-1/2 flex-col items-center justify-center rounded-full bg-ink text-white transition-[opacity,scale] duration-500 md:flex" data-hscroll-hint aria-hidden="true">
                        <span class="text-[15px] font-bold">Scroll</span>
                        <x-icon name="arrow-right" class="mt-1 size-5 animate-[nudge_1.4s_ease-in-out_infinite] text-brand" />
                    </div>

                    <div class="mx-auto mt-10 flex w-full max-w-[1600px] flex-wrap items-center gap-x-6 gap-y-4 px-4 sm:mt-14 sm:px-6 lg:px-10">
                        <p class="text-[15px] font-bold tabular-nums"><span data-hscroll-count>03</span> / {{ str_pad(count($projects), 2, '0', STR_PAD_LEFT) }} proyek</p>
                        <div class="order-last h-[3px] w-full flex-1 basis-full overflow-hidden rounded-full bg-line sm:order-none sm:basis-auto">
                            <div class="h-full w-full origin-left scale-x-[0.25] rounded-full bg-brand" data-hscroll-progress></div>
                        </div>
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="ml-auto inline-flex items-center gap-1.5 text-[15px] font-bold underline underline-offset-4 hover:text-brand sm:ml-0">Lihat semua dokumentasi <x-icon name="arrow-up-right" /></a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================== LAYANAN KAMI ============================== --}}
        <section class="relative mx-auto max-w-[1600px] px-4 pt-20 pb-24 sm:px-6 lg:px-10 lg:pt-28" aria-labelledby="services-title">
            <svg class="pointer-events-none absolute top-16 right-0 hidden h-[200px] w-[880px] lg:block" viewBox="0 0 880 200" fill="none" aria-hidden="true">
                @foreach ([0, 22, 44, 66] as $i => $shift)
                    <path d="M0 {{ 120 + $shift }} C 180 {{ 40 + $shift }}, 320 {{ 200 + $shift }}, 520 {{ 110 + $shift }} S 780 {{ 20 + $shift }}, 880 {{ 70 + $shift }}" stroke="{{ $i === 2 ? 'var(--color-peach)' : 'var(--color-line)' }}" stroke-width="1.2" />
                @endforeach
            </svg>

            <div class="relative grid gap-8 lg:grid-cols-[1fr_420px]">
                <div data-reveal>
                    <x-site.eyebrow>Layanan kami</x-site.eyebrow>
                    <h2 id="services-title" class="mt-5 text-[40px] leading-[1] font-medium tracking-[-0.03em] sm:text-[64px]">Semua yang acara &amp;<br class="hidden sm:block"> panggung Anda butuhkan.</h2>
                </div>
                <div class="flex flex-col justify-between gap-5 lg:items-end" data-reveal>
                    <p class="hidden text-sm text-muted/60 lg:block">(03)</p>
                    <div>
                        <p class="text-[17px] leading-relaxed text-muted">Sewa tenda saja untuk acara Anda, atau paket lengkap beserta panggung, sound, dan lighting berstandar konser. Semua unit milik sendiri dan dikawal kru kami di lapangan.</p>
                        <a href="{{ route('services') }}" class="group mt-5 inline-flex items-center gap-3 text-[17px] font-bold underline underline-offset-4 hover:text-brand">
                            Lihat price list lengkap
                            <span class="grid size-8 place-items-center rounded-full bg-brand text-white transition-transform group-hover:rotate-45"><x-icon name="arrow-up-right" class="size-4" /></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative mt-16 grid gap-6 lg:grid-cols-[440px_1fr]" data-tabs>
                <div class="relative rounded-[32px] bg-brand px-6 py-8 sm:px-8 sm:py-14" data-reveal>
                    <div class="flex flex-col" role="tablist" aria-label="Pilih layanan" aria-orientation="vertical">
                        @foreach ($products as $slug => $product)
                            <button type="button" role="tab" id="tab-{{ $slug }}" aria-controls="panel-{{ $slug }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" tabindex="{{ $loop->first ? '0' : '-1' }}" data-tab
                                class="group flex items-center justify-between border-b border-white/25 py-4 text-left text-xl text-white/80 transition-colors last:border-b-0 hover:text-white aria-selected:font-bold aria-selected:text-white">
                                {{ $product['service'] }}
                                <span class="grid size-12 scale-50 place-items-center rounded-full bg-white text-brand opacity-0 transition-all duration-300 group-aria-selected:scale-100 group-aria-selected:opacity-100" aria-hidden="true">
                                    <x-icon name="arrow-right" class="size-5" />
                                </span>
                            </button>
                        @endforeach
                    </div>
                    <div class="absolute -bottom-12 left-0 hidden grid-cols-5 gap-x-[13px] gap-y-[13px] lg:grid" aria-hidden="true">
                        @for ($i = 0; $i < 15; $i++)
                            <span class="size-[3px] rounded-full bg-brand"></span>
                        @endfor
                    </div>
                </div>

                <div class="relative min-h-[460px] overflow-hidden rounded-[32px] bg-ink sm:min-h-[540px]" data-reveal style="--reveal-delay:120ms">
                    @foreach ($products as $slug => $product)
                        <div id="panel-{{ $slug }}" role="tabpanel" aria-labelledby="tab-{{ $slug }}" data-tab-panel
                            @class(['absolute inset-0 flex flex-col justify-end p-6 text-white transition-opacity duration-500 sm:p-9', 'opacity-0 pointer-events-none' => ! $loop->first])
                            @if (! $loop->first) aria-hidden="true" @endif>
                            <img src="{{ asset('images/'.$product['image']) }}" alt="" class="absolute inset-0 -z-0 size-full object-cover" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/5"></div>
                            <p class="absolute top-7 right-7 rounded-full bg-white px-4 py-2.5 text-[13px] text-muted sm:right-[52px]">Mulai <span class="font-bold text-ink">{{ $product['show_price'] }}</span></p>
                            <div class="relative">
                                <h3 class="text-4xl font-bold tracking-tight sm:text-[40px]">{{ $product['service'] }}</h3>
                                <p class="mt-5 max-w-[560px] text-[16px] leading-relaxed text-white/80">{{ $product['teaser'] }}</p>
                                <ul class="mt-5 flex flex-wrap gap-2">
                                    @foreach ($product['tags'] as $tag)
                                        <li class="rounded-full border border-white/30 bg-white/10 px-3.5 py-2 text-[13px] backdrop-blur">{{ $tag }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('services.show', $slug) }}" class="mt-6 inline-flex items-center gap-1.5 text-[15px] font-bold underline underline-offset-4 hover:text-brand">Lihat detail &amp; harga <x-icon name="arrow-up-right" /></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ============================== JANGKAUAN LAYANAN ============================== --}}
        <section class="mx-auto max-w-[1600px] px-4 pt-8 pb-24 sm:px-6 lg:px-10 lg:pb-32" aria-labelledby="coverage-title" data-coverage-map>
            <div class="flex flex-col gap-10 lg:flex-row lg:items-end lg:justify-between">
                <div class="relative" data-reveal>
                    <x-site.eyebrow>Jangkauan layanan</x-site.eyebrow>
                    <h2 id="coverage-title" class="mt-5 text-[34px] leading-[1.02] font-medium tracking-[-0.03em] sm:text-[64px]">Pusat di Tangerang<br>&amp; Purwokerto.</h2>
                    <x-icon name="sparkle" class="absolute right-[-48px] bottom-8 hidden size-7 animate-float text-brand lg:block" />
                </div>
                <div class="flex flex-col items-start gap-6 lg:items-end" data-reveal>
                    <p class="hidden text-sm text-muted/60 lg:block">(04)</p>
                    <dl class="grid grid-cols-3 divide-x divide-line border-l border-line">
                        @foreach ([['2 Pusat', 'Tangerang & Purwokerto'], ['10+ Area', 'Tangerang Raya & Barlingmascakeb'], ['Gratis', 'Transport & survei area pusat']] as [$value, $label])
                            <div class="px-3 sm:px-5">
                                <dt class="sr-only">{{ $label }}</dt>
                                <dd class="text-[26px] font-medium tracking-tight sm:text-[38px]">{{ $value }}</dd>
                                <dd class="mt-1 text-[13px] text-muted sm:text-sm">{{ $label }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>

            <div class="relative mt-14 overflow-hidden rounded-[24px] border border-line bg-cream sm:rounded-[32px]" data-reveal>
                <div class="relative aspect-[1280/560] w-full select-none">
                    <svg class="absolute inset-0 size-full" viewBox="0 0 1280 560" aria-hidden="true">
                        <defs>
                            <radialGradient id="hub-aura" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#ff5a1f" stop-opacity="0.34" />
                                <stop offset="55%" stop-color="#ff5a1f" stop-opacity="0.1" />
                                <stop offset="100%" stop-color="#ff5a1f" stop-opacity="0" />
                            </radialGradient>
                            <linearGradient id="corridor-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ff5a1f" />
                                <stop offset="50%" stop-color="#ffab8c" />
                                <stop offset="100%" stop-color="#ff5a1f" />
                            </linearGradient>
                        </defs>

                        {{-- Coordinate Grid --}}
                        <g stroke="var(--color-line)" stroke-dasharray="4 6">
                            @foreach ([196, 428, 659, 890, 1122] as $x)
                                <path d="M{{ $x }} 20v480" />
                            @endforeach
                            @foreach ([178, 294, 410] as $y)
                                <path d="M0 {{ $y }}h1280" />
                            @endforeach
                        </g>
                        <g class="hidden fill-[#b9b5ad] text-[11px] sm:block" font-size="11">
                            @foreach ([196 => '106°BT', 428 => '108°BT', 659 => '110°BT', 890 => '112°BT', 1122 => '114°BT'] as $x => $label)
                                <text x="{{ $x - 16 }}" y="30">{{ $label }}</text>
                            @endforeach
                            @foreach ([178 => '6°LS', 294 => '7°LS', 410 => '8°LS'] as $y => $label)
                                <text x="1236" y="{{ $y - 4 }}">{{ $label }}</text>
                            @endforeach
                        </g>

                        {{-- Java Island Dot Matrix --}}
                        @include('partials.java-map-dots')

                        {{-- Dual-Hub Backbone Corridor: Tangerang (239.5, 213.5) ⇄ Purwokerto (577.5, 330.5) --}}
                        <g data-map-corridor>
                            <path d="M 239.5 213.5 C 365 110, 470 155, 577.5 330.5" fill="none" stroke="#ffab8c" stroke-width="1.5" stroke-dasharray="4 6" opacity="0.7" />
                            <path d="M 239.5 213.5 C 365 110, 470 155, 577.5 330.5" fill="none" stroke="url(#corridor-gradient)" stroke-width="2.5" stroke-dasharray="10 14" stroke-linecap="round" class="animate-map-flow" />
                            <circle r="4.5" fill="#ff5a1f">
                                <animateMotion dur="4.2s" repeatCount="indefinite" path="M 239.5 213.5 C 365 110, 470 155, 577.5 330.5" />
                            </circle>
                            <circle r="3.5" fill="#111214">
                                <animateMotion dur="4.2s" begin="2.1s" repeatCount="indefinite" path="M 577.5 330.5 C 470 155, 365 110, 239.5 213.5" />
                            </circle>
                        </g>

                        {{-- Zone 1 Animated SVG Radar & Spokes: Pusat Tangerang (239.5, 213.5) --}}
                        <g data-map-zone-svg="tangerang">
                            <circle cx="239.5" cy="213.5" r="105" fill="url(#hub-aura)" />
                            <circle cx="239.5" cy="213.5" r="76" fill="none" stroke="#ff5a1f" stroke-opacity="0.35" stroke-width="1.2" stroke-dasharray="5 7" class="origin-[239.5px_213.5px] animate-spin-slow" />
                            <circle cx="239.5" cy="213.5" r="28" fill="none" stroke="#ff5a1f" stroke-width="1.5" class="origin-[239.5px_213.5px] animate-map-radar" />
                            <circle cx="239.5" cy="213.5" r="28" fill="none" stroke="#ff5a1f" stroke-width="1.5" class="origin-[239.5px_213.5px] animate-map-radar" style="animation-delay: -1.5s" />
                            @foreach ([[252.5, 252.5], [200.5, 239.5], [174.5, 200.5], [291.5, 200.5]] as [$tx, $ty])
                                <line x1="239.5" y1="213.5" x2="{{ $tx }}" y2="{{ $ty }}" stroke="#ff5a1f" stroke-opacity="0.55" stroke-width="1.6" stroke-dasharray="4 6" class="animate-map-dash" />
                            @endforeach
                        </g>

                        {{-- Zone 2 Animated SVG Radar & Spokes: Pusat Purwokerto (577.5, 330.5) --}}
                        <g data-map-zone-svg="purwokerto">
                            <circle cx="577.5" cy="330.5" r="110" fill="url(#hub-aura)" />
                            <circle cx="577.5" cy="330.5" r="82" fill="none" stroke="#ff5a1f" stroke-opacity="0.35" stroke-width="1.2" stroke-dasharray="5 7" class="origin-[577.5px_330.5px] animate-spin-slow" />
                            <circle cx="577.5" cy="330.5" r="28" fill="none" stroke="#ff5a1f" stroke-width="1.5" class="origin-[577.5px_330.5px] animate-map-radar" style="animation-delay: -0.7s" />
                            <circle cx="577.5" cy="330.5" r="28" fill="none" stroke="#ff5a1f" stroke-width="1.5" class="origin-[577.5px_330.5px] animate-map-radar" style="animation-delay: -2.2s" />
                            @foreach ([[577.5, 369.5], [603.5, 317.5], [538.5, 369.5], [629.5, 369.5]] as [$px, $py])
                                <line x1="577.5" y1="330.5" x2="{{ $px }}" y2="{{ $py }}" stroke="#ff5a1f" stroke-opacity="0.55" stroke-width="1.6" stroke-dasharray="4 6" class="animate-map-dash" />
                            @endforeach
                        </g>

                        {{-- Active Selection Beam & Target Reticle --}}
                        <line data-map-active-line x1="239.5" y1="213.5" x2="239.5" y2="213.5" stroke="#111214" stroke-width="2.2" stroke-dasharray="5 5" class="animate-map-dash transition-all duration-500" />
                        <g data-map-reticle style="transform: translate(239.5px, 213.5px)" class="transition-transform duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]">
                            <circle r="24" fill="none" stroke="#111214" stroke-width="1.4" stroke-dasharray="4 4" class="animate-spin-slow" />
                            <circle r="15" fill="#ff5a1f" fill-opacity="0.16" />
                        </g>
                    </svg>

                    {{-- Interactive Pins (2 Hubs + 8 Target Areas) --}}
                    @foreach ($mapLocations as $index => $loc)
                        <div class="absolute size-0" style="{{ $pct(...$loc['pin']) }}" data-map-pin-wrapper data-zone="{{ $loc['zone'] }}">
                            <button
                                type="button"
                                data-map-pin="{{ $loc['id'] }}"
                                data-index="{{ $index }}"
                                data-name="{{ $loc['name'] }}"
                                data-zone="{{ $loc['zone'] }}"
                                data-is-hub="{{ $loc['is_hub'] ? 'true' : 'false' }}"
                                data-x="{{ $loc['pin'][0] }}"
                                data-y="{{ $loc['pin'][1] }}"
                                data-hub-x="{{ $loc['hub_pin'][0] }}"
                                data-hub-y="{{ $loc['hub_pin'][1] }}"
                                aria-label="{{ $loc['name'] }}"
                                aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                                class="group/pin relative -translate-1/2 cursor-pointer focus:outline-none">
                                @if ($loc['is_hub'])
                                    <span class="pointer-events-none absolute top-1/2 left-1/2 size-12 -translate-1/2 animate-pulse-ring rounded-full bg-brand/35 sm:size-16"></span>
                                    <span data-pin-dot class="relative grid size-6 place-items-center rounded-full bg-brand text-white shadow-lg ring-3 ring-white transition-transform duration-300 group-hover/pin:scale-125 group-aria-pressed/pin:scale-125 group-aria-pressed/pin:ring-ink sm:size-8 sm:ring-4">
                                        <svg viewBox="0 0 24 24" class="size-3 sm:size-4" aria-hidden="true"><path d="M12 5 21 19H3z" fill="currentColor"/></svg>
                                    </span>
                                @else
                                    <span data-pin-dot class="relative block size-3.5 rounded-full border-[2.5px] border-ink bg-white shadow-md transition-all duration-300 group-hover/pin:scale-125 group-hover/pin:border-brand group-hover/pin:bg-brand group-aria-pressed/pin:scale-135 group-aria-pressed/pin:border-white group-aria-pressed/pin:bg-brand sm:size-4"></span>
                                @endif

                                <span data-pin-label @class([
                                    'pointer-events-none absolute hidden items-center gap-1.5 rounded-full px-3 py-1 text-[12px] font-bold whitespace-nowrap shadow-[0_6px_16px_rgba(17,18,20,0.12)] transition-all duration-300 md:inline-flex',
                                    'bg-ink text-white group-aria-pressed/pin:bg-brand' => $loc['is_hub'],
                                    'bg-white text-ink group-hover/pin:bg-ink group-hover/pin:text-white group-aria-pressed/pin:bg-brand group-aria-pressed/pin:text-white' => ! $loc['is_hub'],
                                    'bottom-full left-1/2 mb-2 -translate-x-1/2' => $loc['label'] === 'above',
                                    'top-full left-1/2 mt-2 -translate-x-1/2' => $loc['label'] === 'below',
                                    'top-1/2 left-full ml-2.5 -translate-y-1/2' => $loc['label'] === 'right',
                                    'top-1/2 right-full mr-2.5 -translate-y-1/2' => $loc['label'] === 'left',
                                ])>
                                    @if ($loc['is_hub'])
                                        <span class="size-1.5 rounded-full bg-brand group-aria-pressed/pin:bg-white"></span>
                                        Pusat {{ $loc['name'] }}
                                    @else
                                        {{ $loc['name'] }}
                                    @endif
                                </span>
                            </button>
                        </div>
                    @endforeach

                    {{-- Map Legend Bar (Desktop) --}}
                    <div class="absolute bottom-[5%] left-[3%] hidden flex-wrap items-center gap-6 rounded-full bg-[#f1efea] p-1.5 pr-6 text-sm lg:flex">
                        <span class="flex items-center gap-2.5 rounded-full bg-white px-4 py-2.5 font-bold shadow-sm"><span class="size-2.5 rounded-full bg-brand"></span>Pusat Tangerang &amp; Purwokerto · gratis transport</span>
                        <span class="flex items-center gap-2.5 text-muted"><span class="size-2.5 rounded-full bg-peach"></span>Banyumas, Purbalingga, Cilacap, Kebumen &amp; Tangerang Raya</span>
                        <span class="flex items-center gap-2.5 text-muted"><span class="size-2.5 rounded-full bg-ink/30"></span>Wilayah Jawa lainnya · by request</span>
                    </div>

                    <div class="absolute right-[3%] bottom-[6%] hidden items-end gap-6 lg:flex" aria-hidden="true">
                        <div class="text-xs text-[#a9a59d]">
                            <span class="block h-2 w-[104px] border-x border-b border-[#a9a59d]"></span>
                            <span class="mt-1.5 block">100 km</span>
                        </div>
                        <span class="grid size-7 place-items-center rounded-full bg-brand-50 text-[11px] font-bold text-brand">U</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-3 text-sm text-muted lg:hidden">
                <div class="flex flex-wrap gap-x-5 gap-y-2">
                    <span class="flex items-center gap-2"><span class="size-2.5 rounded-full bg-brand"></span>Pusat Tangerang &amp; Purwokerto · gratis transport</span>
                    <span class="flex items-center gap-2"><span class="size-2.5 rounded-full bg-peach"></span>Banyumas, Purbalingga, Cilacap, Kebumen &amp; Tangerang Raya</span>
                    <span class="flex items-center gap-2"><span class="size-2.5 rounded-full bg-ink/30"></span>Wilayah Jawa lainnya · by request</span>
                </div>
                <p class="md:hidden">Titik layanan: {{ collect($mapLocations)->pluck('name')->join(' · ') }}.</p>
            </div>
        </section>
    </div>

    <x-site.cta class="pb-16 lg:pb-[60px]" />
</x-layout>
