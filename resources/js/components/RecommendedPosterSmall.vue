<template>
    <InertiaLink
        :href="route('film.show', item.film.id)"
        as="div"
        class="poster-small">
        <img
            :src="poster"
            :alt="item.film.title"
        >
        <div class="poster-info">
            <p class="poster-title">
                {{ item.film.title }}
            </p>
            <p class="poster-description">
                {{ item.film.description }}
            </p>
        </div>
    </InertiaLink>
</template>

<script>
//text-overflow: ellipsis;
export default {
    name: 'RecommendedPosterSmall',
    props: {
        item: {
            type: Object,
            required: true,
        }
    },
    computed: {
        poster() {
            return this.item.poster || this.item.film.poster;
        }
    }
};
</script>

<style scoped>
.poster-small {
    background: #0F0F0F;
    display: flex;
    flex-direction: row;
    cursor: pointer;
}

.poster-small img {
    width: 160px;
    margin-right: 20px;
    object-fit: scale-down;
}

.poster-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 10px;
}

.poster-title {
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 10px;
}

.poster-description {
    font-size: 14px;
    color: #B7B7B7;
    -webkit-line-clamp: 9;
    display: -webkit-box;
    line-height: 15px;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>
