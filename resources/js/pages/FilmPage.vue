<template>
    <div class="template">
        <BaseHeader/>
        <main>
            <div class="film-page-container">
                <div class="film-page-poster-block">
                    <img :src="item.poster" :alt="item.title">
                    <div class="film-actions">
                        <button><i class="fal fa-plus"></i>Буду смотреть</button>
                        <i class="fas fa-eye"></i>
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
                    <h2>О фильме</h2>
                    <div class="film-page-description-grid">
                        <h5>Год выпуска</h5>
                        <p>{{ item.year }}</p>
                        <h5>Жанры</h5>
                        <p>{{ getGenres }}</p>
                        <h5>Длительность</h5>
                        <p>{{ item.duration }} мин</p>
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
    },
    computed: {
        getGenres() {
            let out = '';
            this.item.genres.forEach((item, index) =>
                out += index + 1 === this.item.genres.length ?
                    item.name : `${item.name}, `);
            return out;
        }
    }
}
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
}

.film-actions button i {
    margin-right: 5px;
    transform: translateY(1px);
}

.film-actions i {
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
    font-size: 24px;
}

.film-page-main-block h4 {
    font-size: 18px;
    color: var(--gray);
    font-weight: 400;
}

.film-page-main-block h2 {
    font-weight: bold;
    font-size: 36px;
    margin-top: 30px;
}

.film-description {
    font-weight: 500;
    font-size: 20px;
    color: var(--gray);
}

.film-page-description-grid {
    display: grid;
    grid-template-columns: 200px 1fr;
    grid-template-rows: repeat(2, 1fr);
}

.film-page-description-grid h5 {
    margin: 0;
    font-weight: 600;
    font-size: 24px;
}

.film-page-description-grid p {
    font-weight: 500;
    font-size: 24px;
    color: #AFAFAF;
}

</style>
