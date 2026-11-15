/*
 * Mobil menu ac/kapa.
 * Buton: [data-nav-toggle] + aria-controls="<menu id>"
 */
document.querySelectorAll('[data-nav-toggle]').forEach((toggle) => {
    const menu = document.getElementById(toggle.getAttribute('aria-controls'));

    if (!menu) {
        return;
    }

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';

        toggle.setAttribute('aria-expanded', String(!isOpen));
        menu.classList.toggle('is-open', !isOpen);
    });
});
