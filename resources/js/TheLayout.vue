<template>
    <div class="template">
        <TheHeader/>
        <main>
            <slot/>
        </main>
        <TheFooter/>
        <AuthModal/>
        <Notification/>
    </div>
</template>

<script>
import AuthModal from './components/AuthModal';
import TheHeader from './components/TheHeader';
import TheFooter from './components/TheFooter';
import Notification from './components/Notification';
import {mapActions} from 'vuex';

export default {
    name: 'TheLayout',
    components: {AuthModal, Notification, TheFooter, TheHeader},
};
</script>

<style scoped>

</style>
