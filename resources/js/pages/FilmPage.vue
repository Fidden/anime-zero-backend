<template>
    <div class="template">
        <BaseHeader/>
        <main>
            <div class="film-page-container">
                <div class="film-page-poster-block">
                    <img :src="item.poster" :alt="item.title">
                    <div class="film-actions">
                        <button><i class="fa-light fa-plus"></i>Буду смотреть</button>
                        <i class="fa-light fa-eye"></i>
                    </div>
                </div>
                <div class="film-page-main-block">
                    <h3>{{ item.title }}</h3>
                    <h4>{{ item.title_orig }}</h4>
                    <iframe class="film-iframe" :src="item.player_link" frameborder="0" allowfullscreen></iframe>
                    <h2>Описание</h2>
                    <p class="film-description">
                        {{ item.description }}
                    </p>
                    <div class="film-page-description-grid">
                        <h5>Год выпуска</h5>
                        <p>{{ item.year }}</p>
                    </div>
                </div>
            </div>
        </main>
        <BaseFooter/>
    </div>
</template>

<script>
export default {
    name: "FilmPage",
    props: {
        item: Object,
    }
}
</script>

<style scoped>
.film-page-container {
    display: flex;
    flex-direction: row;
}

.film-page-poster-block {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 250px;
    margin-right: 30px;
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

</style>
