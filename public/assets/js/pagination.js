/*
 * AJAX sayfalama (progressive enhancement).
 *
 * Alan: [data-pagination-region] + benzersiz id.
 * Alan icindeki .pagination linkleri tam sayfa yenilemesi yerine ayni URL'yi
 * fetch eder ve yanittaki ayni id'li alanla yalnizca bu alani degistirir.
 * JavaScript yoksa linkler normal sunucu tarafli sayfalama olarak calisir.
 */
(() => {
    const REGION_SELECTOR = '[data-pagination-region]';
    const LINK_SELECTOR = '.pagination a[href]';
    const ERROR_MESSAGE = 'Sayfa yüklenemedi. Lütfen tekrar deneyin.';

    if (!document.querySelector(REGION_SELECTOR) || !window.AbortController) {
        return;
    }

    // Alan id'si -> devam eden istegin AbortController'i
    const pendingRequests = new Map();

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Hash haric URL; ayni sayfaya tekrar istek atmamak icin
    const toPageKey = (url) => {
        const { pathname, search } = new URL(url, window.location.href);

        return pathname + search;
    };

    let currentPageKey = toPageKey(window.location.href);

    const isPlainLeftClick = (event) =>
        event.button === 0 &&
        !event.defaultPrevented &&
        !event.metaKey &&
        !event.ctrlKey &&
        !event.shiftKey &&
        !event.altKey;

    const setLoading = (region, isLoading) => {
        region.setAttribute('aria-busy', String(isLoading));
    };

    const showError = (region) => {
        if (region.querySelector('[data-pagination-error]')) {
            return;
        }

        const alert = document.createElement('p');

        alert.className = 'alert alert--error';
        alert.setAttribute('role', 'alert');
        alert.setAttribute('data-pagination-error', '');
        alert.textContent = ERROR_MESSAGE;

        region.prepend(alert);
    };

    const focusRegion = (region) => {
        region.setAttribute('tabindex', '-1');
        region.focus({ preventScroll: true });

        if (region.getBoundingClientRect().top < 0) {
            region.scrollIntoView({
                behavior: prefersReducedMotion ? 'auto' : 'smooth',
                block: 'start',
            });
        }
    };

    // Yeni sayfanin HTML'inden ayni id'li alani dondurur; bulunamazsa null
    const fetchRegion = async (regionId, url) => {
        pendingRequests.get(regionId)?.abort();

        const controller = new AbortController();
        pendingRequests.set(regionId, controller);

        const region = document.getElementById(regionId);
        setLoading(region, true);

        try {
            const response = await fetch(url, {
                signal: controller.signal,
                credentials: 'same-origin',
                headers: { Accept: 'text/html' },
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const html = await response.text();

            return new DOMParser()
                .parseFromString(html, 'text/html')
                .getElementById(regionId);
        } finally {
            // Yalnizca en son istek loading durumunu kapatir
            if (pendingRequests.get(regionId) === controller) {
                pendingRequests.delete(regionId);
                setLoading(region, false);
            }
        }
    };

    const loadPage = async (regionId, url, { updateHistory }) => {
        try {
            const nextRegion = await fetchRegion(regionId, url);

            if (!nextRegion) {
                // Ornegin oturum sona erdiyse: karari sunucuya birak
                window.location.assign(url);

                return;
            }

            document.getElementById(regionId).replaceWith(nextRegion);

            if (updateHistory) {
                window.history.pushState({ paginationRegion: regionId }, '', url);
            }

            currentPageKey = toPageKey(url);
            focusRegion(nextRegion);
        } catch (error) {
            if (error.name !== 'AbortError') {
                showError(document.getElementById(regionId));
            }
        }
    };

    document.addEventListener('click', (event) => {
        const link = event.target.closest(LINK_SELECTOR);

        if (!link || !isPlainLeftClick(event) || link.origin !== window.location.origin) {
            return;
        }

        const region = link.closest(REGION_SELECTOR);

        if (!region || !region.id) {
            return;
        }

        event.preventDefault();

        loadPage(region.id, link.href, { updateHistory: true });
    });

    // Geri/ileri: URL'deki sayfaya gore alanlari yeniden yukle
    window.addEventListener('popstate', () => {
        if (toPageKey(window.location.href) === currentPageKey) {
            return;
        }

        document.querySelectorAll(REGION_SELECTOR).forEach((region) => {
            if (region.id) {
                loadPage(region.id, window.location.href, { updateHistory: false });
            }
        });
    });
})();
