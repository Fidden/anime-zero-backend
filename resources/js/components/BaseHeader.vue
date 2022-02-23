<template>
    <header>
        <InertiaLink as="h1" :href="route('home')">Anime<span>Zero</span></InertiaLink>
        <InertiaLink as="button" class="section">Каталог</InertiaLink>
        <InertiaLink as="button" class="section">Фильмы</InertiaLink>
        <InertiaLink as="button" class="section">Сериалы</InertiaLink>
        <div class="search-bar">
            <input type="text" placeholder="Популярные новинки">
            <button><i class="fas fa-search"></i></button>
        </div>
        <BaseButton><i class="fal fa-sign-out"></i>Выход</BaseButton>
    </header>
</template>

<script>
export default {
    name: "BaseHeader",
}
</script>

<style scoped>

header {
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 100%;
    height: 55px;
    z-index: 50;
    background: var(--background);
}

h1 {
    font-weight: bold;
    font-size: 32px;
    margin-right: 14px;
    cursor: pointer;
}

h1 span {
    color: var(--main-color);
}

.section {
    height: 100%;
    width: 77px;
    background: none;
    font-size: 14px;
}

.search-bar {
    width: 100%;
    display: flex;
    flex-direction: row;
    height: 38px;
    margin: 0 16px 0 30px;
}

.search-bar input {
    width: 100%;
    border-radius: 5px 0px 0px 5px;
    padding: 0 15px;
    outline: none;
    border: none;
}

.search-bar button {
    background: #181818;
    border-radius: 0px 5px 5px 0px;
    width: 32px;
}

.ti-btn {
    height: 38px;
    font-size: 14px;
}

</style>
