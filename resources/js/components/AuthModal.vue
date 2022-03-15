<template>
    <div
        v-if="modal.open"
        class="black-out"
        @mousedown.self="$root.closeModal"
    >
        <transition name="shadow">
            <div class="modal-window">
                <i
                    class="fal fa-times fa-lg"
                    @click="$root.closeModal"
                />
                <img
                    src="/img/modal.svg"
                    alt="modal"
                >
                <h2 class="modal-window-title">
                    Hola!
                </h2>
                <div
                    v-if="modal.state === modal.enum.LOGIN"
                    class="modal-window-body"
                >
                    <h3>Войдите, что бы получить доступ к дополнительным возможностям</h3>
                    <ul class="validation-errors">
                        <li
                            v-for="(error, index) in $page.props.errors"
                            :key="index"
                        >
                            {{ error }}
                        </li>
                    </ul>
                    <form @submit.prevent="loginUser">
                        <input
                            v-model="authForm.login"
                            type="text"
                            placeholder="Логин"
                        >
                        <input
                            v-model="authForm.password"
                            type="password"
                            placeholder="Пароль"
                            class="last-input"
                        >
                        <label class="checkbox-label">
                            <input
                                v-model="authForm.remember"
                                type="checkbox"
                            >
                            Запомнить меня
                        </label>
                        <BaseButton>Войти</BaseButton>
                    </form>
                    <div class="modal-window-additional">
                        <p @click="$root.setModalState(modal.enum.REGISTER)">
                            Регистрация
                        </p>
                        <p @click="$root.setModalState(modal.enum.PASSWORD_RESET)">
                            Забыли пароль
                        </p>
                    </div>
                </div>
                <div
                    v-if="modal.state === modal.enum.REGISTER"
                    class="modal-window-body"
                >
                    <h3>Зарегистрируйтесь, что бы получить доступ к дополнительным возможностям</h3>
                    <ul class="validation-errors">
                        <li
                            v-for="(error, index) in $page.props.errors"
                            :key="index"
                        >
                            {{ error }}
                        </li>
                    </ul>
                    <form @submit.prevent="registerUser">
                        <input
                            v-model="registerForm.login"
                            type="text"
                            placeholder="Логин"
                        >
                        <input
                            v-model="registerForm.email"
                            type="email"
                            placeholder="Email"
                        >
                        <input
                            v-model="registerForm.password"
                            type="password"
                            placeholder="Пароль"
                        >
                        <input
                            v-model="registerForm.password_repeat"
                            type="password"
                            placeholder="Повтор пароля"
                            class="last-input"
                        >
                        <BaseButton class="register-button">
                            Зарегистрироваться
                        </BaseButton>
                    </form>
                    <div class="modal-window-additional">
                        <p @click="$root.setModalState(modal.enum.LOGIN)">
                            Авторизация
                        </p>
                        <p @click="$root.setModalState(modal.enum.PASSWORD_RESET)">
                            Забыли пароль
                        </p>
                    </div>
                </div>
                <div
                    v-if="modal.state === modal.enum.EMAIL_VERIFY"
                    class="modal-window-body"
                >
                    <ul class="validation-errors">
                        <li
                            v-for="(error, index) in $page.props.errors"
                            :key="index"
                        >
                            {{ error }}
                        </li>
                    </ul>
                    <h3>Письмо для подверждения email отправлено на {{ $page.props.user.email }}</h3>
                    <BaseButton
                        class="ok-btn"
                        @click="resendEmail"
                    >
                        Отправить повторно
                    </BaseButton>
                </div>
                <div
                    v-if="modal.state === modal.enum.PASSWORD_RESET"
                    class="modal-window-body"
                >
                    <h3>Для сброса пароля введите email привязанный к вашему аккаунту</h3>
                    <ul class="validation-errors">
                        <li
                            v-for="(error, index) in $page.props.errors"
                            :key="index"
                        >
                            {{ error }}
                        </li>
                    </ul>
                    <form>
                        <input v-model="registerForm.email"
                            class="reset-password"
                            type="email"
                            placeholder="Email"
                        >

                        <BaseButton
                            class="ok-btn"
                            @click="forgotPassword">
                            Сбросить пароль
                        </BaseButton>
                    </form>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3';
import BaseButton from './BaseButton';

export default {
    name: 'AuthModal',
    components: {BaseButton},
    setup() {
        const authForm = useForm({
            login: null,
            password: null,
            remember: false,
        });
        const registerForm = useForm({
            login: null,
            email: null,
            password: null,
            password_repeat: null,
        });

        const passwordResetForm = useForm({
            email: null,
        });

        return {authForm, registerForm, passwordResetForm};
    },
    computed: {
        modal() {
            return this.$root.modal;
        }
    },
    methods: {
        loginUser() {
            this.authForm.post(this.route('user.login'), {
                onSuccess: () => {
                    this.$root.closeModal();
                }
            });
        },
        registerUser() {
            this.registerForm.post(this.route('user.store'),
                {
                    onSuccess: () => {
                        this.$root.openModal();
                        this.$root.setModalState(this.modal.enum.EMAIL_VERIFY);
                    }
                });
        },
        resendEmail() {
            this.$inertia.post(this.route('verification.send'));
        },
        forgotPassword() {
            this.passwordResetForm.post(this.route('password.email'));
        }
    }
};
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


.modal-window-title {
    text-align: center;
    margin: 17px 0 13px 0;
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

.register-button {
    margin-top: 10px;
}

.reset-password {
    border-radius: 10px !important;
}

</style>
