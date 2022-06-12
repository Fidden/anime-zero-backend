<template>
    <div class="film-page-container">
        <div class="film-page-poster-block">
            <img
                :src="item.poster"
                :alt="item.title"
            >
            <div
                v-if="$page.props.user"
                class="film-actions"
            >
                <button
                    v-if="isWantedWatch"
                    @click="removeWantWatch"
                >
                    <i class="fal fa-minus"/>Не буду
                    смотреть
                </button>
                <button
                    v-else
                    @click="addWantWatch"
                >
                    <i class="fal fa-plus"/>Буду смотреть
                </button>
                <i
                    v-if="isWatched"
                    class="fal fa-check"
                    @click="removeWatched"
                />
                <i
                    v-else
                    class="fas fa-eye"
                    @click="addWatched"
                />
            </div>
        </div>
        <div class="film-page-main-block">
            <h3>{{ item.title }}</h3>
            <h4>{{ item.title_orig }}</h4>
            <iframe
                class="film-iframe"
                :src="item.player_link"
                frameborder="0"
                allowfullscreen
            />
            <h2 v-if="item.description">
                Описание
            </h2>
            <p
                v-if="item.description"
                class="film-description"
            >
                {{ item.description }}
            </p>
            <h2>О фильме</h2>
            <div class="film-page-info-container">
                <div
                    v-if="item.year"
                    class="film-page-info-block"
                >
                    <h5>Год выпуска</h5>
                    <h4>{{ item.year }}</h4>
                </div>
                <div
                    v-if="item.duration"
                    class="film-page-info-block"
                >
                    <h5>Длительность</h5>
                    <h4>{{ item.duration }} мин</h4>
                </div>
                <div
                    v-if="getGenres"
                    class="film-page-info-block"
                >
                    <h5>Жанры</h5>
                    <h4>{{ getGenres }}</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FilmPage',
    props: {
        item: {
            type: Object,
            required: true,
        },
        isWantedWatch: {
            type: Boolean,
            default: false
        },
        isWatched: {
            type: Boolean,
            default: false
        },
    },
    computed: {
        getGenres() {
            let out = '';
            this.item.genres.forEach((item, index) =>
                out += index + 1 === this.item.genres.length ?
                    item.name : `${item.name}, `);
            return out;
        }
    },
    methods: {
        addWantWatch() {
            this.$inertia.post(this.route('want-to-watch-film.store'), {
                film_id: this.item.id,
            });
        },
        removeWantWatch() {
            this.$inertia.delete(this.route('want-to-watch-film.destroy', this.item.id));
        },
        removeWatched() {
            this.$inertia.delete(this.route('watched-film.destroy', this.item.id));
        },
        addWatched() {
            this.$inertia.post(this.route('watched-film.store'), {
                film_id: this.item.id,
            });
        }
    }
};
</script>

<style scoped>
.film-page-container {
    display: flex;
    flex-direction: row;
    margin-top: 45px;
}

.film-page-poster-block {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 250px;
    margin-right: 30px;
    flex-shrink: 0;
}

.film-page-poster-block img {
    width: 100%;
    height: 100%;
    max-height: 320px;
    border-radius: 7px;
    margin-bottom: 16px;
}

.film-iframe {
    margin-top: 25px;
    width: 100%;
    height: 530px;
}

.film-actions {
    display: flex;
    flex-direction: row;
}

.film-actions button {
    background: #131313;
    border-radius: 5px;
    font-size: 13px;
    width: 100%;
    height: 33px;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    padding: 13px 15px;
    margin-right: 7px;
    cursor: pointer;
}

.film-actions button i {
    margin-right: 5px;
    transform: translateY(1px);
}

.film-actions i {
    cursor: pointer;
    height: 33px;
    width: 100%;
    max-width: 33px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    background: #131313;
    font-size: 12px;
    border-radius: 5px;
}

.film-page-main-block h3 {
    font-size: 36px;
}

.film-page-main-block h4 {
    font-size: 18px;
    color: var(--gray);
    font-weight: 500;
}

.film-page-main-block h2 {
    font-weight: bold;
    font-size: 32px;
    margin-top: 30px;
    margin-bottom: 10px;
}

.film-description {
    font-weight: 500;
    font-size: 20px;
    color: var(--gray);
}

.film-page-info-container {
    display: flex;
    flex-direction: column;
}

.film-page-info-block {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 15px;
}

.film-page-info-block h5 {
    width: 100%;
    max-width: 170px;
    font-size: 18px;
    margin: 0;
    padding: 0;
}

.film-page-info-block h4 {
    font-size: 16px;
    font-family: 'Montserrat', sans-serif;
    margin: 0;
    padding: 0;
    font-weight: 400;
}

@media (max-width: 768px) {
    .film-page-container {
        flex-direction: column;
    }

    .film-page-poster-block {
        margin: 0 auto;
    }

    .film-page-main-block {
        padding: 0 20px;
    }

    iframe {
        max-height: 250px;
    }

    .film-page-main-block h3, .film-page-main-block h4 {
        text-align: center;
    }

    .film-description {
        font-size: 16px;
    }

    .film-page-info-block h5 {
        font-size: 16px;
        max-width: 145px;
    }

    .film-page-info-block h4 {
        text-align: left;
        font-size: 14px;
    }

    .film-page-main-block h3 {
        line-height: 35px;
        margin-bottom: 10px;
    }
}

</style>
