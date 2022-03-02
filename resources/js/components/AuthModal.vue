<template>
    <div class="black-out" v-if="modal.open" @mousedown.self="$root.closeModal">
        <transition name="shadow">
            <div class="modal-window">
                <i class="fal fa-times fa-lg" @click="$root.closeModal"></i>
                <img src="/img/modal.svg" alt="modal">
                <h2>Hola!</h2>
                <div class="modal-window-body" v-if="modal.state === modal.enum.LOGIN">
                    <h3>Войдите, что бы получить доступ к дополнительным возможностям</h3>
                    <ul class="validation-errors">
                        <li v-for="error in $page.props.errors">{{ error }}</li>
                    </ul>
                    <form @submit.prevent="loginUser">
                        <input type="text" placeholder="Логин" v-model="auth_form.login">
                        <input type="password" placeholder="Пароль" v-model="auth_form.password" class="last-input">
                        <label class="checkbox-label">
                            <input type="checkbox" v-model="auth_form.remember">
                            Запомнить меня
                        </label>
                        <BaseButton>Войти</BaseButton>
                    </form>
                    <div class="modal-window-additional">
                        <p @click="$root.setModalState(modal.enum.REGISTER)">Регистрация</p>
                        <p @click="$root.setModalState(modal.enum.PASSWORD_RESET)">Забыли пароль</p>
                    </div>
                </div>
                <div class="modal-window-body" v-if="modal.state === modal.enum.REGISTER">
                    <h3>Зарегистрируйтесь, что бы получить доступ к дополнительным возможностям</h3>
                    <ul class="validation-errors">
                        <li v-for="error in $page.props.errors">{{ error }}</li>
                    </ul>
                    <form @submit.prevent="registerUser">
                        <input type="text" placeholder="Логин" v-model="register_form.login">
                        <input type="email" placeholder="Email" v-model="register_form.email">
                        <input type="password" placeholder="Пароль" v-model="register_form.password">
                        <input type="password" placeholder="Повтор пароля" v-model="register_form.password_repeat"
                               class="last-input">
                        <BaseButton>Зарегистрироваться</BaseButton>
                    </form>
                    <div class="modal-window-additional">
                        <p @click="$root.setModalState(modal.enum.LOGIN)">Авторизация</p>
                        <p @click="$root.setModalState(modal.enum.PASSWORD_RESET)">Забыли пароль</p>
                    </div>
                </div>
                <div class="modal-window-body" v-if="modal.state === modal.enum.EMAIL_VERIFY">
                    <ul class="validation-errors">
                        <li v-for="error in $page.props.errors">{{ error }}</li>
                    </ul>
                    <h3>Письмо для подверждения email отправлено на {{ $page.props.user.email }}</h3>
                    <BaseButton class="ok-btn" @click="resendEmail">Отправить повторно</BaseButton>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import BaseButton from "./BaseButton";
import modalWindowMixin from "../mixins/modalWindowMixin";

export default {
    name: "AuthModal",
    components: {BaseButton},
    setup() {
        const auth_form = useForm({
            login: null,
            password: null,
            remember: false,
        });
        const register_form = useForm({
            login: null,
            email: null,
            password: null,
            password_repeat: null,
        });

        return {auth_form, register_form};
    },
    methods: {
        loginUser() {
            this.auth_form.post(route('user.login'));
        },
        registerUser() {
            this.register_form.post(route('user.store'),
                {
                    onSuccess: () => {
                        this.$root.openModal();
                        this.$root.setModalState(this.modal.enum.EMAIL_VERIFY);
                    }
                });
        },
        resendEmail() {
            this.$inertia.post(route('verification.send'));
        }
    },
    computed: {
        modal() {
            return this.$root.modal;
        }
    }
}
</script>

<style scoped>
.black-out {
    position: fixed;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    z-index: 100;
    background: rgba(0, 0, 0, 0.8);
}

.fa-times {
    position: absolute;
    right: 20px;
    top: 20px;
    transition: 0.5s;
    cursor: pointer;
}

.fa-times:hover {
    transform: rotate(180deg);
    transition: 0.5s;
}

.modal-window {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    max-width: 290px;
    background: var(--background);
    border-radius: 20px;
    overflow: hidden;
    width: 100%;
    box-shadow: 0 0 50px rgba(100, 63, 254, 0.94);
}

.modal-window img {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: auto;
    z-index: -1;
}


.modal-window h2 {
    text-align: center;
    margin-top: 35px;
}

.modal-window-body {
    padding: 20px;
}

.modal-window-body h3 {
    max-width: 200px;
    font-size: 14px;
    font-weight: 400;
    text-align: center;
    margin: 0 auto 10px auto;
}

.modal-window-body form {
    display: flex;
    flex-direction: column;
}

.modal-window-body form input[type='text'], input[type='password'], input[type='email'] {
    border-radius: 0;
    height: 37px;
    border: none;
    outline: none;
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 0 15px;
    font-size: 14px;
    font-weight: 400;
    color: black;
    border-bottom: 1px solid #cbcbcb !important;
}

.modal-window form input[type='text']:first-child {
    border-radius: 10px 10px 0 0;
}

input[type='checkbox'] {
    margin: 10px 5px 10px 0;
}

.checkbox-label {
    display: flex;
    flex-direction: row;
    align-items: center;
    font-size: 14px;
    font-weight: 400;
}

.last-input {
    border-radius: 0 0 10px 10px !important;
}

.modal-window-additional {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    margin-top: 20px;
    transition: 0.5s;
}

.modal-window-additional p {
    cursor: pointer;
}

.modal-window-additional p:hover {
    color: var(--main-color);
    transition: 0.5s;
}

.shadow-enter, .shadow-leave-to {
    box-shadow: 0 0 10px #00000000;
}

.shadow-enter-active, .shadow-leave-active {
    transition: 0.5s;
    box-shadow: 0 0 10px var(--main-color);
}

.validation-errors {
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 10px 0;
    padding: 0;
}

.validation-errors li {
    margin: 0;
    padding: 0;
    color: red;
    text-align: center;
}

.ok-btn {
    width: 100%;
    margin-top: 20px;
}

</style>
