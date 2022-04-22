<template>
    <div>
        <i
            class="far fa-bars fa-lg mobile"
            @click="changeBurgerOpenState"
        />
        <div
            v-show="burger.open"
            class="mobile-burger-container"
        >
            <InertiaLink
                as="button"
                :href="route('films')"
                class="section"
            >
                Фильмы
            </InertiaLink>
            <InertiaLink
                as="button"
                :href="route('films')"
                class="section"
            >
                Сериалы
            </InertiaLink>

            <BaseButton
                v-if="$page.props.user && $page.url === '/user'"
                @click="$inertia.visit(route('user.logout'))"
            >
                <i class="fal fa-sign-out"/>Выход
            </BaseButton>

            <BaseButton
                v-else-if="$page.props.user"
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
        </div>
    </div>
</template>

<script>
import disableBodyScrollMixin from '../mixins/DisableBodyScrollMixin';

export default {
    name: 'MobileBurger',
    mixins: [disableBodyScrollMixin],
    data() {
        return {
            burger: {
                open: false,
            }
        };
    },
    watch: {
        burger: {
            deep: true,
            handler(value) {
                this.disableBodyScroll(value.open);
            }
        },
        '$page.url': {
            handler() {
                this.burger.open = false;
            }
        }
    },
    methods: {
        closeBurger() {
            this.burger.open = false;
        },
        changeBurgerOpenState() {
            this.burger.open = !this.burger.open;
        },
    }
};
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
