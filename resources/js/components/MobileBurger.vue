<template>
    <div>
        <i class="far fa-bars fa-lg mobile" @click="changeBurgerOpenState"></i>
        <div class="mobile-burger-container" v-show="burger.open">
            <InertiaLink as="button" class="section">Каталог</InertiaLink>
            <InertiaLink as="button" class="section">Фильмы</InertiaLink>
            <InertiaLink as="button" class="section">Сериалы</InertiaLink>
            <BaseButton v-if="$page.props.user && $page.url == '/user'" @click="$inertia.visit(route('user.logout'))">
                <i class="fal fa-sign-out"></i>Выход
            </BaseButton>
            <BaseButton v-else-if="$page.props.user" @click="$inertia.visit(route('user.account'))">
                <i class="fal fa-user"></i> Личный кабинет
            </BaseButton>
            <BaseButton v-else @click="$root.openModal"><i class="fal fa-sign-out"></i>Вход</BaseButton>
        </div>
    </div>
</template>

<script>
export default {
    name: "MobileBurger",
    data() {
        return {
            burger: {
                open: false,
            }
        }
    },
    methods: {
        openBurger() {
            this.burger.open = true;
        },
        closeBurger() {
            this.burger.open = false;
        },
        changeBurgerOpenState() {
            this.burger.open = !this.burger.open;
        }
    }
}
</script>

<style scoped>
    .mobile-burger-container {
        position: fixed;
        width: 100vw;
        height: 100vh;
        left: 0;
        top: 50px;
        background: var(--background);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 50px;
    }

    .section {
        font-size: 20px;
        margin-bottom: 10px;
        background: none;
    }
</style>
