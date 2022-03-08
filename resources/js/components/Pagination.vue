<template>
    <div class="pagination" v-if="meta.last_page > 1">
        <InertiaLink
            class="pagination-block"
            v-for="link in meta.links" :key="link.label"
            :href="link.url">

            <i class="fas fa-chevron-left" v-if="link.label === 'prev'"></i>
            <i class="fas fa-chevron-right" v-else-if="link.label === 'next'"></i>
            <span v-else :class="{'active': link.active}">{{ link.label }}</span>
        </InertiaLink>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        meta: Object,
    }
}
</script>

<style scoped>
.pagination {
    background: #1B1B1B;
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 6px 0;
    border-radius: 8px;
    font-size: 14px;
    margin-left: auto;
}

.pagination-block {
    margin: 0 10px;
    text-decoration: none;
}

.pagination-block span {
    text-align: center;
    font-size: 16px;
    color: #B4B4B4;
    font-family: 'Montserrat', sans-serif;
}

.active {
    background: var(--main-color);
    color: white;
    border-radius: 4px;
    padding: 2px 5px 2px 4px;
    font-weight: bold;
}

</style>
