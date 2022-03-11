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
        };
    },
    methods: {
        searchFilmDebounce() {
            this.search.loading = true;
            this.search.open = true;

            if (this.search.debounce_timer) {
                this.search.response = [];
                clearTimeout(this.search.debounce_timer);
            }

            if (!this.search.query || this.search.query.trim().length <= 0)
                return;

            this.search.debounce_timer = setTimeout(() => {
                this.$axois.post(this.route('film.search'), {
                    query: this.search.query
                })
                    .then(res => res.data)
                    .then(data => this.search.response = data)
                    .then(() => this.search.loading = false);
            }, 500);
        },
        searchFilm() {
            this.$axois.post(this.route('film.search'), {
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
};
