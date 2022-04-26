<template>
    <header class="header">
        <MobileBurger/>
        <MobileSearch/>

        <InertiaLink
            class="header-title"
            as="h1"
            :href="route('home')"
        >
            Anime<span>Zero</span><span class="beta">BETA</span>
        </InertiaLink>

        <TheHeaderNav/>

        <div class="search-bar">
            <div
                v-if="search.open"
                class="search-bar-background"
                @click.self="closeSearchBar"
            />

            <input
                v-model="search.query"
                type="text"
                placeholder="Популярные новинки"
                @input="searchFilmDebounce"
            >

            <button @click="searchFilm">
                <i class="fas fa-search"/>
            </button>

            <div
                v-if="search.open"
                class="search-bar-body"
            >
                <LoadingAnimation
                    v-if="search.loading"
                    class="loading-animation"
                />
                <InertiaLink
                    v-for="film in search.response"
                    v-else
                    :key="film.id"
                    class="search-bar-item"
                    :href="route('film.show', film.id)"
                    as="div"
                >
                    <img
                        :src="film.poster"
                        :alt="film.title"
                    >
                    <p>
                        {{ film.title }} <span v-if="film.year">({{ film.year }})</span><br>
                        <span class="orig-title">{{ film.title_orig }}</span>
                    </p>
                </InertiaLink>
            </div>
        </div>
        <BaseButton
            v-if="user && $page.url === '/user'"
            @click="$inertia.visit(route('user.logout'))"
        >
            <i class="fal fa-sign-out"/>Выход
        </BaseButton>
        <BaseButton
            v-else-if="user"
            @click="$inertia.visit(route('user.account'))"
        >
            <i class="fal fa-user"/> Личный кабинет
        </BaseButton>
        <BaseButton
            v-else
            @click="$root.openModal"
        >
            <i class="fal fa-sign-out"/>Вход
        </BaseButton>
        <AuthModal/>
    </header>
</template>

<script>
import AuthModal from './AuthModal';
import MobileBurger from './MobileBurger';
import MobileSearch from './MobileSearch';
import searchFilmMixin from '../mixins/SearchFilmMixin';
import LoadingAnimation from '../components/LoadingAnimation';
import TheHeaderNav from './TheHeaderNav';

export default {
    name: 'TheHeader',
    components: {TheHeaderNav, MobileSearch, MobileBurger, AuthModal, LoadingAnimation},
    mixins: [searchFilmMixin],
    computed: {
        user() {
            return this.$page.props.user;
        }
    }
};
</script>

<style scoped>

.header {
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 100%;
    height: 55px;
    z-index: 50;
    background: var(--background);
    margin-top: 5px;
    position: relative;
    margin-bottom: 10px;
}

.header-title {
    font-weight: bold;
    font-size: 32px;
    margin-right: 14px;
    cursor: pointer;
    position: relative;
}

.header-title span {
    color: var(--main-color);
}

.search-bar {
    flex: 1;
    display: flex;
    flex-direction: row;
    height: 38px;
    margin: 0 16px 0 30px;
    position: relative;
    z-index: 100;
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
    border-radius: 0 5px 5px 0;
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

.beta {
    font-size: 12px;
    color: white !important;
    margin-bottom: auto;
    position: absolute;
    top: 0;
    right: 0;
    border-radius: 3px;
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

    .header-title {
        margin: 0 auto;
    }
}

</style>
