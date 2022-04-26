<template>
    <div class="footer-page-container">
        <div class="footer-page-head">
            <h3>Anime Zero</h3>
            <p>/ Сотрудничество</p>
        </div>
        <h2 class="footer-page-title">
            Партнерам
        </h2>
        <p class="footer-page-subtitle">
            AnimeZero - один из самых крупнейших онлайн-кинотеатров в России, посвященных аниме. Мы успешно работаем с
            2021 года.Наш кинотеатр всегда рад новым партнерам. За поддержку нашего портала мы будем рады предоставить
            эксклюзивные предложения и надежные прозрачные взаимоотношения.
        </p>
        <div class="partners-body">
            <p class="title">
                Получить более подробную информацию о партнерской программе вы можете обратившись в
                чате:
            </p>
            <div class="contacts">
                <BaseButton>Поддержка</BaseButton>
                <p>Или на почту <a href="mailto:admin@animezero.ru">admin@animezero.ru</a></p>
            </div>
        </div>
    </div>
</template>

<script>
import BaseButton from '../components/BaseButton';

export default {
    name: 'Partners',
    components: {BaseButton}
};
</script>

<style scoped>
.partners-body {
    display: flex;
    flex-direction: column;
}

.partners-body .title {
    font-weight: 500;
    font-size: 18px;
    line-height: 21px;
    margin-bottom: 25px;
}

.contacts {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.contacts button {
    margin-right: 25px;
    font-size: 18px;
    height: 50px;
}

.contacts a {
    text-decoration: none;
    color: var(--main-color);
    font-weight: 600;
}

</style>
