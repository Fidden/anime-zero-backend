<template>
    <div class="main-poster-block">
        <div class="main-poster-info">
            <div class="main-poster-section-title">
                <h3>Anime Zero</h3>
                <p>/ Каталог</p>
            </div>
            <h2 class="main-poster-title">
                Смотрите онлайн<br> фильмы на Anime<span>Zero</span>
            </h2>
            <p class="main-poster-description">
                Смотрите фильмы в хорошем качестве<br> только у нас !
            </p>
            <div class="main-poster-buttons">
                <BaseButton @click="watchFilm">
                    <i class="fal fa-play"/>Перейти к просмотру
                </BaseButton>
            </div>
        </div>
        <Flickity
            v-if="films.best.length"
            ref="flickity"
            :options="flickity.bestFilmSlider"
            class="flickity"
        >
            <div
                v-for="best in films.best"
                :key="best.id"
                class="carousel-cell"
            >
                <InertiaLink
                    :href="route('film.show', best.id)"
                    as="img"
                    class="gallery-cell-img"
                    :src="best.poster"
                    :alt="best.title"
                />
            </div>
        </Flickity>
        <div class="main-poster-grid">
            <div
                v-for="(best, index) in films.best"
                :key="best.id"
                class="image-block"
                :class="{'selected-poster': index === selected_poster}"
                @click="selectPoster(index)"
            >
                <img
                    :src="best.poster"
                    :alt="best.title"
                >
            </div>
        </div>
    </div>
    <div class="main-films-block">
        <div class="films-block-head">
            <div class="films-block-title">
                <i class="fal fa-chart-bar"/>
                <h4>Новинки</h4>
            </div>
            <BaseButton @click="$inertia.visit(route('films', {years: '2021-2022'}))">
                Показать все
            </BaseButton>
        </div>
        <div class="films-block-body">
            <FilmCard
                v-for="film in films.newest"
                :key="film.id"
                :item="film"
            />
        </div>
        <div class="films-block-body mobile">
            <Flickity
                v-if="films.newest.length"
                ref="flickity"
                class="flickity flickity-films"
                :options="flickity.filmsSlider"
            >
                <div
                    v-for="film in films.newest"
                    :key="film.id"
                    class="carousel-cell carousel-cell-films"
                >
                    <FilmCard :item="film"/>
                </div>
            </Flickity>
        </div>
    </div>
    <div
        v-if="films.recommended.length > 2"
        class="main-films-block main-films-block-big"
    >
        <div class="films-block-head">
            <div class="films-block-title">
                <i class="fal fa-star"/>
                <h4>Мы рекомендуем</h4>
            </div>
        </div>
        <div class="films-block-body films-block-body-big">
            <RecommendedPoster
:item="films.recommended[0]"
style="grid-area: first"/>
            <RecommendedPosterSmall
                :item="films.recommended[1]"
                style="grid-area: second"/>
            <RecommendedPosterSmall
                :item="films.recommended[2]"
                style="grid-area: third"/>
        </div>
    </div>
    <div class="main-films-block">
        <div class="films-block-head">
            <div class="films-block-title">
                <i><img
                    src="/img/ongoing-icon.svg"
                    alt="ongoing"
                ></i>
                <h4>Скоро выйдет</h4>
            </div>
            <BaseButton @click="$inertia.visit(route('films', {statuses: 'Онгоинг'}))">
                Показать все
            </BaseButton>
        </div>
        <div class="films-block-body ongoing-block mobile">
            <OngoingCard
                v-for="ongoing in films.ongoing"
                :key="ongoing.id"
                :item="ongoing"
            />
        </div>
        <Flickity
            v-if="films.ongoing.length"
            ref="flickity"
            :options="flickity.filmsSlider"
            class="flickity flickity-films"
        >
            <div
                v-for="ongoing in films.ongoing"
                :key="ongoing.id"
                class="carousel-cell carousel-cell-films"
            >
                <FilmCard :item="ongoing"/>
            </div>
        </Flickity>
    </div>
</template>

<script>
import FilmCard from '../components/FilmCard';
import OngoingCard from '../components/OngoingCard';
import Flickity from 'vue-flickity';
import RecommendedPosterSmall from '../components/RecommendedPosterSmall';
import RecommendedPoster from '../components/RecommendedPoster';

export default {
    name: 'HomePage',
    components: {RecommendedPoster, RecommendedPosterSmall, OngoingCard, FilmCard, Flickity},
    props: {
        films: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            selected_poster: -1,
            flickity: {
                bestFilmSlider: {
                    initialIndex: 3,
                    prevNextButtons: false,
                    pageDots: false,
                    wrapAround: true
                },
                filmsSlider: {
                    initialIndex: 1,
                    prevNextButtons: false,
                    pageDots: false,
                    wrapAround: true
                }
            }
        };
    },
    mounted() {
        if (this.$page.props.flash.message === 'email-verification-required') {
            this.$root.setModalState(this.$root.modal.enum.EMAIL_VERIFY);
            this.$root.openModal();
        }

        if (this.$page.props.flash.message === 'auth-required') {
            this.$root.setModalState(this.$root.modal.enum.LOGIN);
            this.$root.openModal();
        }
    },
    methods: {
        selectPoster(id) {
            this.selected_poster = id;
        },
        watchFilm() {
            if (this.selected_poster === -1)
                return this.$inertia.get(this.route('films'));

            this.$inertia.get(this.route('film.show', this.films.best[this.selected_poster].id));
        }
    }
};
</script>

<style scoped>

.main-poster-block {
    width: 100%;
    height: 100%;
    max-height: 650px;
    display: flex;
    flex-direction: row;
    align-items: center;
    z-index: 10;
    overflow: hidden;
}

.main-poster-info {
    display: flex;
    flex-direction: column;
}

.main-poster-section-title {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 20px;
}

.main-poster-section-title h3 {
    font-size: 20px;
    border-bottom: 2px solid var(--main-color);
    color: white;
}

.main-poster-section-title p {
    font-size: 16px;
    color: #808080;
    margin: 0 0 0 6px;
}

.main-poster-title {
    font-size: 32px;
    font-weight: 500;
    margin-bottom: 30px;
}

.main-poster-title span {
    color: var(--main-color);
}

.main-poster-description {
    font-weight: 500;
    font-size: 16px;
    color: #7F7F7F;
    margin-bottom: 27px;
}

.main-poster-grid {
    display: grid;
    grid-template-rows: repeat(3, 222px);
    grid-template-columns: repeat(3, 160px);
    gap: 60px 30px;
    margin-left: auto;
    transform: rotate(335deg);
}

.image-block {
    border-radius: 10px;
    overflow: hidden;
    transition: 0.5s;
    cursor: pointer;
}

.image-block:nth-child(2), .image-block:nth-child(5), .image-block:nth-child(8) {
    transform: translateY(-55%);
}

.main-films-block {
    width: 100%;
    display: flex;
    flex-direction: column;
    padding: 32px 53px 53px 53px;
    background: #0F0F0F;
    margin-bottom: 8px;
}

.main-films-block:nth-child(2n + 1) {
    background: none;
}

.films-block-head, .films-block-title {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.films-block-title i {
    height: 38px;
    width: 38px;
    background: var(--main-color);
    border-radius: 5px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}

.films-block-title i img {
    width: 16px;
    height: 16px;
}

.films-block-head button {
    margin-left: auto;
}

.films-block-body {
    margin-top: 40px;
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-template-rows: 1fr;
    grid-auto-flow: row;
    justify-content: space-between;
    gap: 0 20px;
}

.films-block-body-big {
    grid-template-rows: repeat(2, 250px);
    grid-template-areas:
        "first first first first second second"
        "first first first first third third";
    gap: 36px;
}

.first {
    grid-area: first;
    position: relative;
    cursor: pointer;
}

.first img {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
}

.first button {
    right: 30px;
    bottom: 20px;
    position: absolute;
    z-index: 150;
}

.first-text-box {
    position: absolute;
    width: 65%;
    left: 30px;
    bottom: 20px;
    z-index: 150;
}

.main-films-block-big {
    padding-left: 0;
    padding-right: 0;
}

.main-films-block-big .films-block-head {
    margin: 0 53px 0 53px;
}

.ongoing-block {
    grid-template-rows: repeat(2, 240px);
    grid-template-columns: repeat(2, 500px);
    gap: 25px 60px;
    grid-auto-flow: row;
    justify-content: space-between;
}

.selected-poster {
    border: 6px solid var(--main-color);
    transition: 0.5s;
}

.flickity {
    display: none;
}

@media (max-width: 550px) {
    .main-poster-block {
        flex-direction: column;
    }

    .main-poster-grid {
        display: none;
    }

    .main-poster-info {
        padding: 0 20px;
        margin-top: 20px;
    }

    .flickity {
        display: block;
        width: 100%;
        height: 150px;
        margin: 10px 0 20px 0;
    }

    .flickity-films {
        height: 290px;
    }

    .carousel-cell {
        width: 120px;
        margin-right: 18px;
    }

    .carousel-cell-films {
        width: 180px;
    }

    .main-poster-info {
        width: 100%;
        margin-bottom: 20px;
    }

    .main-films-block {
        padding: 40px 20px;
    }

    .films-block-body {
        display: none;
    }

    .films-block-body.mobile {
        display: block;
    }

    .films-block-body.films-block-body-big {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: repeat(3, 1fr);
        grid-template-areas:
                            "first"
                            "second"
                            "third";
    }


    .films-block-head {
        margin: 0 !important;
        width: 100%;
    }

    .first-text-box p {
        display: none;
    }

    .second-info, .third-info {
        padding-right: 20px;
    }

    .first h3 {
        font-size: 14px;
    }

    .ti-btn {
        font-size: 12px;
    }

    .main-poster-section-title, .main-poster-buttons, .films-block-head .ti-btn {
        display: none;
    }

    .ongoing-block {
        display: none !important;
    }

    .main-poster-title {
        margin-bottom: 5px;
    }

    .main-poster-description {
        margin-bottom: 10px;
    }

}

</style>
