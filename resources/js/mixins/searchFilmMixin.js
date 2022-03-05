export default {
    data() {
        return {
            search: {
                open: true,
                query: '',
                response: [],
                debounce_timer: null,
                loading: false,
            },
        }
    },
    methods: {
        searchFilmDebounce() {
            if (this.search.debounce_timer) {
                this.search.loading = true;
                this.search.response = [];
                clearTimeout(this.search.debounce_timer);
            }

            if (!this.search.query)
                return;

            this.search.debounce_timer = setTimeout(() => {
                this.$axois.post(route('film.search'), {
                    query: this.search.query
                })
                    .then(res => res.data)
                    .then(data => this.search.response = data)
                    .then(() => this.search.loading = false)
                    .then(() => this.search.open = true);
            }, 500);
        },
        searchFilm() {
            this.$axois.post(route('film.search'), {
                query: this.search.query
            })
                .then(res => res.data)
                .then(data => this.search.response = data)
                .then(() => this.search.open = true);
        },
        closeSearchBar() {
            this.search.open = false;
            this.search.response = [];
            this.search.loading = false;
        }
    },
    mounted() {
        this.search.open = false;
    }
}
