<template>
    <footer>
        <div class="footer-background"/>
        <div
            id="sections"
            class="footer-block"
        >
            <h3>Разделы</h3>
            <ul>
                <li>
                    <InertiaLink :href="route('home')">
                        Главная
                    </InertiaLink>
                </li>
                <li>
                    <InertiaLink :href="route('films', {type: 'Фильм'})">
                        Фильмы
                    </InertiaLink>
                </li>
                <li>
                    <InertiaLink :href="route('films', {type: 'Сериал'})">
                        Сериалы
                    </InertiaLink>
                </li>
            </ul>
        </div>
        <div class="footer-block">
            <h3>Пользователям и партнёрам</h3>
            <ul>
                <li>
                    <InertiaLink :href="route('partners')">
                        Сотрудничество
                    </InertiaLink>
                </li><li>
                    <InertiaLink :href="route('about-us')">
                        О проекте
                    </InertiaLink>
                </li>
                <li>
                    <InertiaLink :href="route('privacy')">
                        Политика конфиденциальности
                    </InertiaLink>
                </li>
                <li>
                    <InertiaLink :href="route('copy-right')">
                        Для правообладателей
                    </InertiaLink>
                </li>
            </ul>
        </div>
        <div class="footer-block">
            <h3>Мы в социальных сетях</h3>
            <div class="footer-social-block">
                <i class="fab fa-vk"/>
                <i class="fab fa-telegram"/>
            </div>
        </div>
        <div class="footer-block">
            <h3>Поддержка</h3>
            <BaseButton>Написать в чате</BaseButton>
        </div>
    </footer>
</template>

<script>
import BaseButton from './BaseButton';

export default {
    name: 'TheFooter',
    components: {BaseButton}
};
</script>

<style scoped>
footer {
    display: flex;
    flex-direction: row;
    width: 100%;
    position: relative;
    margin-top: auto;
    padding: 40px 0;
    justify-content: space-around;
}

.footer-background {
    position: absolute;
    background: #0B0B0B;
    left: -100vw;
    width: 200vw;
    height: 100%;
    z-index: -1;
    top: 0;
}

.footer-block {
    display: flex;
    flex-direction: column;
}

.footer-block h3 {
    font-weight: 600;
    font-size: 16px;
    color: white;
}

.footer-block ul {
    display: flex;
    flex-direction: column;
    list-style-type: disc;
    padding-left: 20px;
}

.footer-block li {
    margin: 0 0 5px 0;
}

.footer-block a {
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    color: #C4C4C4;
}

.footer-social-block {
    display: grid;
    grid-template-columns: repeat(2, 34px);
    grid-template-rows: 34px;
    gap: 5px;
    margin-top: 10px;
}

.footer-social-block i {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    border-radius: 3px;
    background: #181818;
    transition: 0.5s;
    cursor: pointer;
}

.footer-social-block i:hover {
    background: var(--main-color);
    transition: 0.5s;
}

.footer-block .ti-btn {
    margin-top: 10px;
}

@media (max-width: 550px) {
    footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px 0;
    }

    .footer-block {
        margin-bottom: 30px;
    }

    .footer-block ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    #sections {
        display: none;
    }

    .footer-social-block {
        justify-content: center;
    }
}

</style>
