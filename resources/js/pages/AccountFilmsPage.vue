<template>
  <div class="account-container">
    <AccountProfileBar />
    <AccountFilms :films="films" />
  </div>
</template>

<script>
import AccountFilms from '../components/AccountFilms';
import AccountProfileBar from '../components/AccountProfileBar';

export default {
    name: 'AccountFilmsWatchedPage',
    components: {AccountFilms, AccountProfileBar},
    props: {
        films: {
            type: Object,
            required: true,
        },
    }
};
</script>

<style scoped>

</style>
