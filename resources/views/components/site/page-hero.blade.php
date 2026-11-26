@props([
    'image',
    'badge',
    'leftNote',
    'rightNote',
    'scrollLabel',
    'scrollTarget',
])

<x-site.nav />

<section class="p-3 sm:p-5">
    <div class="relative isolate flex min-h-[760px] flex-col overflow-hidden rounded-[28px] bg-ink px-4 pt-5 pb-8 text-white sm:min-h-[860px] sm:rounded-[32px] sm:px-7 sm:pt-9 lg:px-10">
        <img src="{{ asset('images/'.$image) }}" alt="" class="absolute inset-0 -z-20 size-full scale-105 object-cover blur-[2px]" data-parallax="0.12" fetchpriority="high">
        <div class="absolute inset-0 -z-10 bg-[#0d0a08]/70"></div>
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_center,transparent_10%,#0d0a08_80%)]"></div>

        {{-- concentric guide circles --}}
        <div class="pointer-events-none absolute top-[50px] left-1/2 -z-10 aspect-square w-[800px] -translate-x-1/2" aria-hidden="true">
            <div class="absolute inset-0 rounded-full border border-white/15"></div>
            <div class="absolute inset-[120px] animate-spin-slow rounded-full border border-dashed border-white/12"></div>
        </div>

        <div class="h-11 shrink-0 md:h-[52px]" aria-hidden="true"></div>

        <div class="flex flex-1 flex-col items-center justify-center pt-16 pb-10 text-center">
            <p class="inline-flex items-center gap-2.5 rounded-full border border-white/25 bg-white/5 px-4 py-2 text-[14px] backdrop-blur sm:text-[15px]" data-reveal>
                <span class="size-2 rounded-full bg-brand"></span>{{ $badge }}
            </p>
            <div class="relative" data-reveal style="--reveal-delay:100ms">
                <h1 class="mt-7 text-[56px] leading-[0.95] font-medium tracking-[-0.045em] sm:text-8xl lg:text-[136px]">{{ $title }}</h1>
                <x-icon name="sparkle" class="absolute -top-0 -right-4 size-7 animate-float text-brand sm:top-2 sm:-right-8" />
            </div>
            <x-icon name="sparkle" class="absolute top-[62%] left-[18%] hidden size-4 text-white lg:block" />
            <p class="mt-7 max-w-[600px] text-[17px] leading-relaxed text-white/80 sm:text-lg" data-reveal style="--reveal-delay:200ms">{{ $subtitle }}</p>
            <div class="mt-9 flex flex-col gap-3 sm:flex-row" data-reveal style="--reveal-delay:300ms">
                {{ $actions }}
            </div>
        </div>

        <div class="flex items-end justify-between gap-4 text-[14px] text-white/75 sm:text-[15px]">
            <p class="hidden items-center gap-2 sm:flex"><x-icon name="check" class="size-3.5" />{{ $leftNote }}</p>
            <a href="{{ $scrollTarget }}" class="mx-auto flex flex-col items-center gap-2.5 text-[13px] text-white/60 hover:text-white sm:mx-0">
                <span class="flex h-9 w-6 justify-center rounded-full border-[1.5px] border-white/60 pt-1.5" aria-hidden="true">
                    <span class="h-2 w-[3px] animate-scroll-dot rounded-full bg-brand"></span>
                </span>
                {{ $scrollLabel }}
            </a>
            <p class="hidden items-center gap-2 sm:flex">{{ $rightNote }}<x-icon name="check" class="size-3.5" /></p>
        </div>
    </div>
</section>
