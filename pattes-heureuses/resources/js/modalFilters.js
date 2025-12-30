import {settings} from "./settings.js";

export const modalFilters = {
    overlayFilters: null,
    containerFilters: null,
    buttonOpenFilters: null,
    buttonCloseFilters: null,
    isOpen: false,

    init() {
        this.overlayFilters = document.getElementById('overlay-filters');
        this.containerFilters = document.getElementById('filters-container');
        this.buttonOpenFilters = document.getElementById('filters-button');
        this.buttonCloseFilters = document.getElementById('filters-close-button');

        if (!this.buttonOpenFilters) {
            return; 
        }

        this.addEventListeners();
    },


    addEventListeners() {
        this.buttonOpenFilters.addEventListener('click', () => {
            this.open();
        })
        this.buttonCloseFilters.addEventListener('click', () => {
            this.close();
        })
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && this.isOpen) {
                this.close();
            }
        })
        this.overlayFilters.addEventListener('click', () => {
            if (this.isOpen) {
                this.close()
            }
        })
    },


    open() {
        this.toggle(true);
    },
    close() {
        this.toggle(false);
    },


    toggle(state) {
        this.isOpen = state
        document.body.classList.toggle(settings.noScrollable)
        this.overlayFilters.classList.toggle(settings.isOpenModal)
        this.containerFilters.classList.toggle(settings.isOpenModal)
        this.buttonCloseFilters.classList.toggle(settings.isOpenModal)

    }

}
