<template>
    <InertiaLink
        :href="route('film.show', item.film.id)"
        as="div"
        class="poster">
        <img
            :src="poster"
            :alt="item.film.title"
        >
        <div class="poster-text-box">
            <h3>{{ item.film.title }}</h3>
            <p>{{ item.film.description }}</p>
        </div>
        <BaseButton>Смотреть</BaseButton>
        <div class="backdrop"/>
    </InertiaLink>
</template>

<script>
export default {
    name: 'RecommendedPoster',
    props: {
        item: {
            type: Object,
            required: true,
        }
    },
    computed: {
        poster() {
            return this.item.poster || this.item.film.poster;
        }
    }
};
</script>

<style scoped>
.poster {
    grid-area: first;
    position: relative;
    cursor: pointer;
}

.poster img {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
}

.poster button {
    right: 30px;
    bottom: 20px;
    position: absolute;
    z-index: 150;
}

.poster-text-box {
    position: absolute;
    width: 65%;
    left: 30px;
    bottom: 20px;
    z-index: 150;
}

.poster-text-box p {
    font-weight: 500;
    font-size: 14px;
    -webkit-line-clamp: 4;
    display: -webkit-box;
    line-height: 17px;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.poster-text-box h3 {
    font-weight: 700;
    font-size: 22px;
    line-height: 27px;
    margin-bottom: 15px;
}

.backdrop {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 60%, rgba(0, 0, 0, 1) 120%);
    z-index: 100;
}
</style>
