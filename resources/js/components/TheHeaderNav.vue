<template>
  <nav class="header-nav">
    <InertiaLink
      as="button"
      :href="route('films')"
      :data="{type: 'Фильм'}"
      class="section"
    >
      Фильмы
    </InertiaLink>
    <InertiaLink
      as="button"
      :href="route('films')"
      :data="{type: 'Сериал'}"
      class="section"
    >
      Сериалы
    </InertiaLink>
  </nav>
</template>

<script>
export default {
	name: 'TheHeaderNav'
};
</script>

<style scoped>
.header-nav {
    display: flex;
    flex-direction: row;
    align-items: stretch;
}

.section {
    height: 100%;
    width: 77px;
    background: none;
    font-size: 14px;
}


@media (max-width: 768px) {
    .header-nav {
        display: none;
    }
}
</style>
