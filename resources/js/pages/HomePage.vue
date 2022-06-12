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
        <div class="main-poster-grid">
            <InertiaLink
                v-for="best in films.best"
                :key="best.id"
                :href="route('film.show', best.id)"
                class="image-block"
            >
                <img
                    :src="best.poster"
                    :alt="best.title"
                >
            </InertiaLink>
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
            <Flickity
                v-if="films.newest.length"
                ref="flickity"
                :options="flickity.filmsSlider"
            >
                <div
                    v-for="film in films.newest"
                    :key="film.id"
                    class="carousel-cell"
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
import {mapActions} from 'vuex';

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
                filmsSlider: {
                    initialIndex: 1,
                    prevNextButtons: true,
                    pageDots: false,
                    wrapAround: true
                }
            }
        };
    },
    mounted() {
        if (this.$page.props.flash.message === 'email-verification-required') {
            this.setModalState(this.$store.state.authModal.enum.EMAIL_VERIFY);
            this.setModalOpen(true);
        }

        if (this.$page.props.flash.message === 'auth-required') {
            this.setModalState(this.$store.state.authModal.enum.LOGIN);
            this.setModalOpen(true);
        }

        if (this.$page.props.flash?.message?.token) {
            this.setModalState(this.$store.state.authModal.enum.PASSWORD_CHANGE);
            this.setModalOpen(true);
        }
    },
    methods: {
        selectPoster(id) {
            this.selected_poster = id;
        },
        watchFilm() {
            this.$inertia.get(this.route('films'));
        },
        ...mapActions([
            'setModalState',
            'setModalOpen'
        ])
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
    margin-bottom: 19px;
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
    margin-bottom: 29px;
    line-height: 38px;
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
    cursor: pointer;
    transition: border 0.3s;
    animation-name: scroll;
    animation-duration: 80s;
    animation-iteration-count: infinite;
}

.image-block:hover {
    border: 5px solid var(--main-color);
    transition: border 0.3s;
}

.image-block:nth-child(2), .image-block:nth-child(5), .image-block:nth-child(8), .image-block:nth-child(11) {
    transform: translateY(-85%);
    animation-name: scroll-even;
    animation-duration: 110s;
    animation-iteration-count: infinite;
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
    display: flex;
    flex-direction: row;
    margin-top: 40px;
}

.films-block-body-big {
    display: grid;
    grid-template-rows: repeat(2, 250px);
    grid-template-columns: repeat(6, 1fr);
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

.carousel-cell {
    width: 180px;
    margin-right: 20px;
}

@keyframes scroll {
    0% {
        transform: translateY(-20%);
    }

    50% {
        transform: translateY(40%);
    }

    100% {
        transform: translateY(-20%);
    }
}

@keyframes scroll-even {
    0% {
        transform: translateY(-85%);
    }

    50% {
        transform: translateY(95%);
    }

    100% {
        transform: translateY(-85%);
    }
}

@media (max-width: 768px) {
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

    .main-poster-info {
        width: 100%;
        margin-bottom: 20px;
    }

    .main-films-block {
        padding: 40px 20px;
    }

    .films-block-body.mobile {
        display: block;
    }

    .films-block-body.films-block-body-big {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 350px 1fr 1fr;
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

@media (max-width: 1000px) and (min-width: 768px) {
    .main-poster-grid {
        transform: rotate(20deg) translateX(10px);
    }
}

@media (min-width: 768px) and (max-width: 1280px) {
    .main-poster-info {
        flex-shrink: 0;
        margin-right: 40px;
    }

    .films-block-body-big {
        grid-template-columns: repeat(6, 1fr);
        grid-template-rows: repeat(3, 250px);
        grid-template-areas:
        "first first first first first first"
        "first first first first first first"
        "second second second third third third"
    }

    .ongoing-block {
        grid-template-rows: 1fr;
    }
}

</style>
