<template>
    <div class="template">
        <BaseHeader/>
        <main>
            <h2>Результаты поиска</h2>
            <div class="film-search-container">
                <FilmCard v-for="film in films.data" :key="film.id" :item="film"/>
            </div>

        </main>
        <BaseFooter/>
    </div>
</template>

<script>
import FilmCard from "../components/FilmCard";

export default {
    name: "FilmSearch",
    components: {FilmCard},
    props: {
        films: Object,
    }
}
</script>

<style scoped>
.film-search-container {
    display: grid;
    grid-template-rows: 1fr;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 10px;
}

main {
    padding: 0 20px;
}
</style>
