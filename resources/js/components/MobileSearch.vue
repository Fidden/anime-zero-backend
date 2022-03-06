<template>
    <div>
        <i class="fal fa-times fa-2x mobile search-icon" v-if="search.open" @click="changeOpenState"></i>
        <i class="far fa-lg fa-search mobile search-icon" v-else @click="changeOpenState"></i>
        <div class="mobile-search-container" v-if="search.open">
            <div class="mobile-search-bar">
                <i class="fal fa-lg fa-search"></i>
                <input type="text" placeholder="Популярные новинки"
                       v-model="search.query"
                       @input="searchFilmDebounce"
                       @keypress.enter="searchFilmDebounce">
            </div>
            <div class="mobile-search-response">
                <LoadingAnimation v-if="search.loading" class="loading-animation"/>
                <InertiaLink :href="route('film-page.search', search.query)" as="div" class="show-all-results"
                             v-if="search.response.length">
                    <p>Посмотреть все результаты</p>
                    <i class="fas fa-chevron-right"></i>
                </InertiaLink>

                <InertiaLink :href="route('film.show', film.id)"
                             as="div"
                             class="search-bar-item"
                             v-for="film in search.response">

                    <img :src="film.poster" :alt="film.title">
                    <p>{{ film.title }} <span v-if="film.year">({{ film.year }})</span><br>
                        <span class="orig-title">{{ film.title_orig }}</span>
                    </p>
                </InertiaLink>
            </div>
        </div>
    </div>
</template>

<script>
import disableBodyScrollMixin from "../mixins/DisableBodyScrollMixin";
import searchFilmMixin from "../mixins/SearchFilmMixin";
import LoadingAnimation from "./LoadingAnimation";

export default {
    name: "MobileSearch",
    components: {LoadingAnimation},
    mixins: [disableBodyScrollMixin, searchFilmMixin],
    methods: {
        changeOpenState() {
            this.search.open = !this.search.open;
        }
    },
    watch: {
        search: {
            deep: true,
            handler(value) {
                this.disableBodyScroll(value.open);
            }
        }
    }
}
</script>

<style scoped>
.mobile-search-container {
    display: flex;
    flex-direction: column;
    width: 100vw;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 50px;
    background: var(--background);
}

.search-icon {
    position: absolute;
    right: 20px;
    top: 25px;
    transform: translateY(-25%);
}

.search-icon.fa-times {
    font-size: 24px;
    transform: translateY(-35%);
}

.mobile-search-bar {
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 100%;
    border-bottom: 1px solid #404040;
    padding: 0 20px 5px 20px;
}

.mobile-search-bar input {
    flex: 1;
    height: 40px;
    background: none;
    outline: none;
    border: none;
    padding: 0 10px;
}

.search-bar-item {
    display: flex;
    flex-direction: row;
    margin-bottom: 10px;
    align-items: flex-start;
}

.search-bar-item img {
    margin-right: 10px;
    width: 75px;
}

.mobile-search-response {
    display: flex;
    flex-direction: column;
    padding: 10px 20px 0 20px;
}

.loading-animation {
    margin: 20px auto 0 auto;
}

.show-all-results {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 10px;
}

.show-all-results p {
    font-size: 18px;
    text-decoration: none;
    font-weight: bold;
}

.show-all-results i {
    border-radius: 50%;
    background: var(--main-color);
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin-left: 10px;
    width: 30px;
    height: 30px;
    padding-left: 4px;
}

</style>
