<template>
    <div class="ongoing-card">
        <img
            :src="item.poster"
            :alt="item.title"
        >
        <div class="ongoing-card-body">
            <p class="title">
                <span class="title-title">{{ item.title }}</span> ({{ item.year }})
            </p>
            <p class="genre">
                <span class="genre-title">Жанры: </span>{{ getGenres }}
            </p>
            <p class="rating">
                <span class="rating-title">Рейтинг: </span>
                <span class="rating-year">{{ getRating(item.rating) }}</span>
            </p>
            <BaseButton
                v-if="$page.props.user"
                @click="trackFilm"
            >
                Отслеживать
            </BaseButton>
        </div>
    </div>
</template>

<script>
import BaseButton from './BaseButton';
import FilmRatingMixin from '../mixins/FilmRatingMixin';

export default {
    name: 'OngoingCard',
    components: {BaseButton},
    mixins: [FilmRatingMixin],
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    computed: {
        getGenres() {
            let out = '';
            this.item.genres.forEach((item, index) => {
                out += index === this.item.genres.length - 1 ? item.name : `${item.name}, `;
            });
            return out;
        }
    },
    methods: {
        trackFilm() {
            this.$inertia.post(this.route('tracked-film.store'), {
                film_id: this.item.id,
            });
        }
    }
};
</script>

<style scoped>
.ongoing-card {
    display: flex;
    flex-direction: row;
    font-size: 16px;
}

.ongoing-card * {
    font-family: 'Montserrat', sans-serif;
}

.ongoing-card img {
    width: 100%;
    max-width: 180px;
    margin-right: 15px;
}

.ongoing-card-body {
    display: flex;
    flex-direction: column;
}

.title {
    font-weight: 600;
    font-size: 18px;
}

.rating, .genre, .rating {
    margin-top: 5px;
    color: #B7B7B7;
}

.rating-year {
    color: #B7B7B7;
}

button {
    margin-right: auto;
    margin-top: 15px;
}

.title-title, .genre-title, .rating-title {
    color: white;
    font-weight: bold;
}

</style>
