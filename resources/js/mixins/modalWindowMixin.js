export default {
    data() {
        return {
            modal_open: false,
        }
    },
    methods: {
        closeModal() {
            this.modal_open = false;
        },
        openModal() {
            this.modal_open = true;
        }
    }
}
