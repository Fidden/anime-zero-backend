<template>
  <div class="films-filter-container">
    <h2>Фильтры</h2>
    <div class="selectors-container">
      <BaseSelect
        title="Жанры"
        :options="genres"
        :backup="filters.genres"
        @change="setGenres"
      />

      <BaseSelect
        title="Статус"
        :options="statuses"
        :backup="filters.statuses"
        @change="setStatuses"
      />

      <BaseSelect
        title="Тип"
        :options="contentTypes"
        :backup="filters.type"
        :single="true"
        @change="setContentTypes"
      />
    </div>
    <div class="controls-container">
      <button
        class="reset-filters"
        @click="resetFilters"
      >
        <i class="fal fa-times" />Сбросить фильтры
      </button>
    </div>
  </div>
  <div class="films-container">
    <FilmCard
      v-for="film in films.data"
      :key="film.id"
      :item="film"
    />
  </div>
  <Pagination
    class="films-pagination"
    :meta="films.meta"
    :filters="getTransformedFilters"
  />
</template>

<script>
import BaseSelect from '../components/BaseSelect';
import FilmCard from '../components/FilmCard';
import Pagination from '../components/BasePagination';

export default {
    name: 'FilmsPage',
    components: {Pagination, FilmCard, BaseSelect},
    props: {
        films: {
            type: Object,
            required: true,
        },
        genres: {
            type: Array,
            required: true,
        },
        statuses: {
            type: Array,
            required: true,
        },
        contentTypes: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            filters: {
                genres: [],
                statuses: [],
                type: [],
            }
        };
    },
    computed: {
        getTransformedFilters() {
            return this.removeBlank({
                genres: this.filters.genres.toString(),
                statuses: this.filters.statuses.toString(),
                type: this.filters.type.toString(),
            });
        },
    },
    watch: {
        filters: {
            deep: true,
            handler() {
                this.applyFilters();
            }
        }
    },
    mounted() {
        this.restoreFilters();
    },
    methods: {
        setGenres(array) {
            this.filters.genres = array;
        },
        setStatuses(array) {
            this.filters.statuses = array;
        },
        setContentTypes(array) {
            this.filters.type = array;
        },
        removeBlank(object) {
            let result = {};
            for (let key in object) {
                if (object[key])
                    result[key] = object[key];
            }
            return result;
        },
        applyFilters() {
            this.$inertia.get(this.route('films'), this.getTransformedFilters, {preserveState: true});
        },
        resetFilters() {
            Object.keys(this.filters).forEach(key => {
                this.filters[key] = [];
                console.log(this.filters[key]);
            });
        },
        restoreFilters() {
            let url = new URLSearchParams(window.location.search);
            for (let key in this.filters) {
                if (url.has(key))
                    this.filters[key] = url.get(key).split(',');
            }
        }
    }
};
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
    .films-filter-container {
        margin-top: 5px;
    }

    .selectors-container {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 50px);
        gap: 10px
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
