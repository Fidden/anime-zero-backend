<template>
    <header>
        <MobileBurger/>
        <MobileSearch/>
        <InertiaLink as="h1" :href="route('home')">Anime<span>Zero</span></InertiaLink>
        <InertiaLink as="button" class="section">Каталог</InertiaLink>
        <InertiaLink as="button" :href="route('films')" class="section">Фильмы</InertiaLink>
        <InertiaLink as="button" class="section">Сериалы</InertiaLink>
        <div class="search-bar">
            <div class="search-bar-background" v-if="search.open" @click.self="closeSearchBar"></div>

            <input type="text" placeholder="Популярные новинки"
                   v-model="search.query"
                   @input="searchFilmDebounce">

            <button @click="searchFilm"><i class="fas fa-search"></i></button>

            <div class="search-bar-body" v-if="search.open">
                <LoadingAnimation class="loading-animation" v-if="search.loading"/>
                <InertiaLink class="search-bar-item"
                             :href="route('film.show', film.id)"
                             as="div"
                             v-for="film in search.response"
                             v-else>

                    <img :src="film.poster" :alt="film.title">
                    <p>{{ film.title }} <span v-if="film.year">({{ film.year }})</span><br>
                        <span class="orig-title">{{ film.title_orig }}</span>
                    </p>
                </InertiaLink>
            </div>
        </div>
        <BaseButton v-if="user && $page.url == '/user'" @click="$inertia.visit(route('user.logout'))">
            <i class="fal fa-sign-out"></i>Выход
        </BaseButton>
        <BaseButton v-else-if="user" @click="$inertia.visit(route('user.account'))">
            <i class="fal fa-user"></i> Личный кабинет
        </BaseButton>
        <BaseButton v-else @click="$root.openModal"><i class="fal fa-sign-out"></i>Вход</BaseButton>
        <AuthModal/>
    </header>
</template>

<script>
import AuthModal from "./AuthModal";
import {computed} from "vue";
import {usePage} from '@inertiajs/inertia-vue3';
import MobileBurger from "./MobileBurger";
import MobileSearch from "./MobileSearch";
import searchFilmMixin from "../mixins/SearchFilmMixin";
import LoadingAnimation from '../components/LoadingAnimation';

export default {
    name: "TheHeader",
    mixins: [searchFilmMixin],
    components: {MobileSearch, MobileBurger, Notification, AuthModal, LoadingAnimation},
    setup() {
        const user = computed(() => usePage().props.value.user);
        return {user};
    },
}
</script>

<style scoped>

header {
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 100%;
    height: 55px;
    z-index: 50;
    background: var(--background);
}

h1 {
    font-weight: bold;
    font-size: 32px;
    margin-right: 14px;
    cursor: pointer;
}

h1 span {
    color: var(--main-color);
}

.section {
    height: 100%;
    width: 77px;
    background: none;
    font-size: 14px;
}

.search-bar {
    flex: 1;
    display: flex;
    flex-direction: row;
    height: 38px;
    margin: 0 16px 0 30px;
    position: relative;
    z-index: 500;
}

.search-bar input {
    width: 100%;
    border-radius: 5px 0 0 5px;
    padding: 2px 15px 0 15px;
    outline: none;
    border: none;
    font-size: 14px;
    color: black;
}

.search-bar button {
    background: #181818;
    border-radius: 0px 5px 5px 0px;
    width: 32px;
}

.ti-btn {
    height: 38px;
    font-size: 14px;
}

.search-bar-body {
    position: absolute;
    left: 0;
    width: 100%;
    top: 50px;
    display: flex;
    flex-direction: column;
    background: var(--background);
    padding: 10px;
}

.search-bar-item {
    height: 60px;
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 10px;
    cursor: pointer;
    transition: 0.5s;
}

.search-bar-item * {
    font-family: 'Montserrat', sans-serif;
}

.search-bar-item:hover p, .search-bar-item:hover span {
    color: var(--main-color);
    transition: 0.5s;
}

.search-bar-item img {
    height: 100%;
    width: auto;
    margin-right: 10px;
    border-radius: 5px;
}

.orig-title {
    font-size: 12px;
}

.search-bar-background {
    position: fixed;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
}


.loading-animation {
    margin: 0 auto;
}

@media (max-width: 550px) {
    header {
        padding: 10px 20px;
    }

    .section, .search-bar, header .ti-btn {
        display: none;
    }

    h1 {
        margin: 0 auto;
    }
}

</style>
