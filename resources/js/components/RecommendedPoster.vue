<template>
    <InertiaLink
        :href="route('film.show', item.film.id)"
        as="div"
        class="poster">
        <img
            :src="item.film.poster"
            :alt="item.film.title"
        >
        <div class="poster-text-box">
            <h3>{{ item.film.title }}</h3>
            <p>{{ item.film.description }}...</p>
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
