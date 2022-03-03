<template>
    <div class="template">
        <BaseHeader/>
        <main>
            <div class="profile-bar">
                <div class="profile-bar-avatar">
                    <img :src="user.avatar" :alt="user.login" v-if="user.avatar">
                    <i class="fal fa-user" v-else></i>
                    <button class="profile-bar-avatar-upload" @click="openCropper">
                        <i class="fal fa-upload"></i> Загрузить
                    </button>
                </div>
                <p class="profile-login">{{ user.login }}</p>
                <p class="profile-email">{{ user.email }}</p>
                <div class="profile-bar-sections-buttons">
                    <p @click="setState(0)" :class="{'active': state === 0}">Настройки</p>
                    <p @click="setState(1)" :class="{'active': state === 1}">Недавно просмотренные</p>
                    <p @click="setState(2)" :class="{'active': state === 2}">Буду смотреть</p>
                    <p @click="setState(3)" :class="{'active': state === 3}">Отслеживаемое</p>
                </div>
            </div>
            <div class="profile-container profile-settings" v-if="state === 0">
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
            <div class="profile-container" v-else-if="state === 1">
                <div class="films-empty" v-if="!films.watched.data.length">
                    <img src="/img/hmm_emoji.webp" alt="hmm">
                    <h3>Хм, похоже тут ничего нет...</h3>
                </div>
                <div class="films-container" v-else>
                    <AccountFilmCard v-for="watched in films.watched.data"
                                     :key="watched.id"
                                     :item="watched"/>
                </div>
                <Pagination :meta="films.watched.meta"/>
            </div>
            <div class="profile-container" v-else-if="state === 2">
                <div class="films-empty" v-if="!films.want_to_watch.data.length">
                    <img src="/img/hmm_emoji.webp" alt="hmm">
                    <h3>Хм, похоже тут ничего нет...</h3>
                </div>
                <div class="films-container" v-else>
                    <AccountFilmCard v-for="want_to_watch in films.want_to_watch.data"
                                     :key="want_to_watch.id"
                                     :item="want_to_watch"/>
                </div>
                <Pagination :meta="films.want_to_watch.meta"/>
            </div>
            <div class="profile-container" v-else-if="state === 3">
                <div class="films-empty" v-if="!films.tracked.data.length">
                    <img src="/img/hmm_emoji.webp" alt="hmm">
                    <h3>Хм, похоже тут ничего нет...</h3>
                </div>
                <div class="films-container" v-else>
                    <AccountFilmCard v-for="tracked in films.tracked.data"
                                     :key="tracked.id"
                                     :item="tracked"/>
                </div>

                <Pagination :meta="films.tracked.meta"/>
            </div>
            <div class="image-cropper-container" v-show="cropper.open" @click.self="closeCropper">
                <div class="image-cropper-block">
                    <vueCropper
                        ref="cropper"
                        :img="cropper.image"
                        outputType="webp"
                        :autoCrop="true"
                        :canMove="true"
                        :canMoveBox="false"
                        :autoCropWidth="250"
                        :autoCropHeight="250"
                        :fixedBox="true"
                        :centerBox="true"
                    ></vueCropper>

                    <input ref="uploadImg" type="file" accept="image/png, image/jpeg, image/gif, image/jpg"
                           @change="uploadImg($event)">

                    <BaseButton @click="uploadUserAvatar">Сохранить</BaseButton>
                </div>

            </div>
        </main>
        <BaseFooter/>
    </div>
</template>

<script>
import FilmCard from "../components/FilmCard";
import Pagination from "../components/Pagination";
import BaseButton from "../components/BaseButton";
import {useForm} from "@inertiajs/inertia-vue3";
import AccountFilmCard from "../components/AccountFilmCard";

export default {
    name: "AccountPage",
    components: {AccountFilmCard, BaseButton, Pagination, FilmCard},
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
    data() {
        return {
            state: 0,
            cropper: {
                open: false,
                image: null,
            }
        }
    },
    computed: {
        user() {
            return this.$page.props.user;
        }
    },
    methods: {
        setState(value) {
            this.state = value;
        },
        saveProfileChanges() {
            this.profile_form.put(route('user.update'));
        },
        openCropper() {
            this.cropper.open = true;
            this.$refs.uploadImg.click();
        },
        closeCropper() {
            this.cropper.open = false;
            this.cropper.image = null;
        },
        uploadUserAvatar() {
            this.$refs.cropper.getCropData(data => {
                this.$inertia.put(route('user-avatar.update'), {
                        image: data,
                    },
                    {
                        onSuccess: this.closeCropper,
                    }
                )
            });
        },
        uploadImg(e) {
            let file = e.target.files[0];
            if (!/\.(jpg|jpeg|png|JPG|PNG)$/.test(e.target.value)) {
                alert("Поддерживаются только jpeg,jpg,png");
                return false;
            }
            let reader = new FileReader();
            reader.onload = e => {
                let data;
                if (typeof e.target.result === "object") {
                    data = window.URL.createObjectURL(new Blob([e.target.result]));
                } else {
                    data = e.target.result;
                }

                this.cropper.image = data;

                this.$refs.uploadImg.value = ''
            };
            reader.readAsArrayBuffer(file);
        },
    }
}
</script>

<style scoped>

main {
    margin-top: 40px;
    display: flex;
    flex-direction: row;
}

.profile-bar {
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    flex-grow: 1;
    max-width: 250px;
    margin-right: 50px;
}

.profile-bar-avatar {
    width: 100%;
    height: 100%;
    max-width: 250px;
    max-height: 250px;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    margin-bottom: 12px;
    flex-shrink: 0;
    flex-grow: 1;
}

.profile-bar-avatar i {
    width: 100%;
    height: 100%;
    background: #131313;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    font-size: 106px;
    color: #494949;
}

.profile-bar img {
    border-radius: 10px;
    margin-bottom: 12px;
}

.profile-bar-avatar-upload {
    position: absolute;
    left: 0;
    bottom: -40px;
    width: 100%;
    height: 40px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.5);
    border: none;
    outline: none;
    transition: 0.5s;
}

.profile-bar-avatar-upload i {
    background: none;
    font-size: 14px;
    color: white;
    width: auto;
    height: auto;
    margin-right: 5px;
    transform: translateY(-1px);
}

.profile-bar-avatar:hover .profile-bar-avatar-upload {
    transition: 0.5s;
    bottom: 0;
}


.profile-container {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.profile-login {
    font-weight: bold;
    font-size: 24px;
}

.profile-email {
    font-size: 14px;
    color: #8D8D8D;
}

.profile-bar-sections-buttons {
    margin-top: 25px;
}

.profile-bar-sections-buttons p {
    margin-bottom: 8px;
    font-weight: 600;
    font-size: 18px;
    color: #7E7E7E;
    cursor: pointer;
    transition: 0.5s;
}

.profile-bar-sections-buttons p.active {
    color: white;
    transition: 0.5s;
}

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

.films-empty {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.films-empty img {
    width: 120px;
    height: 120px;
    margin-bottom: 10px;
}

.films-empty h3 {
    font-size: 24px;
}

.films-container {
    display: grid;
    grid-template-rows: 235px;
    grid-template-columns: repeat(5, 166px);
    gap: 20px;
}

.image-cropper-container {
    position: fixed;
    width: 100vw;
    height: 100vh;
    left: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 100;
}

.image-cropper-block {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
}

.image-cropper-block .ti-btn {
    margin-left: auto;
}

.vue-cropper {
    height: 450px !important;
    width: 450px !important;
    overflow: hidden !important;
    border-radius: 15px !important;
    margin-bottom: 20px;
}

input[type='file'] {
    display: none;
}

@media (max-width: 550px) {
    main {
        display: flex;
        flex-direction: column;
    }

    .profile-bar {
        margin: 0 auto;
        text-align: center;
    }

    .films-empty {
        height: 40vh;
    }

    .films-container {
        grid-template-rows: 190px;
        grid-template-columns: repeat(2, 135px);
    }

    .profile-container {
        padding: 0 20px;
    }
}


</style>
