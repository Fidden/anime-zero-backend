<template>
    <div class="ongoing-card">
        <img :src="item.poster" :alt="item.title">
        <div class="ongoing-card-body">
            <p class="title">{{ item.title }} ({{ item.year }})</p>
            <p class="genre">Жанры: {{ getGenres }}</p>
            <p class="rating">Возрастной рейтинг: <span>{{ item.rating }}</span></p>
            <BaseButton>Отслеживать</BaseButton>
        </div>
    </div>
</template>

<script>
import BaseButton from "./BaseButton";

export default {
    name: "OngoingCard",
    components: {BaseButton},
    props: {
        item: Object,
    },
    computed: {
        getGenres() {
            let out = '';
            this.item.genres.forEach((item, index) => {
                out += index === this.item.genres.length - 1 ? item.name : `${item.name}, `;
            })
            return out;
        }
    }
}
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
    width: 180px;
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

.rating, .genre {
    margin-top: 5px;
}

button {
    margin-right: auto;
    margin-top: 15px;
}

.rating span {
    font-weight: 600;
}
</style>
