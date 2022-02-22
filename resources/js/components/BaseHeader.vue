<template>
    <header>
        <InertiaLink as="h1" :href="route('film')">Anime<span>Zero</span></InertiaLink>
        <InertiaLink as="button" class="section">Каталог</InertiaLink>
        <InertiaLink as="button" class="section">Фильмы</InertiaLink>
        <InertiaLink as="button" class="section">Сериалы</InertiaLink>
        <div class="search-bar">
            <input type="text" placeholder="Популярные новинки">
            <button></button>
        </div>
    </header>
</template>

<script>
export default {
    name: "BaseHeader",
    mounted() {
        console.log(this.$routes)
    }
}
</script>

<style scoped>

header {
    display: flex;
    flex-direction: row;
    align-items: center;
}

h1 {
    font-weight: bold;
    font-size: 32px;
}

h1 span{
    color: var(--main-color);
}


</style>
