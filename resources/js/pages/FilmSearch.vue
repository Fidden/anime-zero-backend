<template>
  <h2>Результаты поиска</h2>
  <div class="film-search-container">
    <FilmCard
      v-for="film in films.data"
      :key="film.id"
      :item="film"
    />
  </div>
</template>

<script>
import FilmCard from '../components/FilmCard';

export default {
    name: 'FilmSearch',
    components: {FilmCard},
    props: {
        films: {
            type: Object,
            required: true,
        },
    }
};
</script>

<style scoped>
.film-search-container {
    display: grid;
    grid-template-rows: 1fr;
    grid-template-columns: repeat(6, 1fr);
    gap: 20px;
    margin-top: 10px;
}

main h2 {
    margin-top: 40px;
}

@media (max-width: 550px) {
    main {
        padding: 0 20px;
    }

    .film-search-container {
        grid-template-columns: 1fr 1fr;
    }
}


</style>
