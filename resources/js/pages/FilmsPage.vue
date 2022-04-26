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

            <BaseSelect
                title="Годы выхода"
                :options="options.years"
                :backup="filters.years"
                :single="true"
                @change="setYears"
            />

            <BaseSelect
                title="Рейтинг"
                :options="options.rating"
                :backup="order.rating"
                :single="true"
                @change="setRating"
            />

            <BaseSelect
                title="Название"
                :options="options.title"
                :backup="order.title"
                :single="true"
                @change="setTitle"
            />
        </div>
        <div class="controls-container">
            <button
                class="reset-filters"
                @click="resetFilters"
            >
                <i class="fal fa-times"/>Сбросить фильтры
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
                years: [],
            },
            order: {
                rating: [],
                title: [],
            },
            options: {
                years: [
                    {id: 0, name: 'Все'},
                    {id: 1, name: '2021-2022'},
                    {id: 2, name: '2020-2020'},
                    {id: 3, name: '2010-2019'},
                    {id: 4, name: '2000-2009'},
                    {id: 5, name: '1990-1999'},
                    {id: 6, name: '1980-1989'},
                ],
                rating: [
                    {id: 0, name: 'По умолчанию'},
                    {id: 1, name: 'По убыванию'},
                    {id: 2, name: 'По возрастанию'},
                ],
                title: [
                    {id: 0, name: 'По умолчанию'},
                    {id: 1, name: 'По убыванию (Я-а)'},
                    {id: 2, name: 'По возрастанию (А-я)'},
                ]
            }
        };
    },
    computed: {
        getTransformedFilters() {
            return this.removeBlank({
                genres: this.filters.genres,
                statuses: this.filters.statuses,
                type: this.filters.type.toString(),
                years: this.filters.years.toString(),
                rating: this.order.rating.toString(),
                title: this.order.title.toString(),
            });
        },
    },
    mounted() {
        this.restoreFilters();
    },
    methods: {
        //fixme:
        setGenres(array) {
            this.filters.genres = array;
            this.applyFilters();
        },
        setStatuses(array) {
            this.filters.statuses = array;
            this.applyFilters();
        },
        setContentTypes(array) {
            this.filters.type = array;
            this.applyFilters();
        },
        setYears(array) {
            this.filters.years = array;
            this.applyFilters();
        },
        setRating(array) {
            this.order.rating = array;
            this.applyFilters();
        },
        setTitle(array) {
            this.order.title = array;
            this.applyFilters();
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
            this.$inertia.get(this.route('films'), this.getTransformedFilters, {
                preserveState: true,
            });
        },
        resetFilters() {
            Object.keys(this.filters).forEach(key => {
                this.filters[key] = [];
            });

            this.applyFilters();
        },
        restoreFilters() {
            let url = {};
            location.search.substr(1).split('&').forEach(function (item) {
                let k = item.split('=')[0].replace('[]', '');
                let v = decodeURIComponent(item.split('=')[1]);
                (k in url) ? url[k].push(v) : url[k] = [v];
            });

            for (let key in url) {
                this.filters[key] = url[key];
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
    grid-template-rows: repeat(2, 50px);
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
        grid-template-rows: repeat(3, 50px);
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
