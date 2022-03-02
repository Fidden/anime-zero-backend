export default {
    data() {
        return {
            modal: {
                open: false,
                state: 0,
                enum: {LOGIN: 0, REGISTER: 1, PASSWORD_RESET: 2, EMAIL_VERIFY: 3}
            }
        }
    },
    methods: {
        closeModal() {
            this.modal.open = false;
        },
        openModal() {
            this.modal.open = true;
        },
        setModalState(state) {
            this.modal.state = state;
        }
    }
}
