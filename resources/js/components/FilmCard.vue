<template>
    <InertiaLink :href="route('film', item.id)" class="film-card" as="div">
        <div class="film-card-image-block">
            <img :src="item.poster" :alt="item.title">
        </div>
        <p class="film-card-title">{{ item.title }}</p>
        <p class="film-card-info">{{ item.year }} {{ item.genres[0].name }}</p>
        <div class="film-card-rating" v-if="item.rating">
            {{ item.rating }}
        </div>
    </InertiaLink>
</template>

<script>
export default {
    name: "FilmCard",
    props: {
        item: Object
    }
}
</script>

<style scoped>
.film-card {
    position: relative;
    font-family: 'Montserrat', sans-serif;
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
</style>
