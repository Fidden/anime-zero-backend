<template>
    <InertiaLink
        :href="route('film.show', item.id)"
        class="account-film-card"
        :style="{backgroundImage: `url(${item.film.poster})`}"
    >
        <p>{{ item.film.title }}<br><span v-if="item.film.year">({{ item.film.year }})</span></p>
        <div class="black"/>
    </InertiaLink>
</template>

<script>
export default {
    name: 'AccountFilmCard',
    props: {
        item: {
            type: Object,
            required: true,
        }
    }
};
</script>

<style scoped>
.account-film-card {
    position: relative;
    border-radius: 15px;
    background-size: cover;
    cursor: pointer;
    transition: 0.5s;
}

.account-film-card:hover p, .account-film-card:hover .black {
    opacity: 0;
    transition: 0.5s;
}

.account-film-card .black {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    transition: 0.5s;
}

.black {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 100%);
}

.account-film-card p {
    position: absolute;
    left: 15px;
    bottom: 15px;
    z-index: 10;
    font-weight: bold;
    font-size: 14px;
    transition: 0.5s;
}
</style>
