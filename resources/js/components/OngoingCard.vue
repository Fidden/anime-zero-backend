<template>
    <div class="ongoing-card">
        <InertiaLink
            :href="route('film.show', item.id)"
            class="ongoing-card-image">
            <img
                :src="item.poster"
                :alt="item.title"
            >
            <div class="ongoing-card-icon">
                <i class="fas fl-lg fa-play"/>
                <span>Смотреть</span>
            </div>
        </InertiaLink>
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
import {mapActions} from 'vuex';

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
            }, {
                onSuccess: () => {
                    this.addNotification({title: 'Успешно', body: 'Добавлено в отслеживаемые'});
                }
            });
        },
        ...mapActions([
            'addNotification'
        ])
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

.ongoing-card-image {
    width: 100%;
    max-width: 180px;
    margin-right: 15px;
    cursor: pointer;
    position: relative;
}

.ongoing-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ongoing-card-icon {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: opacity 0.2s;
    background: rgba(0, 0, 0, 0.85);
    opacity: 0;
}

.ongoing-card-icon:hover {
    transition: opacity 0.2s;
    opacity: 1;
}

.ongoing-card-icon span {
    font-size: 14px;
    margin-top: 5px;
}

.ongoing-card-icon i {
    font-family: "Font Awesome 5 Pro";
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
