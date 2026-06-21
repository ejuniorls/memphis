import './bootstrap';
// Alpine.js is automatically included with Livewire, no need to import manually
// This prevents "multiple instances of Alpine running" error

// Importa o build UMD do KTUI (não os ES modules individuais) — substitui o antigo
// <script src="assets/vendors/ktui/ktui.min.js">. Esse build expõe window.KTStepper,
// window.KTModal, window.KTDropdown etc. diretamente, que é o que este arquivo usa.
// Requer: sail npm install @keenthemes/ktui
import '@keenthemes/ktui/dist/ktui.min.js';

// Metronic Core JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize drawer functionality
    initDrawers();

    // Initialize KTMenu (includes menu functionality)
    initKTMenu();

    // Initialize sticky headers
    initStickyHeaders();

    // Initialize modal functionality
    initModals();

    // Initialize KTUI dropdowns on initial page load
    if (typeof KTDropdown !== 'undefined' && typeof KTDropdown.init === 'function') {
        try {
            KTDropdown.init();
        } catch (error) {
            console.warn('KTDropdown initialization failed:', error);
        }
    } else if (typeof KTComponents !== 'undefined' && typeof KTComponents.init === 'function') {
        try {
            KTComponents.init();
        } catch (error) {
            console.warn('KTComponents initialization failed:', error);
        }
    }
    initDatatables();
    initSteppers();
    initCarousels();
});

// Drawer functionality
function initDrawers() {
    // Use KTDrawer from KTUI if available
    if (typeof KTDrawer !== 'undefined' && typeof KTDrawer.init === 'function') {
        try {
            // Keep drawers in place when inside these (e.g. for wire:navigate / SPA persistence)
            if (typeof window.KTGlobalComponentsConfig === 'undefined') {
                window.KTGlobalComponentsConfig = {};
            }
            window.KTGlobalComponentsConfig.drawer = window.KTGlobalComponentsConfig.drawer || {};
            window.KTGlobalComponentsConfig.drawer.keepInPlaceWithin = '[wire\\:id], header#header';

            KTDrawer.init();
        } catch (error) {
            console.warn('KTDrawer initialization failed:', error);
        }
    } else {
        // Fallback: Use custom implementation if KTDrawer is not available
        const drawers = document.querySelectorAll('[data-kt-drawer]');

        drawers.forEach(drawer => {
            const toggles = document.querySelectorAll(`[data-kt-drawer-toggle="#${drawer.id}"]`);

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    drawer.classList.toggle('hidden');
                    drawer.classList.toggle('block');
                });
            });
        });
    }
}

// Menu functionality
function initMenus() {
    const menus = document.querySelectorAll('[data-kt-menu="true"]');

    menus.forEach(menu => {
        const items = menu.querySelectorAll('[data-kt-menu-item-toggle="dropdown"]');

        items.forEach(item => {
            const trigger = item.querySelector('[data-kt-menu-item-trigger="click"], [data-kt-menu-item-trigger="click|lg:hover"]');
            const dropdown = item.querySelector('.kt-menu-dropdown');

            if (trigger && dropdown) {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdown.classList.toggle('hidden');
                });
            }
        });
    });
}

// KTMenu initialization function
function initKTMenu() {
    // Initialize KTMenu if available (from Metronic core bundle)
    if (typeof KTMenu !== 'undefined' && KTMenu.init) {
        try {
            KTMenu.init();
        } catch (error) {
            console.warn('KTMenu initialization failed:', error);
        }
    }

    // Also initialize our custom menu functionality
    initMenus();
}

// Sticky header functionality
function initStickyHeaders() {
    const stickyElements = document.querySelectorAll('[data-kt-sticky="true"]');

    stickyElements.forEach(element => {
        const stickyClass = element.getAttribute('data-kt-sticky-class') || 'kt-sticky';
        const offset = parseInt(element.getAttribute('data-kt-sticky-offset')) || 0;

        window.addEventListener('scroll', function() {
            if (window.scrollY > offset) {
                element.classList.add(...stickyClass.split(' '));
            } else {
                element.classList.remove(...stickyClass.split(' '));
            }
        });
    });
}

// Modal functionality
function initModals() {
    const modalToggles = document.querySelectorAll('[data-kt-modal-toggle]');

    modalToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const modalId = this.getAttribute('data-kt-modal-toggle');
            const modal = document.querySelector(modalId);

            if (modal) {
                modal.classList.toggle('hidden');
                modal.classList.toggle('flex');
            }
        });
    });
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    const modals = document.querySelectorAll('.kt-modal');

    modals.forEach(modal => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });
});

// Dropdown reinitialization for wire:navigate
function reinitDropdowns() {
    // Use KTDropdown.reinit() from modified KTUI to clear stale instances
    // and recreate fresh ones after wire:navigate navigation
    if (typeof KTDropdown !== 'undefined' && typeof KTDropdown.reinit === 'function') {
        try {
            KTDropdown.reinit();
        } catch (error) {
            console.error('KTDropdown reinitialization failed:', error);
        }
    } else if (typeof KTComponents !== 'undefined' && typeof KTComponents.init === 'function') {
        // Fallback: Use KTComponents.init() if reinit() is not available
        try {
            KTComponents.init();
        } catch (error) {
            console.warn('KTComponents reinitialization failed:', error);
        }
    } else {
        console.warn('[Dropdown Reinit] KTDropdown.reinit() not available');
    }
}

// Datatable (re)initialization - init for first load, reinit after wire:navigate
function initDatatables() {
    if (typeof KTDataTable !== 'undefined' && typeof KTDataTable.init === 'function') {
        try {
            KTDataTable.init();
        } catch (error) {
            console.warn('KTDataTable initialization failed:', error);
        }
    }
}

function reinitDatatables() {
    if (typeof KTDataTable !== 'undefined' && typeof KTDataTable.reinit === 'function') {
        try {
            KTDataTable.reinit();
        } catch (error) {
            console.warn('KTDataTable reinitialization failed:', error);
        }
    } else if (typeof KTDataTable !== 'undefined' && typeof KTDataTable.init === 'function') {
        try {
            KTDataTable.init();
        } catch (error) {
            console.warn('KTDataTable initialization failed:', error);
        }
    }
}

// Stepper (re)initialization
//
// NOTE: a versão antiga do KTStepper (pré-bundle local) não tinha suporte nativo a
// navegação programática via clique no número do step (data-stepper-go). Mantemos
// esse binding manual por segurança/retrocompatibilidade mesmo após migrar para o
// pacote npm — não há custo se a versão atual já suportar nativamente.
function initSteppers() {
    if (typeof KTStepper !== 'undefined' && typeof KTStepper.init === 'function') {
        try {
            KTStepper.init();
        } catch (error) {
            console.warn('KTStepper initialization failed:', error);
        }
    }
    bindStepperGoButtons();
}

function reinitSteppers() {
    if (typeof KTStepper !== 'undefined' && typeof KTStepper.reinit === 'function') {
        try {
            KTStepper.reinit();
        } catch (error) {
            console.warn('KTStepper reinitialization failed:', error);
        }
    } else if (typeof KTStepper !== 'undefined' && typeof KTStepper.init === 'function') {
        try {
            KTStepper.init();
        } catch (error) {
            console.warn('KTStepper initialization failed:', error);
        }
    }
    bindStepperGoButtons();
}

// Liga cliques em [data-stepper-go="N"] à instância KTStepper do ancestral [data-kt-stepper]
function bindStepperGoButtons() {
    if (typeof window.KTData === 'undefined') return;

    document.querySelectorAll('[data-stepper-go]').forEach(function (btn) {
        if (btn.dataset.stepperGoBound === 'true') return;
        btn.dataset.stepperGoBound = 'true';

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const root = btn.closest('[data-kt-stepper]');
            if (!root) return;

            const instance = window.KTData.get(root, 'stepper');
            const step = parseInt(btn.getAttribute('data-stepper-go'), 10);

            if (instance && typeof instance.go === 'function' && !isNaN(step)) {
                instance.go(step);
            }
        });
    });
}

// Carousel (re)initialization
//
// NOTE: KTCarousel.prev()/next() lê this._index para calcular o destino, mas
// _index só é atualizado quando o scroll programático anterior termina
// (evento scrollend ou fallback de ~550ms). Clicar Previous/Next rapidamente
// antes desse término faz o cálculo usar um _index desatualizado, travando o
// carousel num estado inconsistente. Isso é um bug de timing do componente
// em si, não do nosso markup.
//
// Correção: em vez de IGNORAR cliques extras (o que "engole" cliques legítimos
// e deixa o usuário clicando sem efeito), ENFILEIRAMOS as chamadas. Cada clique
// em prev/next chama instance.next()/prev() diretamente (com preventDefault
// no listener nativo do KTCarousel) e só processa a próxima ação da fila depois
// que o evento "kt.carousel.change" confirma que a transição anterior terminou.
function initCarousels() {
    if (typeof KTCarousel !== 'undefined' && typeof KTCarousel.init === 'function') {
        try {
            KTCarousel.init();
        } catch (error) {
            console.warn('KTCarousel initialization failed:', error);
        }
    }
    bindCarouselClickQueue();
}

function reinitCarousels() {
    if (typeof KTCarousel !== 'undefined' && typeof KTCarousel.reinit === 'function') {
        try {
            KTCarousel.reinit();
        } catch (error) {
            console.warn('KTCarousel reinitialization failed:', error);
        }
    } else if (typeof KTCarousel !== 'undefined' && typeof KTCarousel.init === 'function') {
        try {
            KTCarousel.init();
        } catch (error) {
            console.warn('KTCarousel initialization failed:', error);
        }
    }
    bindCarouselClickQueue();
}

// Lock síncrono em memória (não em dataset, que pode não refletir ainda no
// DOM se duas chamadas de init/reinit corem no mesmo tick) — garante que o
// binding de cada [data-kt-carousel] aconteça exatamente uma vez mesmo se
// initCarousels() e reinitCarousels() disparem quase simultaneamente
// (acontece no load inicial quando o Livewire já processa um morph cedo).
var carouselQueueBoundRoots = new WeakSet();

function bindCarouselClickQueue() {
    if (typeof window.KTData === 'undefined') return;

    document.querySelectorAll('[data-kt-carousel]').forEach(function (root) {
        if (carouselQueueBoundRoots.has(root)) return;
        carouselQueueBoundRoots.add(root);

        var instance = window.KTData.get(root, 'carousel');
        if (!instance) {
            carouselQueueBoundRoots.delete(root); // permite tentar de novo num próximo init/reinit
            return;
        }

        var queue = [];
        var processing = false;

        var processNext = function () {
            if (processing || queue.length === 0) return;
            processing = true;
            var action = queue.shift();
            instance[action](true);
        };

        // O evento dispara quando a transição (incluindo o fallback interno
        // de ~550ms) realmente terminou e _index foi atualizado de verdade.
        root.addEventListener('kt.carousel.change', function () {
            processing = false;
            processNext();
        });

        var enqueue = function (action) {
            queue.push(action);
            processNext();
        };

        root.querySelectorAll('[data-kt-carousel-prev]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation(); // evita que o listener nativo do KTCarousel também dispare
                enqueue('prev');
            }, true);
        });

        root.querySelectorAll('[data-kt-carousel-next]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                enqueue('next');
            }, true);
        });
    });
}

// Drawer reinitialization for wire:navigate
function reinitDrawers() {
    // Use KTDrawer.reinit() from modified KTUI to clear stale instances
    // and recreate fresh ones after wire:navigate navigation
    if (typeof KTDrawer !== 'undefined' && typeof KTDrawer.reinit === 'function') {
        try {
            KTDrawer.reinit();
        } catch (error) {
            console.error('KTDrawer reinitialization failed:', error);
        }
    } else if (typeof KTDrawer !== 'undefined' && typeof KTDrawer.init === 'function') {
        // Fallback: Use KTDrawer.init() if reinit() is not available
        try {
            KTDrawer.init();
        } catch (error) {
            console.warn('KTDrawer initialization failed:', error);
        }
    } else {
        console.warn('[Drawer Reinit] KTDrawer.reinit() not available');
    }
}

// Livewire hooks
document.addEventListener('livewire:init', () => {
    // Re-initialize functionality after Livewire updates
    Livewire.hook('morph.updated', () => {
        // Use a delay to ensure Livewire components have finished rendering
        // This is especially important for drawers in Livewire components
        setTimeout(() => {
            reinitDrawers();
            initKTMenu();
            initStickyHeaders();
            initModals();
            reinitDropdowns();
            reinitDatatables();
            reinitSteppers();
            reinitCarousels();
            setTimeout(() => {
                reinitDrawers();
                reinitDatatables();
            }, 100);
        }, 10);
    });
});

// Handle wire:navigate navigation events
// Note: morph.updated hook also handles this, but we keep this for explicit wire:navigate handling
document.addEventListener('livewire:navigated', () => {
    setTimeout(() => {
        reinitDrawers();
        initKTMenu();
        initStickyHeaders();
        initModals();
        reinitDropdowns();
        reinitDatatables();
        reinitSteppers();
        reinitCarousels();

        setTimeout(() => {
            reinitDropdowns();
            reinitDrawers();
            reinitDatatables();
        }, 150);

        setTimeout(() => {
            initKTMenu();
        }, 100);

        setTimeout(() => {
            reinitDrawers();
            reinitDatatables();

            const toggleButtons = document.querySelectorAll('[data-kt-drawer-toggle]');
            toggleButtons.forEach((btn) => {
                const selector = btn.getAttribute('data-kt-drawer-toggle');
                if (!selector || typeof window.KTDrawer === 'undefined') return;
                let drawer = document.querySelector(selector) || document.body.querySelector(selector);
                if (!drawer) {
                    const header = document.querySelector('header#header');
                    if (header) drawer = header.querySelector(selector);
                }
                const hasInstance = drawer && typeof window.KTData !== 'undefined' && window.KTData.has(drawer, 'drawer');
                if (drawer && typeof window.KTData !== 'undefined' && !window.KTData.has(drawer, 'drawer')) {
                    if (drawer.hasAttribute('data-kt-drawer-container') && drawer.getAttribute('data-kt-drawer-container') === 'body' && drawer.parentElement !== document.body) {
                        document.body.appendChild(drawer);
                    }
                    new window.KTDrawer(drawer);
                }
            });
        }, 300);
    }, 50);
});

// Export functions for use in other modules
window.MetronicCore = {
    initDrawers,
    initMenus,
    initKTMenu,
    initStickyHeaders,
    initModals,
    initDatatables,
    reinitDatatables,
    initSteppers,
    reinitSteppers,
    initCarousels,
    reinitCarousels
};
