/*
 * Silme onayi icin ozel modal.
 * Kullanim: <form data-confirm="Onay mesaji"> ... </form>
 * <dialog> desteklenmiyorsa tarayicinin confirm() penceresine geri doner.
 */
(() => {
    const forms = document.querySelectorAll('form[data-confirm]');

    if (forms.length === 0) {
        return;
    }

    if (typeof HTMLDialogElement !== 'function') {
        forms.forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!window.confirm(form.dataset.confirm)) {
                    event.preventDefault();
                }
            });
        });

        return;
    }

    const dialog = document.createElement('dialog');
    dialog.className = 'confirm-dialog';
    dialog.setAttribute('role', 'alertdialog');
    dialog.setAttribute('aria-labelledby', 'confirm-dialog-title');
    dialog.setAttribute('aria-describedby', 'confirm-dialog-message');
    dialog.innerHTML = `
        <div class="confirm-dialog__body">
            <span class="confirm-dialog__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z" />
                </svg>
            </span>
            <div>
                <h2 id="confirm-dialog-title" class="confirm-dialog__title">Silme işlemini onaylayın</h2>
                <p id="confirm-dialog-message" class="confirm-dialog__message"></p>
            </div>
        </div>
        <div class="confirm-dialog__actions">
            <button type="button" class="btn btn--outline" data-confirm-cancel autofocus>Vazgeç</button>
            <button type="button" class="btn btn--danger-solid" data-confirm-accept>Evet, sil</button>
        </div>
    `;
    document.body.appendChild(dialog);

    const message = dialog.querySelector('#confirm-dialog-message');
    let pendingForm = null;

    dialog.querySelector('[data-confirm-cancel]').addEventListener('click', () => dialog.close());

    dialog.querySelector('[data-confirm-accept]').addEventListener('click', () => {
        const form = pendingForm;

        dialog.close();

        if (form) {
            form.submit();
        }
    });

    // Arka plana tiklaninca kapat
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) {
            dialog.close();
        }
    });

    dialog.addEventListener('close', () => {
        pendingForm = null;
    });

    forms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            pendingForm = form;
            message.textContent = form.dataset.confirm;
            dialog.showModal();
        });
    });
})();
