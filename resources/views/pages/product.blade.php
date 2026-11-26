@php
    $rupiah = fn (?int $amount): string => $amount === null ? 'Hubungi kami' : 'Rp '.number_format($amount, 0, ',', '.');
    $pricedRows = collect($product['prices'])->filter(fn (array $row): bool => $row['daily'] !== null)->values();
    $defaultRow = $pricedRows->firstWhere('popular', true) ?? $pricedRows->first();
    $whatsappBase = 'https://wa.me/'.config('site.whatsapp').'?text=';
    $orderMessage = fn (string $size): string => $whatsappBase.rawurlencode("Halo Pratama Jaya, saya ingin pesan {$product['name']} ukuran {$size}.");
    $extraPhotos = count($product['gallery']) - 4;
@endphp

<x-layout :title="$product['name']" :description="$product['description']">
    <x-site.nav :dark="false" />

    <div class="mx-auto max-w-[1600px] px-4 sm:px-6 lg:px-10">
        <nav class="mt-10 flex flex-wrap items-center gap-2 text-[15px] text-muted" aria-label="Breadcrumb">
            <a href="{{ route('services') }}" class="inline-flex items-center gap-2 hover:text-ink"><x-icon name="arrow-left" class="size-3.5" />Layanan &amp; Harga</a>
            <span class="text-line">/</span>
            <a href="{{ route('services') }}#katalog" class="hover:text-ink">{{ $categoryName }}</a>
            <span class="text-line">/</span>
            <span class="font-bold text-ink" aria-current="page">{{ $product['name'] }}</span>
        </nav>
    </div>

    {{-- ============================== PRODUCT HERO ============================== --}}
    <section class="mx-auto mt-6 grid max-w-[1600px] gap-10 px-4 pb-24 sm:px-6 lg:grid-cols-[1.1fr_1fr] lg:gap-12 lg:px-10" data-gallery>
        <div data-reveal>
            <div class="relative aspect-[700/540] overflow-hidden rounded-[28px] bg-ink">
                @foreach ($product['gallery'] as $index => $photo)
                    <img src="{{ asset('images/'.$photo) }}" alt="{{ $product['name'] }} — foto {{ $index + 1 }}" data-gallery-image
                        @class(['absolute inset-0 size-full object-cover transition-opacity duration-500', 'opacity-0' => $index !== 0])
                        @if ($index > 0) loading="lazy" @endif>
                @endforeach
                <span class="absolute top-5 left-5 rounded-full bg-white px-3 py-1.5 text-[13px] font-bold"><span data-gallery-current>1</span> / {{ count($product['gallery']) }} foto</span>
                <button type="button" class="group absolute bottom-5 left-5 inline-flex items-center gap-3 rounded-full border border-white/25 bg-white/15 py-2 pr-5 pl-2 text-[15px] font-medium text-white backdrop-blur-md transition-colors hover:bg-white/25">
                    <span class="grid size-8 place-items-center rounded-full bg-brand transition-transform group-hover:scale-110"><x-icon name="play" class="size-3.5" /></span>
                    Video proses pasang · 00:48
                </button>
            </div>
            <div class="mt-4 grid grid-cols-4 gap-3 sm:gap-4">
                @foreach (array_slice($product['gallery'], 0, 4) as $index => $photo)
                    <button type="button" data-gallery-thumb="{{ $index }}" aria-label="Lihat foto {{ $index + 1 }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        class="relative aspect-[163/112] overflow-hidden rounded-2xl ring-brand ring-offset-2 transition aria-current:ring-[3px] sm:rounded-[18px]">
                        <img src="{{ asset('images/'.$photo) }}" alt="" class="size-full object-cover transition-transform duration-500 hover:scale-110" loading="lazy">
                        @if ($index === 3 && $extraPhotos > 0)
                            <span class="absolute inset-0 grid place-items-center bg-black/45 text-lg font-medium text-white" data-gallery-more>+{{ $extraPhotos }} foto</span>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        <div data-reveal style="--reveal-delay:120ms">
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <x-site.eyebrow>{{ $product['kicker'] }}</x-site.eyebrow>
                @isset($product['badge'])
                    <span class="inline-flex items-center gap-1 rounded-full bg-brand-50 px-2.5 py-1 text-[13px] font-bold text-brand"><x-icon name="star" class="size-3" />{{ $product['badge'] }}</span>
                @endisset
            </div>
            <h1 class="mt-5 text-[52px] leading-none font-medium tracking-[-0.04em] sm:text-[72px]">{{ $product['name'] }}</h1>
            <p class="mt-6 flex flex-wrap items-center gap-x-2.5 gap-y-1 text-[15px] text-ink/75">
                @foreach ($product['stats'] as $stat)
                    @if (! $loop->first)<span aria-hidden="true">·</span>@endif
                    <span>{{ $stat }}</span>
                @endforeach
            </p>
            <p class="mt-6 text-[17px] leading-relaxed text-muted">{{ $product['description'] }}</p>

            <dl class="mt-6 grid grid-cols-2 gap-2.5 sm:grid-cols-3">
                @foreach ($product['specs'] as $label => $value)
                    <div class="rounded-2xl bg-sand px-4 py-3.5">
                        <dt class="text-[13px] text-muted">{{ $label }}</dt>
                        <dd class="mt-1 text-[18px] font-medium">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>

            @if ($defaultRow)
                <div class="mt-6 rounded-[24px] border border-line p-6" data-estimator
                    data-rows='@json($pricedRows->map(fn ($row) => ['label' => $row['label'], 'daily' => $row['daily'], 'package' => $row['package']]))'
                    data-whatsapp="{{ $whatsappBase }}" data-product="{{ $product['name'] }}">
                    <div class="flex items-baseline justify-between gap-4">
                        <h2 class="text-lg font-bold">Estimasi cepat</h2>
                        <p class="text-[13px] text-muted">Area Tangerang &amp; Purwokerto</p>
                    </div>
                    <div class="mt-4 grid gap-2.5 sm:grid-cols-2">
                        <label class="relative block rounded-2xl bg-sand px-4 pt-2.5 pb-2">
                            <span class="block text-[13px] text-muted">{{ $product['price_columns'][0] }}</span>
                            <select data-estimator-size class="w-full cursor-pointer appearance-none bg-transparent pr-6 text-lg font-medium focus:outline-none">
                                @foreach ($pricedRows as $row)
                                    <option value="{{ $loop->index }}" @selected($row === $defaultRow)>{{ $row['label'] }}</option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute right-4 bottom-4 size-2.5" viewBox="0 0 10 6" aria-hidden="true"><path d="M0 0h10L5 6z" fill="currentColor"/></svg>
                        </label>
                        <div class="rounded-2xl bg-sand px-4 pt-2.5 pb-2">
                            <span class="block text-[13px] text-muted" id="duration-label">Durasi</span>
                            <div class="flex items-center gap-4 text-lg font-medium" role="group" aria-labelledby="duration-label">
                                <button type="button" data-estimator-minus class="grid size-7 place-items-center rounded-full hover:bg-white" aria-label="Kurangi hari"><x-icon name="minus" /></button>
                                <output data-estimator-days aria-live="polite">1 hari</output>
                                <button type="button" data-estimator-plus class="grid size-7 place-items-center rounded-full hover:bg-white" aria-label="Tambah hari"><x-icon name="plus" /></button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex items-end justify-between gap-4 border-t border-line pt-6">
                        <div>
                            <p class="text-[15px] text-muted">Estimasi total</p>
                            <p class="text-[13px] text-muted/80">Termasuk pasang &amp; bongkar</p>
                        </div>
                        <p class="text-[30px] font-medium tracking-tight tabular-nums sm:text-4xl" data-estimator-total aria-live="polite">{{ $rupiah($defaultRow['daily']) }}</p>
                    </div>
                    <div class="mt-4 flex gap-2.5">
                        <a href="{{ $orderMessage($defaultRow['label']) }}" target="_blank" rel="noopener" data-estimator-order class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-brand px-6 py-3.5 text-[17px] font-bold text-white transition-colors hover:bg-brand-600">Pesan via WhatsApp <x-icon name="arrow-up-right" /></a>
                        <a href="#" class="inline-flex items-center gap-1.5 rounded-full border-[1.5px] border-ink px-5 py-3.5 text-[17px] font-bold transition-colors hover:bg-ink hover:text-white">PDF <x-icon name="arrow-down" /></a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ============================== PRICE LIST ============================== --}}
    <section class="bg-cream py-20 lg:py-28" aria-labelledby="pricelist-title">
        <div class="mx-auto max-w-[1600px] px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between" data-reveal>
                <div>
                    <x-site.eyebrow>Price list</x-site.eyebrow>
                    <h2 id="pricelist-title" class="mt-5 text-[40px] leading-[1.02] font-medium tracking-[-0.03em] sm:text-[64px]">Harga sewa {{ $product['name'] }}.</h2>
                    <p class="mt-4 max-w-[700px] text-[17px] leading-relaxed text-muted">Semua harga sudah termasuk pemasangan dan pembongkaran oleh kru kami. Ukuran lain bisa disesuaikan dengan venue.</p>
                </div>
                <div class="no-scrollbar -mx-5 overflow-x-auto px-5">
                    <div class="flex w-max gap-1 rounded-full border border-line bg-white p-1.5 text-[15px]" role="group" aria-label="Filter harga" data-price-filters>
                        @foreach ($product['price_filters'] as $key => $label)
                            <button type="button" data-price-filter="{{ $key }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}" class="rounded-full px-[18px] py-2.5 text-muted transition-colors hover:text-ink aria-pressed:bg-ink aria-pressed:font-bold aria-pressed:text-white">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-12 overflow-hidden rounded-[24px] border border-line bg-white" data-reveal>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[860px] text-left">
                        <thead class="bg-ink text-white">
                            <tr class="text-[12px] tracking-[0.16em] uppercase">
                                @foreach ($product['price_columns'] as $column)
                                    <th scope="col" class="px-7 py-4 font-bold">{{ $column }}</th>
                                @endforeach
                                <th scope="col" class="px-7 py-4 font-bold">Harga / hari</th>
                                <th scope="col" class="px-7 py-4 font-bold">Paket 3 hari</th>
                                <th scope="col" class="px-7 py-4"><span class="sr-only">Aksi</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product['prices'] as $row)
                                @php $isPopular = $row['popular'] ?? false; @endphp
                                <tr data-price-row data-group="{{ $row['group'] }}" @class(['border-t border-line transition-colors first:border-t-0', 'bg-brand-50' => $isPopular, 'hover:bg-cream' => ! $isPopular])>
                                    <th scope="row" class="px-7 py-6 text-xl font-medium whitespace-nowrap">
                                        {{ $row['label'] }}
                                        @if ($isPopular)
                                            <span class="ml-2 rounded-full bg-brand px-2.5 py-1 align-middle text-[12px] font-bold text-white">Paling dipilih</span>
                                        @endif
                                    </th>
                                    <td class="px-7 py-6 text-[16px] text-muted">{{ $row['area'] }}</td>
                                    <td class="px-7 py-6 text-[16px] text-muted">{{ $row['capacity'] }}</td>
                                    <td @class(['px-7 py-6 text-xl font-bold whitespace-nowrap', 'text-brand' => $isPopular])>{{ $rupiah($row['daily']) }}</td>
                                    <td class="px-7 py-6 text-[16px] whitespace-nowrap text-muted">{{ $rupiah($row['package']) }}</td>
                                    <td class="px-7 py-6 text-right">
                                        <a href="{{ $orderMessage($row['label']) }}" target="_blank" rel="noopener" @class([
                                            'inline-flex items-center gap-1 rounded-full px-4 py-2.5 text-[14px] font-bold whitespace-nowrap transition-colors',
                                            'bg-brand text-white hover:bg-brand-600' => $isPopular,
                                            'border-[1.5px] border-ink hover:bg-ink hover:text-white' => ! $isPopular,
                                        ])>{{ $row['daily'] === null ? 'Konsultasi' : 'Pesan' }} <x-icon name="arrow-up-right" class="size-3.5" /></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-7 flex flex-col gap-4 text-[15px] sm:flex-row sm:items-center sm:justify-between">
                <ul class="flex flex-wrap gap-x-7 gap-y-2">
                    @foreach (['Termasuk pasang & bongkar', 'Gratis transport Tangerang & Purwokerto', 'Survei venue gratis'] as $note)
                        <li class="flex items-center gap-2"><x-icon name="check" class="size-3.5" />{{ $note }}</li>
                    @endforeach
                </ul>
                <a href="#" class="inline-flex items-center gap-1.5 font-bold underline underline-offset-4 hover:text-brand">Unduh price list lengkap (PDF) <x-icon name="arrow-down" class="size-3.5" /></a>
            </div>

            @if (! empty($product['addons']))
                <div class="mt-24 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <h2 class="text-[32px] font-medium tracking-tight">Tambahan opsional</h2>
                    <p class="text-[15px] text-muted">Harga per hari, bisa ditambahkan ke ukuran mana pun</p>
                </div>
                <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($product['addons'] as $index => $addon)
                        <li class="flex items-center gap-4 rounded-[20px] border border-line bg-white px-6 py-5 transition-shadow hover:shadow-lg hover:shadow-black/5" data-reveal style="--reveal-delay: {{ ($index % 3) * 80 }}ms">
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg font-medium">{{ $addon['name'] }}</h3>
                                <p class="mt-0.5 truncate text-[14px] text-muted">{{ $addon['note'] }}</p>
                            </div>
                            <p class="text-right">
                                <span class="block text-lg font-bold whitespace-nowrap">{{ $rupiah($addon['price']) }}</span>
                                <span class="block text-[12px] text-muted">/ {{ $addon['unit'] }}</span>
                            </p>
                            <a href="{{ $whatsappBase.rawurlencode("Halo Pratama Jaya, saya ingin menambahkan {$addon['name']} untuk sewa {$product['name']}.") }}" target="_blank" rel="noopener" class="grid size-10 shrink-0 place-items-center rounded-full bg-sand text-brand transition-colors hover:bg-brand hover:text-white" aria-label="Tambah {{ $addon['name'] }}">
                                <x-icon name="plus" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
</x-layout>
