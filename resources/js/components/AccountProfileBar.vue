<template>
    <div class="profile-bar">
        <div class="profile-bar-avatar">
            <img
                v-if="user.avatar"
                :src="user.avatar"
                :alt="user.login"
            >
            <i
                v-else
                class="fal fa-user"
            />
            <button
                class="profile-bar-avatar-upload"
                @click="openCropper"
            >
                <i class="fal fa-upload"/> Загрузить
            </button>
        </div>
        <p class="profile-login">
            {{ user.login }}
        </p>
        <p class="profile-email">
            {{ user.email }}
        </p>
        <div class="profile-bar-sections-buttons">
            <InertiaLink
                v-for="section in profile_sections"
                :key="section.id"
                :class="{'active': $page.url === getRelativeUrl(section.route)}"
                as="p"
                :href="section.route"
            >
                {{ section.name }}
            </InertiaLink>
        </div>
        <!--todo: make as component-->
        <div
            v-show="cropper.open"
            class="image-cropper-container"
            @click.self="closeCropper"
        >
            <div class="image-cropper-block">
                <vueCropper
                    ref="cropper"
                    :img="cropper.image"
                    output-type="webp"
                    :auto-crop="true"
                    :can-move="true"
                    :can-move-box="false"
                    :auto-crop-width="250"
                    :auto-crop-height="250"
                    :fixed-box="true"
                    :center-box="true"
                />

                <input
                    ref="uploadImg"
                    type="file"
                    accept="image/png, image/jpeg, image/gif, image/jpg"
                    @change="uploadImg($event)"
                >

                <BaseButton @click="uploadUserAvatar">
                    Сохранить
                </BaseButton>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AccountProfileBar',
    data() {
        return {
            cropper: {
                open: false,
                image: null,
            },
            profile_sections: [
                {id: 0, name: 'Настройки', route: this.route('user.account')},
                {id: 1, name: 'Недавно просмотренные', route: this.route('user.watched')},
                {id: 2, name: 'Буду смотреть', route: this.route('user.want-to-watch')},
                {id: 3, name: 'Отслеживаемое', route: this.route('user.tracked')},
            ]
        };
    },
    computed: {
        user() {
            return this.$page.props.user;
        }
    },
    methods: {
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
                this.$inertia.put(this.route('user-avatar.update'), {
                        image: data,
                    },
                    {
                        onSuccess: this.closeCropper,
                    });
            });
        },
        uploadImg(e) {
            let file = e.target.files[0];
            if (!/\.(jpg|jpeg|png|JPG|PNG)$/.test(e.target.value)) {
                alert('Поддерживаются только jpeg,jpg,png');
                return false;
            }
            let reader = new FileReader();
            reader.onload = e => {
                let data;
                if (typeof e.target.result === 'object') {
                    data = window.URL.createObjectURL(new Blob([e.target.result]));
                } else {
                    data = e.target.result;
                }

                this.cropper.image = data;

                this.$refs.uploadImg.value = '';
            };
            reader.readAsArrayBuffer(file);
        },
        getRelativeUrl(value) {
            return value.replace(this.route().t.url, '');
        }
    },

};
</script>

<style scoped>
.profile-bar {
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    flex-grow: 1;
    max-width: 250px;
    margin-right: 50px;
    width: 100%;
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

@media (max-width: 768px) {
    .profile-bar {
        margin: 0 auto;
        text-align: center;
    }

    .profile-container {
        padding: 0 20px;
    }
}

</style>
