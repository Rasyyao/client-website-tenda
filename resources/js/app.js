const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const rupiah = (amount) => 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
let pageAbortController = new AbortController();

/* ---------------------------------------------------------------------------
 * Sticky navigation + animated mobile menu + smooth client-side navigation
 * ------------------------------------------------------------------------ */
function initMobileMenu() {
    document.querySelectorAll('[data-nav]').forEach((nav) => {
        const inner = nav.querySelector('[data-nav-inner]');
        const bar = nav.querySelector('[data-nav-bar]');
        const pill = nav.querySelector('[data-nav-pill]');
        const logoText = nav.querySelector('[data-logo-text]');
        const toggle = nav.querySelector('[data-menu-toggle]');
        const menu = nav.querySelector('[data-menu]');
        const backdrop = nav.querySelector('[data-menu-backdrop]');
        const openIcon = toggle?.querySelector('[data-menu-icon-open]');
        const closeIcon = toggle?.querySelector('[data-menu-icon-close]');
        const items = [...nav.querySelectorAll('[data-menu-item]')];
        const navLinks = [...nav.querySelectorAll('[data-nav-link]')];
        const indicator = nav.querySelector('[data-nav-indicator]');
        if (!toggle || !menu) return;

        let isOpen = false;
        let isScrolled = window.scrollY > 20;
        let hideTimer = null;
        let activeLink = navLinks.find((link) => link.dataset.active === 'true') ?? navLinks[0];
        let activeIndex = Number(activeLink?.dataset.navIndex ?? 0);

        const isDarkNav = () => nav.dataset.dark === 'true';

        const applyThemeLayout = (dark) => {
            nav.dataset.dark = String(dark);
            nav.classList.toggle('h-0', dark);

            if (inner) {
                ['px-7', 'pt-8', 'sm:px-12', 'sm:pt-14', 'lg:px-[60px]'].forEach((c) => inner.classList.toggle(c, dark));
                ['mx-auto', 'max-w-[1600px]', 'px-4', 'pt-5', 'sm:px-6', 'sm:pt-7', 'lg:px-10'].forEach((c) =>
                    inner.classList.toggle(c, !dark),
                );
            }
        };

        const syncBarState = () => {
            const isDark = isDarkNav();
            const elevated = isScrolled || isOpen;
            nav.dataset.scrolled = String(isScrolled);
            nav.dataset.menuOpen = String(isOpen);

            if (inner) {
                inner.classList.toggle('-translate-y-5', isDark && isScrolled);
                inner.classList.toggle('sm:-translate-y-10', isDark && isScrolled);
                inner.classList.toggle('-translate-y-2', !isDark && isScrolled);
                inner.classList.toggle('sm:-translate-y-3', !isDark && isScrolled);
            }

            if (bar) {
                [
                    'bg-white/92',
                    'backdrop-blur-md',
                    'shadow-[0_16px_36px_-12px_rgba(17,18,20,0.18)]',
                    'ring-1',
                    'ring-ink/10',
                    'pl-4',
                    'pr-2',
                    'py-1.5',
                    'sm:pl-5',
                    'sm:pr-2.5',
                ].forEach((cls) => bar.classList.toggle(cls, elevated));
            }

            if (pill) {
                pill.classList.toggle('bg-white', !elevated);
                pill.classList.toggle('bg-transparent', elevated);
                pill.classList.toggle('shadow-[0_0_0_1px_var(--color-line)]', !isDark && !elevated);
            }

            if (logoText) {
                const useWhiteLogo = isDark && !elevated;
                logoText.classList.toggle('text-white', useWhiteLogo);
                logoText.classList.toggle('text-ink', !useWhiteLogo);
            }

            const useWhiteToggle = isDark && !elevated && !isOpen;
            const useInkToggle = !isOpen && (!isDark || elevated);
            toggle.classList.toggle('bg-white', useWhiteToggle);
            toggle.classList.toggle('text-ink', useWhiteToggle);
            toggle.classList.toggle('bg-ink', useInkToggle);
            toggle.classList.toggle('bg-brand', isOpen);
            toggle.classList.toggle('text-white', useInkToggle || isOpen);
        };

        const moveIndicator = (targetLink, animate = true) => {
            if (!indicator || !targetLink) return;
            if (targetLink.offsetWidth === 0) {
                indicator.classList.add('opacity-0');
                return;
            }
            indicator.style.transition =
                animate && !prefersReducedMotion
                    ? 'transform 420ms cubic-bezier(0.22, 1, 0.36, 1), width 420ms cubic-bezier(0.22, 1, 0.36, 1)'
                    : 'none';
            indicator.style.width = `${targetLink.offsetWidth}px`;
            indicator.style.transform = `translate3d(${targetLink.offsetLeft}px, 0, 0)`;
            indicator.classList.remove('opacity-0');
        };

        const setActiveLinkStyles = (focusedLink) => {
            navLinks.forEach((link, idx) => {
                const isFocused = link === focusedLink;
                link.dataset.active = String(isFocused);
                if (isFocused) {
                    link.setAttribute('aria-current', 'page');
                } else {
                    link.removeAttribute('aria-current');
                }
                link.classList.remove('bg-ink');
                link.classList.toggle('text-white', isFocused);
                link.classList.toggle('text-ink', !isFocused);
                link.classList.toggle('hover:bg-sand', !isFocused);

                const mobileLink = items[idx];
                if (mobileLink) {
                    mobileLink.classList.toggle('bg-ink', isFocused);
                    mobileLink.classList.toggle('text-white', isFocused);
                    mobileLink.classList.toggle('text-ink', !isFocused);
                    mobileLink.classList.toggle('hover:bg-sand', !isFocused);
                }
            });
        };

        const applyMenuVisuals = (open) => {
            toggle.setAttribute('aria-expanded', String(open));

            openIcon?.classList.toggle('scale-50', open);
            openIcon?.classList.toggle('-rotate-90', open);
            openIcon?.classList.toggle('opacity-0', open);

            closeIcon?.classList.toggle('scale-50', !open);
            closeIcon?.classList.toggle('rotate-90', !open);
            closeIcon?.classList.toggle('opacity-0', !open);
            closeIcon?.classList.toggle('scale-100', open);
            closeIcon?.classList.toggle('rotate-0', open);
            closeIcon?.classList.toggle('opacity-100', open);

            menu.classList.toggle('opacity-0', !open);
            menu.classList.toggle('-translate-y-3', !open);
            menu.classList.toggle('scale-[0.96]', !open);
            menu.classList.toggle('pointer-events-none', !open);
            menu.classList.toggle('opacity-100', open);
            menu.classList.toggle('translate-y-0', open);
            menu.classList.toggle('scale-100', open);
            menu.classList.toggle('pointer-events-auto', open);

            items.forEach((item) => {
                item.classList.toggle('opacity-0', !open);
                item.classList.toggle('translate-y-2', !open);
                item.classList.toggle('opacity-100', open);
                item.classList.toggle('translate-y-0', open);
            });

            if (backdrop) {
                backdrop.classList.toggle('opacity-0', !open);
                backdrop.classList.toggle('pointer-events-none', !open);
                backdrop.classList.toggle('opacity-100', open);
                backdrop.classList.toggle('pointer-events-auto', open);
            }

            syncBarState();
        };

        const setOpen = (open) => {
            if (isOpen === open) return;
            isOpen = open;
            clearTimeout(hideTimer);

            if (open) {
                menu.hidden = false;
                if (prefersReducedMotion) {
                    applyMenuVisuals(true);
                } else {
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => applyMenuVisuals(true));
                    });
                }
            } else {
                applyMenuVisuals(false);
                if (prefersReducedMotion) {
                    menu.hidden = true;
                } else {
                    hideTimer = setTimeout(() => {
                        if (!isOpen) menu.hidden = true;
                    }, 300);
                }
            }
        };

        const onScroll = () => {
            const nextScrolled = window.scrollY > 20;
            if (nextScrolled !== isScrolled) {
                isScrolled = nextScrolled;
                syncBarState();
            }
        };

        /* Initial indicator placement (instant, zero double-refresh) */
        if (indicator && activeLink) {
            setActiveLinkStyles(activeLink);
            moveIndicator(activeLink, false);
            window.addEventListener('resize', () => moveIndicator(activeLink, false));
            document.fonts?.ready?.then(() => moveIndicator(activeLink, false));
        }

        /* Smooth SPA page navigation for navbar links (keeps navbar mounted so focus pill slides once) */
        const pageCache = new Map();
        const prefetchPage = (url) => {
            if (!pageCache.has(url)) {
                pageCache.set(
                    url,
                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } }).then((res) =>
                        res.ok ? res.text() : Promise.reject(new Error('Navigation failed')),
                    ),
                );
            }
            return pageCache.get(url);
        };

        let isNavigating = false;

        const navigateTo = async (url, targetLink, pushHistory = true) => {
            if (isNavigating) return;
            const prevIndex = activeIndex;
            const nextIndex = Number(targetLink?.dataset.navIndex ?? prevIndex);
            const direction = nextIndex >= prevIndex ? 1 : -1;

            if (targetLink) {
                activeLink = targetLink;
                activeIndex = nextIndex;
                setActiveLinkStyles(activeLink);
                moveIndicator(activeLink, true);
            }

            setOpen(false);
            isNavigating = true;

            try {
                const html = await prefetchPage(url);
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const nextMain = doc.querySelector('#main');
                const currentMain = document.querySelector('#main');
                const nextNav = doc.querySelector('[data-nav]');

                if (!nextMain || !currentMain) {
                    window.location.assign(url);
                    return;
                }

                pageAbortController.abort();
                pageAbortController = new AbortController();

                document.title = doc.title;
                if (pushHistory) {
                    window.history.pushState({ url }, '', url);
                }

                if (nextNav) {
                    applyThemeLayout(nextNav.dataset.dark === 'true');
                }

                [...currentMain.children].forEach((child) => {
                    if (!child.matches('[data-nav]')) child.remove();
                });

                const incomingNodes = [...nextMain.children].filter((child) => !child.matches('[data-nav]'));
                incomingNodes.forEach((node) => {
                    if (!prefersReducedMotion) {
                        node.style.opacity = '0';
                        node.style.transform = `translate3d(${direction * 28}px, 0, 0)`;
                    }
                    currentMain.appendChild(node);
                });

                window.scrollTo({ top: 0, behavior: 'instant' });
                isScrolled = false;
                syncBarState();

                initPageFeatures();

                if (!prefersReducedMotion) {
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            incomingNodes.forEach((node) => {
                                node.style.transition =
                                    'transform 420ms cubic-bezier(0.22, 1, 0.36, 1), opacity 340ms cubic-bezier(0.22, 1, 0.36, 1)';
                                node.style.opacity = '1';
                                node.style.transform = 'translate3d(0, 0, 0)';
                            });

                            setTimeout(() => {
                                incomingNodes.forEach((node) => {
                                    node.style.transition = '';
                                    node.style.opacity = '';
                                    node.style.transform = '';
                                });
                            }, 450);
                        });
                    });
                }
            } catch {
                window.location.assign(url);
            } finally {
                isNavigating = false;
            }
        };

        const resolveNavLinkForUrl = (url) => {
            const pathname = new URL(url, window.location.origin).pathname;
            if (pathname.startsWith('/layanan')) return navLinks[1];
            if (pathname.startsWith('/tentang-kami')) return navLinks[2];
            return navLinks[0];
        };

        navLinks.forEach((link) => {
            link.addEventListener('mouseenter', () => prefetchPage(link.href).catch(() => {}));
            link.addEventListener('click', (event) => {
                if (
                    event.defaultPrevented ||
                    event.button !== 0 ||
                    event.metaKey ||
                    event.ctrlKey ||
                    event.shiftKey ||
                    event.altKey
                ) {
                    return;
                }

                const targetUrl = new URL(link.href, window.location.origin);
                if (targetUrl.origin !== window.location.origin) return;
                if (targetUrl.pathname === window.location.pathname && !targetUrl.hash) {
                    event.preventDefault();
                    return;
                }

                event.preventDefault();
                navigateTo(link.href, link, true);
            });
        });

        items.forEach((item, idx) => {
            if (!navLinks[idx]) return;
            item.addEventListener('click', (event) => {
                if (
                    event.defaultPrevented ||
                    event.button !== 0 ||
                    event.metaKey ||
                    event.ctrlKey ||
                    event.shiftKey ||
                    event.altKey
                ) {
                    return;
                }

                const targetUrl = new URL(item.href, window.location.origin);
                if (targetUrl.origin !== window.location.origin) return;
                if (targetUrl.pathname === window.location.pathname && !targetUrl.hash) {
                    event.preventDefault();
                    setOpen(false);
                    return;
                }

                event.preventDefault();
                navigateTo(item.href, navLinks[idx], true);
            });
        });

        window.addEventListener('popstate', () => {
            const matchedLink = resolveNavLinkForUrl(window.location.href);
            navigateTo(window.location.href, matchedLink, false);
        });

        toggle.addEventListener('click', () => setOpen(!isOpen));
        backdrop?.addEventListener('click', () => setOpen(false));
        document.addEventListener('keydown', (event) => event.key === 'Escape' && setOpen(false));
        document.addEventListener('click', (event) => isOpen && !nav.contains(event.target) && setOpen(false));
        window.addEventListener('resize', () => window.innerWidth >= 768 && isOpen && setOpen(false));
        window.addEventListener('scroll', () => requestAnimationFrame(onScroll), { passive: true });
        syncBarState();
    });
}

/* ---------------------------------------------------------------------------
 * Scroll reveal + count-up numbers
 * ------------------------------------------------------------------------ */
function countUp(element) {
    const target = Number(element.dataset.countTo);
    const suffix = element.dataset.countSuffix ?? '';
    if (prefersReducedMotion || !target) return;

    const duration = 1400;
    const start = performance.now();
    const tick = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        element.textContent = Math.round(target * eased) + suffix;
        if (progress < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
}

function initReveal() {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                entry.target.querySelectorAll('[data-count-to]').forEach(countUp);
                if (entry.target.matches('[data-count-to]')) countUp(entry.target);
                entry.target.querySelectorAll('[data-steps-line]').forEach((line) => line.classList.replace('scale-x-0', 'scale-x-100'));
                entry.target.querySelectorAll('[data-steps-line-y]').forEach((line) => line.classList.replace('scale-y-0', 'scale-y-100'));
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -40px 0px' },
    );

    document.querySelectorAll('[data-reveal], [data-steps], [data-count-to]').forEach((element) => observer.observe(element));
}

/* ---------------------------------------------------------------------------
 * Subtle hero parallax
 * ------------------------------------------------------------------------ */
function initParallax() {
    const images = [...document.querySelectorAll('[data-parallax]')];
    if (!images.length || prefersReducedMotion) return;

    const update = () => {
        images.forEach((image) => {
            const speed = Number(image.dataset.parallax);
            image.style.transform = `translate3d(0, ${window.scrollY * speed}px, 0) scale(1.05)`;
        });
    };
    window.addEventListener('scroll', () => requestAnimationFrame(update), {
        passive: true,
        signal: pageAbortController.signal,
    });
}

/* ---------------------------------------------------------------------------
 * Dokumentasi proyek — vertical scroll drives a horizontal track.
 * The section is made tall enough that the sticky viewport stays pinned until
 * the last card has scrolled into view, then the page continues downward.
 * ------------------------------------------------------------------------ */
function initHorizontalScroll() {
    document.querySelectorAll('[data-hscroll]').forEach((section) => {
        const viewport = section.querySelector('[data-hscroll-viewport]');
        const track = section.querySelector('[data-hscroll-track]');
        const items = [...section.querySelectorAll('[data-hscroll-item]')];
        const progressBar = section.querySelector('[data-hscroll-progress]');
        const counter = section.querySelector('[data-hscroll-count]');
        const hint = section.querySelector('[data-hscroll-hint]');
        let distance = 0;

        const measure = () => {
            distance = Math.max(track.scrollWidth - viewport.clientWidth, 0);
            section.style.height = `${viewport.offsetHeight + distance}px`;
            update();
        };

        const update = () => {
            const top = section.getBoundingClientRect().top;
            const progress = distance ? Math.min(Math.max(-top / distance, 0), 1) : 0;
            const offset = progress * distance;
            track.style.transform = `translate3d(${-offset}px, 0, 0)`;

            const minimumScale = Math.min(viewport.clientWidth / track.scrollWidth, 1);
            progressBar.style.transform = `scaleX(${minimumScale + (1 - minimumScale) * progress})`;

            const visibleEdge = offset + viewport.clientWidth;
            const visibleCount = items.filter((item) => item.offsetLeft + item.offsetWidth * 0.5 <= visibleEdge).length;
            counter.textContent = String(Math.max(visibleCount, 1)).padStart(2, '0');

            if (hint) {
                const hidden = progress > 0.02;
                hint.style.opacity = hidden ? '0' : '1';
                hint.style.scale = hidden ? '0.6' : '1';
            }
        };

        window.addEventListener('scroll', () => requestAnimationFrame(update), {
            passive: true,
            signal: pageAbortController.signal,
        });
        window.addEventListener('resize', measure, { signal: pageAbortController.signal });
        window.addEventListener('load', measure, { signal: pageAbortController.signal });
        measure();
    });
}

/* ---------------------------------------------------------------------------
 * Layanan tabs (home)
 * ------------------------------------------------------------------------ */
function initTabs() {
    document.querySelectorAll('[data-tabs]').forEach((root) => {
        const tabs = [...root.querySelectorAll('[data-tab]')];
        const panels = [...root.querySelectorAll('[data-tab-panel]')];

        const select = (index, focus = false) => {
            tabs.forEach((tab, i) => {
                const active = i === index;
                tab.setAttribute('aria-selected', String(active));
                tab.tabIndex = active ? 0 : -1;
                panels[i].classList.toggle('opacity-0', !active);
                panels[i].classList.toggle('pointer-events-none', !active);
                panels[i].setAttribute('aria-hidden', String(!active));
            });
            if (focus) tabs[index].focus();
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => select(index));
            tab.addEventListener('mouseenter', () => window.matchMedia('(hover: hover)').matches && select(index));
            tab.addEventListener('keydown', (event) => {
                const keys = { ArrowDown: 1, ArrowRight: 1, ArrowUp: -1, ArrowLeft: -1 };
                if (!(event.key in keys)) return;
                event.preventDefault();
                select((index + keys[event.key] + tabs.length) % tabs.length, true);
            });
        });
    });
}

/* ---------------------------------------------------------------------------
 * Katalog coverflow carousel (layanan)
 * ------------------------------------------------------------------------ */
function initCarousel() {
    document.querySelectorAll('[data-carousel]').forEach((root) => {
        const items = [...root.querySelectorAll('[data-carousel-item]')];
        const dots = [...root.querySelectorAll('[data-carousel-dots] [data-carousel-select]')];
        const filters = [...root.querySelectorAll('[data-carousel-filter]')];
        const fields = {
            kicker: root.querySelector('[data-carousel-kicker]'),
            name: root.querySelector('[data-carousel-name]'),
            price: root.querySelector('[data-carousel-price]'),
            unit: root.querySelector('[data-carousel-unit]'),
            link: root.querySelector('[data-carousel-link]'),
            whatsapp: root.querySelector('[data-carousel-whatsapp]'),
        };
        const whatsappBase = fields.whatsapp.getAttribute('href');
        let current = 0;

        const render = () => {
            const isSmall = window.innerWidth < 640;
            const spacing = isSmall ? [0, 190, 290, 360] : [0, 400, 640, 790];
            const scales = [1, 0.79, 0.62, 0.52];

            items.forEach((item, index) => {
                let offset = index - current;
                if (offset > items.length / 2) offset -= items.length;
                if (offset < -items.length / 2) offset += items.length;
                const distance = Math.min(Math.abs(offset), 3);
                const direction = Math.sign(offset);

                item.style.transform = `translate(-50%, -50%) translateX(${direction * spacing[distance]}px) scale(${scales[distance]})`;
                item.style.zIndex = String(10 - distance);
                item.style.opacity = Math.abs(offset) > 3 ? '0' : distance === 3 ? '0.55' : '1';
                item.style.filter = distance >= 2 ? 'saturate(0.6)' : 'none';
                item.style.transition = 'transform 700ms cubic-bezier(.22,1,.36,1), opacity 500ms, filter 500ms';
                item.querySelectorAll('[data-active-only]').forEach((el) => el.classList.toggle('hidden', distance !== 0));
                item.querySelectorAll('[data-inactive-only]').forEach((el) => el.classList.toggle('hidden', distance === 0));
                item.querySelector('button').tabIndex = distance <= 1 ? 0 : -1;
            });

            const active = items[current].dataset;
            fields.kicker.textContent = active.kicker;
            fields.name.textContent = active.name;
            fields.price.textContent = active.price;
            fields.unit.textContent = active.unit;
            fields.link.href = active.url;
            fields.whatsapp.href = whatsappBase + '?text=' + encodeURIComponent(`Halo Pratama Jaya, saya ingin tanya tentang sewa ${active.name}.`);
            dots.forEach((dot, index) => (index === current ? dot.setAttribute('aria-current', 'true') : dot.removeAttribute('aria-current')));
        };

        const go = (index) => {
            current = (index + items.length) % items.length;
            render();
        };

        root.querySelectorAll('[data-carousel-prev]').forEach((button) => button.addEventListener('click', () => go(current - 1)));
        root.querySelectorAll('[data-carousel-next]').forEach((button) => button.addEventListener('click', () => go(current + 1)));
        root.querySelectorAll('[data-carousel-select]').forEach((button) =>
            button.addEventListener('click', () => go(Number(button.dataset.carouselSelect))),
        );

        filters.forEach((filter) =>
            filter.addEventListener('click', () => {
                filters.forEach((f) => f.setAttribute('aria-pressed', String(f === filter)));
                const category = filter.dataset.carouselFilter;
                const match = category === 'all' ? 0 : items.findIndex((item) => item.dataset.category === category);
                if (match >= 0) go(match);
            }),
        );

        // swipe support
        let startX = null;
        root.addEventListener('pointerdown', (event) => (startX = event.clientX));
        root.addEventListener('pointerup', (event) => {
            if (startX === null) return;
            const delta = event.clientX - startX;
            if (Math.abs(delta) > 50) go(current + (delta < 0 ? 1 : -1));
            startX = null;
        });
        root.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') go(current - 1);
            if (event.key === 'ArrowRight') go(current + 1);
        });

        window.addEventListener('resize', render, { signal: pageAbortController.signal });
        render();
    });
}

/* ---------------------------------------------------------------------------
 * Product gallery (detail)
 * ------------------------------------------------------------------------ */
function initGallery() {
    document.querySelectorAll('[data-gallery]').forEach((root) => {
        const images = [...root.querySelectorAll('[data-gallery-image]')];
        const thumbs = [...root.querySelectorAll('[data-gallery-thumb]')];
        const counter = root.querySelector('[data-gallery-current]');
        let current = 0;

        const show = (index) => {
            current = (index + images.length) % images.length;
            images.forEach((image, i) => image.classList.toggle('opacity-0', i !== current));
            counter.textContent = String(current + 1);
            const activeThumb = Math.min(current, thumbs.length - 1);
            thumbs.forEach((thumb, i) => thumb.setAttribute('aria-current', String(i === activeThumb)));
        };

        thumbs.forEach((thumb, index) =>
            thumb.addEventListener('click', () => {
                const isMoreThumb = thumb.querySelector('[data-gallery-more]') && current >= index;
                show(isMoreThumb ? current + 1 : index);
            }),
        );
    });
}

/* ---------------------------------------------------------------------------
 * Price estimator + price-list filter (detail)
 * ------------------------------------------------------------------------ */
function initEstimator() {
    document.querySelectorAll('[data-estimator]').forEach((root) => {
        const rows = JSON.parse(root.dataset.rows);
        const sizeSelect = root.querySelector('[data-estimator-size]');
        const daysOutput = root.querySelector('[data-estimator-days]');
        const total = root.querySelector('[data-estimator-total]');
        const order = root.querySelector('[data-estimator-order]');
        let days = 1;

        const update = () => {
            const row = rows[Number(sizeSelect.value)];
            // Every full 3 days is billed at the 3-day package price, remaining days at the daily rate.
            const packages = row.package ? Math.floor(days / 3) : 0;
            const remainingDays = days - packages * 3;
            const amount = packages * (row.package ?? 0) + remainingDays * row.daily;

            daysOutput.textContent = `${days} hari`;
            total.textContent = rupiah(amount);
            order.href = root.dataset.whatsapp + encodeURIComponent(
                `Halo Pratama Jaya, saya ingin pesan ${root.dataset.product} ukuran ${row.label} selama ${days} hari (estimasi ${rupiah(amount)}).`,
            );
        };

        root.querySelector('[data-estimator-minus]').addEventListener('click', () => {
            days = Math.max(1, days - 1);
            update();
        });
        root.querySelector('[data-estimator-plus]').addEventListener('click', () => {
            days = Math.min(30, days + 1);
            update();
        });
        sizeSelect.addEventListener('change', update);
        update();
    });

    document.querySelectorAll('[data-price-filters]').forEach((group) => {
        const buttons = [...group.querySelectorAll('[data-price-filter]')];
        const rows = [...document.querySelectorAll('[data-price-row]')];

        buttons.forEach((button) =>
            button.addEventListener('click', () => {
                const filter = button.dataset.priceFilter;
                buttons.forEach((b) => b.setAttribute('aria-pressed', String(b === button)));
                rows.forEach((row) => {
                    row.classList.toggle('hidden', filter !== 'all' && row.dataset.group !== filter);
                });
            }),
        );
    });
}

/* ---------------------------------------------------------------------------
 * Accordion (tentang kami — syarat & ketentuan)
 * ------------------------------------------------------------------------ */
function initAccordion() {
    document.querySelectorAll('[data-accordion]').forEach((root) => {
        const items = [...root.querySelectorAll('[data-accordion-item]')];

        const setOpen = (item, open) => {
            item.querySelector('[data-accordion-trigger]').setAttribute('aria-expanded', String(open));
            const panel = item.querySelector('[data-accordion-panel]');
            panel.classList.toggle('grid-rows-[1fr]', open);
            panel.classList.toggle('grid-rows-[0fr]', !open);
            item.classList.toggle('bg-cream', open);
            item.classList.toggle('rounded-[24px]', open);
            item.classList.toggle('border-transparent', open);
            item.classList.toggle('border-line', !open);
            const icon = item.querySelector('[data-accordion-icon]');
            ['border-brand', 'bg-brand', 'text-white'].forEach((c) => icon.classList.toggle(c, open));
            ['border-line', 'bg-white'].forEach((c) => icon.classList.toggle(c, !open));
            icon.querySelector('[data-accordion-plus]').classList.toggle('hidden', open);
            icon.querySelector('[data-accordion-minus]').classList.toggle('hidden', !open);
        };

        items.forEach((item) =>
            item.querySelector('[data-accordion-trigger]').addEventListener('click', () => {
                const willOpen = item.querySelector('[data-accordion-trigger]').getAttribute('aria-expanded') !== 'true';
                items.forEach((other) => setOpen(other, other === item && willOpen));
            }),
        );
    });
}

/* ---------------------------------------------------------------------------
 * Interactive coverage map (Tangerang & Purwokerto hubs)
 * ------------------------------------------------------------------------ */
function initCoverageMap() {
    document.querySelectorAll('[data-coverage-map]').forEach((root) => {
        const pins = [...root.querySelectorAll('[data-map-pin]')];
        const reticle = root.querySelector('[data-map-reticle]');
        const activeLine = root.querySelector('[data-map-active-line]');
        if (!pins.length) return;

        let currentIndex = 0;
        let isPointerInside = false;

        const selectByIndex = (index) => {
            currentIndex = (index + pins.length) % pins.length;
            const activePin = pins[currentIndex];
            const data = activePin.dataset;

            pins.forEach((pin, i) => pin.setAttribute('aria-pressed', String(i === currentIndex)));

            if (reticle) {
                reticle.style.transform = `translate(${data.x}px, ${data.y}px)`;
            }

            if (activeLine) {
                activeLine.setAttribute('x1', data.hubX);
                activeLine.setAttribute('y1', data.hubY);
                activeLine.setAttribute('x2', data.x);
                activeLine.setAttribute('y2', data.y);
            }
        };

        pins.forEach((pin, index) => {
            pin.addEventListener('click', () => selectByIndex(index));
            pin.addEventListener('mouseenter', () => {
                if (window.matchMedia('(hover: hover)').matches) selectByIndex(index);
            });
        });

        root.addEventListener('pointerenter', () => (isPointerInside = true));
        root.addEventListener('pointerleave', () => (isPointerInside = false));

        if (!prefersReducedMotion) {
            const timer = setInterval(() => {
                if (!isPointerInside && !document.hidden) {
                    selectByIndex(currentIndex + 1);
                }
            }, 3200);
            pageAbortController.signal.addEventListener('abort', () => clearInterval(timer));
        }

        selectByIndex(0);
    });
}

function initPageFeatures() {
    initReveal();
    initParallax();
    initHorizontalScroll();
    initTabs();
    initCarousel();
    initGallery();
    initEstimator();
    initAccordion();
    initCoverageMap();
}

initMobileMenu();
initPageFeatures();
