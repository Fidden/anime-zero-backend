<template>
  <div class="profile-container">
    <div
      v-if="!films.data.length"
      class="films-empty"
    >
      <img
        src="/img/hmm_emoji.webp"
        alt="hmm"
      >
      <h3>Хм, похоже тут ничего нет...</h3>
    </div>
    <div
      v-else
      class="films-container"
    >
      <AccountFilmCard
        v-for="film in films.data"
        :key="film.id"
        :item="film"
      />
    </div>
    <Pagination :meta="films.meta" />
  </div>
</template>

<script>
import AccountFilmCard from './AccountFilmCard';
import Pagination from './BasePagination';

export default {
	name: 'AccountFilms',
	components: {AccountFilmCard, Pagination},
	props: {
		films: {
            type: Object,
            required: true,
        },
	}
};
</script>

<style scoped>

.profile-container {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.films-empty {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.films-empty img {
    width: 120px;
    height: 120px;
    margin-bottom: 10px;
}

.films-empty h3 {
    font-size: 24px;
}

.films-container {
    display: grid;
    grid-template-rows: 235px;
    grid-template-columns: repeat(5, 166px);
    gap: 20px;
}

@media (max-width: 550px) {

    .films-empty {
        height: 40vh;
    }

    .films-container {
        grid-template-rows: 190px;
        grid-template-columns: repeat(2, 135px);
        grid-auto-flow: row;
        justify-content: center;
        margin-top: 40px;
    }
}

</style>
