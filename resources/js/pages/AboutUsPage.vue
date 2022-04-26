<template>
    <div class="footer-page-container">
        <div class="footer-page-head">
            <h3>Anime Zero</h3>
            <p>/ О проекте</p>
        </div>
        <h2 class="footer-page-title">
            О Нас
        </h2>
        <p class="footer-page-subtitle">
            AnimeZero - один из самых крупнейших онлайн-кинотеатров в России, посвященных аниме. Мы успешно работаем с
            2021 года.
        </p>
        <div class="aboutus-body">
            <div class="aboutus-block">
                <h4 class="aboutus-block-title">
                    Огромный выбор фильмов и сериалов
                </h4>
                <p>
                    В нашем каталоге вы найдете огромную коллекцию аниме фильмов и сериалов с большим выбором озвучки и
                    хорошим качеством воспроизведения. Для вас мы ежедневно работаем над улучшением нашего сервиса,
                    чтобы принести в каждый дом уютную атмосферу и удобный просмотр аниме.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AboutUsPage'
};
</script>

<style scoped>
.aboutus-block {
    display: flex;
    flex-direction: column;
}

.aboutus-block h4 {
    font-weight: 500;
    font-size: 32px;
    line-height: 38px;
    margin-bottom: 19px;
}

.aboutus-block p {
    font-weight: 500;
    font-size: 18px;
    line-height: 21px;
}

.footer-page-title {
    font-weight: 400;
    font-size: 32px;
    line-height: 38px;
}

</style>
