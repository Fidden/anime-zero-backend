<template>
    <div class="account-container">
        <AccountProfileBar/>
        <div class="profile-container profile-settings">
            <form
                class="profile-settings-block"
                @submit.prevent>
                <label class="input-label">
                    Логин
                    <input
                        v-model="profile_form.login"
                        type="text"
                        placeholder="Введите ваш логин"
                    >
                </label>
                <label class="input-label">
                    Email
                    <input
                        v-model="profile_form.email"
                        type="text"
                        placeholder="Введите ваш email"
                    >
                </label>
                <label class="input-label">
                    Сменить пароль
                    <input
                        v-model="profile_form.password_old"
                        type="password"
                        placeholder="Введите старый пароль"
                        autocomplete="on"
                    >
                    <input
                        v-model="profile_form.password_new"
                        type="password"
                        placeholder="Введите новый пароль"
                        autocomplete="on"
                    >
                    <input
                        v-model="profile_form.password_new_repeat"
                        type="password"
                        placeholder="Подтвердите новый пароль"
                        autocomplete="on"
                    >
                </label>
                <BaseButton @click="saveProfileChanges">
                    Сохранить
                </BaseButton>
            </form>
            <form
                class="profile-settings-block"
                @submit.prevent>
                <label class="input-label">
                    Двухфакторная аутентификация ( Скоро )
                    <input
                        type="text"
                        placeholder="Введите ник Telegram"
                    >
                </label>
            </form>
        </div>
    </div>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3';
import AccountProfileBar from '../components/AccountProfileBar';

export default {
    name: 'AccountPage',
    components: {AccountProfileBar},
    props: {
        films: {
            type: Object,
            required: true
        },
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
            this.profile_form.put(this.route('user.update'));
        },
    }
};
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
