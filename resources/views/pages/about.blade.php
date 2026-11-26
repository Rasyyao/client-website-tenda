@php
    $milestones = [
        ['year' => '2012', 'text' => 'Mulai dari 5 tenda sarnafil untuk hajatan, bazar, & acara warga.'],
        ['year' => '2016', 'text' => 'Ekspansi ke tenda roder bentang lebar, gudang 4.000 m², dan armada truk sendiri.'],
        ['year' => '2019', 'text' => 'Hadirkan divisi FOH sound system, lighting, dan stage untuk konser & event korporat.'],
        ['year' => '2023', 'text' => 'Dipercaya menangani tenda & full produksi festival 20.000 penonton.'],
        ['year' => '2026', 'text' => 'Melayani sewa tenda segala acara & produksi konser di seluruh Pulau Jawa.'],
    ];

    $missions = [
        ['title' => 'Tepat waktu', 'text' => 'Tenda dan perlengkapan berdiri siap pakai sebelum jadwal acara atau loading panggung — tanpa alasan.'],
        ['title' => 'Aman & terukur', 'text' => 'Struktur dihitung, kru bersertifikat K3, dan peralatan diasuransikan.'],
        ['title' => 'Harga transparan', 'text' => 'Price list terbuka untuk semua orang, tanpa biaya tersembunyi di akhir.'],
        ['title' => 'Tumbuh bersama', 'text' => 'Investasi unit tenda baru, teknologi panggung, dan pelatihan kru setiap tahun untuk segala skala event.'],
    ];

    $terms = [
        ['title' => 'Pemesanan & uang muka', 'text' => 'Pemesanan dianggap sah setelah DP 50% dari total penawaran kami terima. Setelah itu, tanggal dan unit dikunci khusus untuk acara Anda.', 'points' => ['DP dibayar maksimal 3 hari setelah penawaran disetujui', 'Pelunasan paling lambat H-1 sebelum acara', 'Pembayaran via transfer ke rekening resmi perusahaan']],
        ['title' => 'Pembatalan & perubahan jadwal', 'text' => 'Perubahan jadwal bisa dilakukan tanpa biaya selama unit masih tersedia di tanggal baru. Pembatalan mengikuti ketentuan pengembalian DP.', 'points' => ['Pembatalan H-14 atau lebih: DP kembali 50%', 'Pembatalan kurang dari H-14: DP hangus', 'Reschedule maksimal 1 kali tanpa biaya']],
        ['title' => 'Akses venue & listrik', 'text' => 'Penyewa memastikan akses kendaraan ke lokasi pemasangan dan izin penggunaan lahan dari pengelola venue.', 'points' => ['Akses truk minimal 3 meter ke titik bongkar', 'Sumber listrik atau genset disepakati saat survei', 'Izin keramaian menjadi tanggung jawab penyewa']],
        ['title' => 'Kerusakan & kehilangan', 'text' => 'Peralatan diasuransikan selama masa sewa. Kerusakan akibat kelalaian di luar pengoperasian kru kami ditanggung penyewa sesuai nilai perbaikan.', 'points' => ['Pengecekan kondisi alat bersama saat serah terima', 'Kehilangan unit diganti sesuai harga pasar', 'Kerusakan karena cuaca ekstrem ditanggung asuransi']],
        ['title' => 'Cuaca & keadaan kahar', 'text' => 'Untuk keselamatan, kru berhak menurunkan atap atau menghentikan operasional alat saat angin melebihi batas aman struktur.', 'points' => ['Batas angin mengikuti spesifikasi tiap unit', 'Keadaan kahar dibahas ulang tanpa denda', 'Jadwal pengganti diprioritaskan']],
        ['title' => 'Durasi sewa & overtime', 'text' => 'Harga sewa dihitung per hari acara, tidak termasuk hari pemasangan dan pembongkaran.', 'points' => ['1 hari sewa = maksimal 14 jam operasional', 'Overtime operator dihitung per jam', 'Perpanjangan hari mengikuti harga harian']],
    ];
@endphp

<x-layout title="Tentang Kami">
    <x-site.page-hero
        image="heart-hands.jpg"
        badge="Tentang Pratama Jaya · berdiri sejak 2012"
        left-note="Berdiri sejak 2012"
        right-note="650+ konser & acara di Jawa"
        scroll-label="Scroll untuk kenal kami"
        scroll-target="#profil">
        <x-slot:title>Tentang Kami<span class="text-brand">.</span></x-slot:title>
        <x-slot:subtitle>Sejak 2012 kami menyediakan tenda dan produksi panggung untuk 650+ acara — mulai dari konser &amp; festival musik, pameran, event korporat, hingga resepsi besar, dikerjakan kru kami sendiri dari survei sampai bongkar.</x-slot:subtitle>
        <x-slot:actions>
            <a href="#profil" class="group inline-flex items-center justify-center gap-2 rounded-full bg-brand px-7 py-4 text-[17px] font-bold transition-colors hover:bg-brand-600">
                Kenali Kami <x-icon name="arrow-down" class="transition-transform group-hover:translate-y-0.5" />
            </a>
            <a href="#" class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-7 py-4 text-[17px] font-bold backdrop-blur transition-colors hover:bg-white/20">Profil Perusahaan (PDF)</a>
        </x-slot:actions>
    </x-site.page-hero>

    {{-- ============================== COMPANY PROFILE ============================== --}}
    <section id="profil" class="mx-auto max-w-[1600px] scroll-mt-20 px-4 pt-24 pb-24 sm:px-6 lg:px-10 lg:pt-[120px]" aria-labelledby="profile-title">
        <div class="grid gap-8 lg:grid-cols-[1fr_420px]">
            <div data-reveal>
                <x-site.eyebrow number="01">Company profile</x-site.eyebrow>
                <h2 id="profile-title" class="mt-5 text-[38px] leading-[1.02] font-medium tracking-[-0.03em] sm:text-[60px]">Dari 5 tenda sarnafil, jadi mitra tenda &amp; produksi event skala besar.</h2>
            </div>
            <div data-reveal style="--reveal-delay:100ms">
                <p class="text-lg leading-relaxed">Pratama Jaya Tenda berdiri tahun 2012, berawal dari penyewaan tenda untuk hajatan, bazar, dan acara warga hingga kini memiliki dua pusat operasional di Tangerang dan Purwokerto.</p>
                <p class="mt-5 text-[16px] leading-relaxed text-muted">Hari ini kami menjadi vendor utama untuk produksi konser &amp; festival musik, sekaligus melayani sewa tenda untuk pameran, gathering korporat, wisuda kampus, dan resepsi outdoor di wilayah Tangerang Raya, Banyumas, Purbalingga, Cilacap, hingga Kebumen — dengan unit milik sendiri.</p>
            </div>
        </div>

        <div class="mt-14 grid gap-6 lg:grid-cols-[1fr_400px]">
            <div class="group relative min-h-[320px] overflow-hidden rounded-[28px] sm:min-h-[480px]" data-reveal>
                <img src="{{ asset('images/stage-blue.jpg') }}" alt="Panggung festival dengan rigging truss dan ribuan penonton" class="absolute inset-0 size-full object-cover transition-transform duration-[1.2s] group-hover:scale-105" loading="lazy">
                <p class="absolute bottom-6 left-6 flex items-center gap-2.5 rounded-full bg-white px-4 py-2.5 text-[15px] font-medium"><span class="size-2.5 rounded-full bg-brand"></span>Workshop &amp; gudang · Tangerang &amp; Purwokerto</p>
            </div>
            <dl class="grid grid-cols-2 gap-4 sm:gap-4">
                @foreach ([
                    ['label' => 'Tahun berdiri', 'value' => '2012', 'class' => 'bg-brand text-white', 'labelClass' => 'text-white/85', 'count' => null],
                    ['label' => 'Konser & event sukses', 'value' => '650+', 'class' => 'bg-ink text-white', 'labelClass' => 'text-white/70', 'count' => 650],
                    ['label' => 'Kru & teknisi tetap', 'value' => '80+', 'class' => 'border border-line bg-cream', 'labelClass' => 'text-ink/75', 'count' => 80],
                    ['label' => 'Gudang peralatan', 'value' => '4.000 m²', 'class' => 'border border-line bg-cream', 'labelClass' => 'text-ink/75', 'count' => null],
                ] as $index => $stat)
                    <div class="flex min-h-[180px] flex-col justify-between rounded-[24px] p-6 sm:min-h-[232px] {{ $stat['class'] }}" data-reveal style="--reveal-delay: {{ $index * 90 }}ms">
                        <dt class="text-[15px] {{ $stat['labelClass'] }}">{{ $stat['label'] }}</dt>
                        <dd class="text-[34px] font-medium tracking-tight sm:text-[42px]" @if ($stat['count']) data-count-to="{{ $stat['count'] }}" data-count-suffix="+" @endif>{{ $stat['value'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>

        <ol class="relative mt-16 grid gap-8 lg:mt-20 lg:grid-cols-5 lg:gap-6" data-steps>
            <li role="presentation" class="pointer-events-none absolute top-[6px] right-0 left-0 hidden h-[2px] bg-line lg:block" aria-hidden="true">
                <span class="absolute inset-y-0 left-0 block w-full origin-left scale-x-0 bg-brand transition-transform duration-[1800ms] ease-out" data-steps-line></span>
            </li>
            @foreach ($milestones as $index => $milestone)
                @php $isCurrent = $loop->last; @endphp
                <li class="relative pl-9 lg:pl-0" data-reveal style="--reveal-delay: {{ $index * 120 }}ms">
                    @if (! $loop->last)
                        <span class="pointer-events-none absolute top-[14px] -bottom-[46px] left-[6px] w-[2px] bg-line lg:hidden" aria-hidden="true">
                            <span class="block size-full origin-top scale-y-0 bg-brand transition-transform duration-700 ease-out" style="transition-delay: {{ $index * 150 }}ms" data-steps-line-y></span>
                        </span>
                    @endif
                    <span @class([
                        'absolute top-[7px] left-0 z-10 block size-3.5 rounded-full lg:static',
                        'bg-brand ring-4 ring-brand/15 lg:ring-0' => $isCurrent,
                        'border-2 border-brand bg-white' => ! $isCurrent,
                    ])></span>
                    <p @class([
                        'text-[28px] leading-none font-medium tracking-tight sm:text-[30px] lg:mt-9 lg:leading-normal',
                        'text-brand' => $isCurrent,
                    ])>{{ $milestone['year'] }}</p>
                    <p class="mt-2.5 max-w-md text-[15px] leading-relaxed text-muted lg:mt-4 lg:max-w-[230px]">{{ $milestone['text'] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- ============================== VISI & MISI ============================== --}}
    <section class="relative overflow-hidden bg-cream py-24 lg:py-[120px]" aria-labelledby="vision-title">
        <svg class="pointer-events-none absolute top-8 right-0 w-[720px] max-w-full" viewBox="0 0 720 120" fill="none" aria-hidden="true">
            <path d="M0 70c120-50 240-50 360 0s240 50 360-30" stroke="var(--color-line)" stroke-width="1.4" />
            <path d="M0 90c140-60 260-20 380 10s220 10 340-60" stroke="var(--color-peach)" stroke-opacity=".7" stroke-width="1.4" />
        </svg>
        <div class="mx-auto max-w-[1600px] px-4 sm:px-6 lg:px-10">
            <div class="grid gap-8 lg:grid-cols-[296px_1fr]">
                <div data-reveal>
                    <x-site.eyebrow number="02">Visi &amp; Misi</x-site.eyebrow>
                    <svg class="mt-6 h-12 w-16 text-brand" viewBox="0 0 64 48" aria-hidden="true"><path fill="currentColor" d="M0 48V30C0 14 7 4 22 0l3 7C16 11 13 17 13 24h11v24zm36 0V30c0-16 7-26 22-30l3 7c-9 4-12 10-12 17h11v24z"/></svg>
                </div>
                <div data-reveal style="--reveal-delay:100ms">
                    <p class="text-[13px] font-bold tracking-[0.18em] text-muted/80 uppercase">Visi kami</p>
                    <h2 id="vision-title" class="mt-5 text-[30px] leading-[1.22] font-medium tracking-[-0.02em] sm:text-[48px]">Menjadi mitra sewa tenda dan produksi panggung yang paling bisa diandalkan di Indonesia — <span class="text-brand">tepat waktu, aman, dan transparan</span> dari acara intim hingga konser &amp; festival besar.</h2>
                </div>
            </div>

            <div class="mt-16 flex flex-col gap-2 border-t border-line pt-12 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <h3 class="text-[32px] font-medium tracking-tight">Misi kami</h3>
                <p class="text-[15px] text-muted">Empat janji yang kami pegang di setiap proyek</p>
            </div>
            <ul class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($missions as $index => $mission)
                    <li @class([
                        'group rounded-[24px] p-7 transition-all duration-300 hover:-translate-y-1.5',
                        'bg-ink text-white' => $loop->last,
                        'border border-line bg-white hover:shadow-xl hover:shadow-black/5' => ! $loop->last,
                    ]) data-reveal style="--reveal-delay: {{ $index * 90 }}ms">
                        <p class="text-[15px] font-bold text-brand">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        <h4 class="mt-5 text-[22px] font-medium tracking-tight">{{ $mission['title'] }}</h4>
                        <p @class(['mt-4 text-[14px] leading-relaxed', 'text-white/65' => $loop->last, 'text-muted' => ! $loop->last])>{{ $mission['text'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- ============================== SYARAT & KETENTUAN ============================== --}}
    <section class="mx-auto grid max-w-[1600px] gap-12 px-4 pt-24 pb-28 sm:px-6 lg:grid-cols-[420px_1fr] lg:gap-16 lg:px-10 lg:pt-[120px] lg:pb-[150px]" aria-labelledby="terms-title">
        <div class="lg:sticky lg:top-28 lg:self-start" data-reveal>
            <x-site.eyebrow number="03">Syarat &amp; ketentuan</x-site.eyebrow>
            <h2 id="terms-title" class="mt-5 text-[40px] leading-[1.02] font-medium tracking-[-0.03em] sm:text-[52px]">Aturan main yang jelas sejak awal.</h2>
            <p class="mt-6 text-[16px] leading-relaxed text-muted">Kami ingin setiap klien tahu persis apa yang disepakati — supaya tidak ada kejutan di hari acara.</p>
            <a href="#" class="mt-7 inline-flex items-center gap-2 rounded-full border-[1.5px] border-ink px-6 py-3.5 text-[15px] font-bold transition-colors hover:bg-ink hover:text-white">Unduh S&amp;K lengkap (PDF) <x-icon name="arrow-down" /></a>
            <p class="mt-7 text-[13px] text-muted/80">Terakhir diperbarui: Januari 2026</p>
        </div>

        <div class="border-t border-line lg:border-t-0" data-accordion data-reveal>
            @foreach ($terms as $index => $term)
                @php $isOpen = $loop->first; @endphp
                <div @class(['border-b transition-colors', 'border-line' => ! $isOpen, 'rounded-[24px] border-transparent bg-cream' => $isOpen]) data-accordion-item>
                    <h3>
                        <button type="button" class="flex w-full items-center gap-6 px-6 py-6 text-left" aria-expanded="{{ $isOpen ? 'true' : 'false' }}" aria-controls="term-{{ $index }}" id="term-button-{{ $index }}" data-accordion-trigger>
                            <span class="w-6 text-[15px] font-bold text-brand">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="flex-1 text-[19px] font-medium sm:text-[22px]">{{ $term['title'] }}</span>
                            <span @class([
                                'grid size-10 shrink-0 place-items-center rounded-full border transition-colors duration-300',
                                'border-brand bg-brand text-white' => $isOpen,
                                'border-line bg-white' => ! $isOpen,
                            ]) data-accordion-icon>
                                <x-icon name="plus" :class="$isOpen ? 'hidden size-4' : 'size-4'" data-accordion-plus />
                                <x-icon name="minus" :class="$isOpen ? 'size-4' : 'hidden size-4'" data-accordion-minus />
                            </span>
                        </button>
                    </h3>
                    <div id="term-{{ $index }}" role="region" aria-labelledby="term-button-{{ $index }}" class="grid transition-[grid-template-rows] duration-500 ease-out {{ $isOpen ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}" data-accordion-panel>
                        <div class="overflow-hidden">
                            <div class="pr-6 pb-8 pl-[72px] sm:pr-20">
                                <p class="text-[16px] leading-relaxed text-muted">{{ $term['text'] }}</p>
                                <ul class="mt-4 space-y-2.5 text-[15px]">
                                    @foreach ($term['points'] as $point)
                                        <li class="flex gap-3"><span class="mt-2 size-1.5 shrink-0 rounded-full bg-brand"></span>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-site.cta class="pb-16 lg:pb-[60px]" />
</x-layout>
