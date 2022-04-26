<template>
    <InertiaLink
        :href="route('film.show', item.id)"
        class="film-card"
        as="div"
    >
        <div class="film-card-image-block">
            <img
                :src="item.poster"
                :alt="item.title"
            >
            <BaseButton><i class="fal fa-play"/>Смотреть</BaseButton>
        </div>
        <p class="film-card-title">
            {{ ItemTitle }}
        </p>
        <p class="film-card-info">
            {{ item.year }} {{ genre }}
        </p>
        <div
            v-if="item.rating"
            class="film-card-rating"
        >
            {{ getRating(item.rating) }}
        </div>
    </InertiaLink>
</template>

<script>
import FilmRatingMixin from '../mixins/FilmRatingMixin';

export default {
    name: 'FilmCard',
    mixins: [FilmRatingMixin],
    props: {
        item: {
            type: Object,
            required: true,
        }
    },
    computed: {
        ItemTitle() {
            let sliced = this.item.title.toString().slice(0, 30);
            return this.item.title.length > 30 ? `${sliced}...` : sliced;
        },
        genre() {
            return this.item.genres.length > 0 ? this.item.genres[0].name : '';
        }
    }
};
</script>

<style scoped>
.film-card {
    position: relative;
    font-family: 'Montserrat', sans-serif;
    cursor: pointer;
}

.film-card-title {
    font-weight: 600;
    font-size: 16px;
    margin-top: 10px;
}

.film-card-info {
    font-weight: 500;
    font-size: 14px;
    color: #6C6C6C;
}

.film-card-rating {
    position: absolute;
    top: 5px;
    right: -5px;
    padding: 2px 8px;
    background: var(--main-color);
    font-size: 12px;
    font-family: 'Montserrat', sans-serif;
    border-radius: 3px;
}

.film-card-image-block {
    position: relative;
    overflow: hidden;
    height: 240px;
}

.ti-btn {
    position: absolute;
    left: 50%;
    bottom: -100px;
    transform: translate(-50%, -30%);
    transition: 0.5s;
}

.ti-btn i {
    transform: translateY(-2px);
    font-size: 10px;
}

.film-card:hover .ti-btn {
    bottom: 5px;
    transition: 0.5s;
}
</style>
