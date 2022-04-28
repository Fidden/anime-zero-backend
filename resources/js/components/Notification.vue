<template>
    <div class="notification-container">
        <transition-group name="notify">
            <div
                v-for="note in notifications"
                :key="note.id"
                class="notification-block"
                @click="$store.dispatch('removeNotification', note.id)">
                <i class="fal fa-times fa-lg"/>
                <h4 v-if="note.title">
                    {{ note.title }}
                </h4>
                <p v-if="note.body">
                    {{ note.body }}
                </p>
            </div>
        </transition-group>
    </div>
</template>

<script>
export default {
    name: 'Notification',
    computed: {
        notifications() {
            return this.$store.state.notification;
        }
    }
};
</script>

<style scoped>
.notification-container {
    display: flex;
    flex-direction: column;
    position: fixed;
    width: fit-content;
    height: 100vh;
    right: 0;
    top: 0;
    align-items: flex-end;
    padding: 20px;
    justify-content: flex-end;
}

.notification-block {
    display: flex;
    flex-direction: column;
    background: var(--main-color);
    border-radius: 5px;
    padding: 10px;
    position: relative;
    cursor: pointer;
}

.notification-block h4 {
    margin: 0;
}

.notification-block i {
    position: absolute;
    right: 10px;
    font-size: 14px;
    top: 10px;
    transform: translateY(25%);
}


.notify-enter-active, .notify-leave-active {
    transition: 0.5s;
    transform: translateX(0);
}

.notify-enter, .notify-leave-to {
    opacity: 0;
    transform: translateX(150%);
}

</style>
