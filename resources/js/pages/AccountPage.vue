<template>
    <div class="account-container">
        <AccountProfileBar/>
        <div class="profile-container profile-settings">
            <div class="profile-settings-block">
                <label class="input-label">
                    Логин
                    <input type="text" placeholder="Введите ваш логин" v-model="profile_form.login">
                </label>
                <label class="input-label">
                    Email
                    <input type="text" placeholder="Введите ваш email" v-model="profile_form.email">
                </label>
                <label class="input-label">
                    Сменить пароль
                    <input type="password" placeholder="Введите старый пароль" v-model="profile_form.password_old">
                    <input type="password" placeholder="Введите новый пароль" v-model="profile_form.password_new">
                    <input type="password" placeholder="Подтвердите новый пароль"
                           v-model="profile_form.password_new_repeat">
                </label>
                <BaseButton @click="saveProfileChanges">Сохранить</BaseButton>
            </div>
            <div class="profile-settings-block">
                <label class="input-label">
                    Двухфакторная аутентификация
                    <input type="text" placeholder="Введите ник Telegram">
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import FilmCard from "../components/FilmCard";
import Pagination from "../components/Pagination";
import BaseButton from "../components/BaseButton";
import {useForm} from "@inertiajs/inertia-vue3";
import AccountFilmCard from "../components/AccountFilmCard";
import AccountProfileBar from "../components/AccountProfileBar";

export default {
    name: "AccountPage",
    components: {AccountProfileBar, AccountFilmCard, Pagination, FilmCard},
    props: {
        films: Object,
    },
    setup() {
        const profile_form = useForm({
            login: null,
            email: null,
            password_old: null,
            password_new: null,
            password_new_repeat: null,
        });
        return {profile_form};
    },
    computed: {
        user() {
            return this.$page.props.user;
        }
    },
    methods: {
        saveProfileChanges() {
            this.profile_form.put(route('user.update'));
        },
    }
}
</script>

<style scoped>

.input-label {
    display: flex;
    flex-direction: column;
    font-weight: bold;
    font-size: 16px;
    width: 100%;
}

.input-label input::placeholder {
    color: #888888;
}

.input-label input {
    background: #0C0C0C;
    border-radius: 5px;
    font-size: 14px;
    height: 37px;
    margin-bottom: 15px;
    outline: none;
    margin-top: 10px;
    padding: 0 10px;
    font-weight: 400;
    border: 1px solid #181818;
    color: white;
}


.profile-settings {
    display: flex;
    flex-direction: row;
    width: 100%;
}

.profile-settings-block {
    max-width: 300px;
    margin-right: 20px;
    width: 100%;
}

.profile-settings-block:last-child {
    margin: 0;
}

</style>
