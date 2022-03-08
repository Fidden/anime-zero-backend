<template>
    <div class="films-filter-container">
        <h2>Фильтры</h2>
        <div class="selectors-container">
            <BaseSelect title="Жанры" :options="genres" @change=""/>
        </div>
        <div class="controls-container">
            <button class="reset-filters"><i class="fal fa-times"></i>Сбросить фильтры</button>
            <BaseButton><i class="fal fa-search"></i>Поиск</BaseButton>
        </div>
    </div>
    <div class="films-container">
        <FilmCard v-for="film in films.data" :key="film.id" :item="film"/>
    </div>
    <Pagination class="films-pagination" :meta="films.meta"/>
</template>

<script>
import BaseButton from "../components/BaseButton";
import BaseSelect from "../components/BaseSelect";
import FilmCard from "../components/FilmCard";
import Pagination from "../components/Pagination";

export default {
    name: "FilmsPage",
    components: {Pagination, FilmCard, BaseSelect, BaseButton},
    props: {
        films: Object,
        genres: Array,
    }
}
</script>

<style scoped>
.films-filter-container {
    display: flex;
    flex-direction: column;
    background: #0F0F0F;
    padding: 20px 30px;
    margin-top: 100px;
    margin-bottom: 40px;
}

.selectors-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: 50px;
    gap: 30px;
    margin-top: 20px;
    margin-bottom: 35px;
}

.reset-filters {
    background: none;
    color: #BABABA;
    font-size: 16px;
    margin-right: auto;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.reset-filters .fa-times {
    margin-right: 10px;
}

.films-container {
    display: grid;
    gap: 25px;
    grid-template-rows: 1fr;
    grid-template-columns: repeat(6, 1fr);
    margin-bottom: 60px;
}

.controls-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}

@media (max-width: 550px) {
    .selectors-container {
        grid-template-columns: repeat(2, 1fr);
    }

    .films-container {
        padding: 0 20px;
        grid-template-columns: repeat(2, 1fr);
    }

    .films-pagination {
        margin: 0 20px;
    }
}

</style>
