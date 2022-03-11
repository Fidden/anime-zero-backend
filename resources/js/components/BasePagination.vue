<template>
  <div
    v-if="meta.last_page > 1"
    class="pagination"
  >
    <InertiaLink
      v-for="link in meta.links"
      :key="link.label"
      class="pagination-block"
      :href="link.url"
      :data="filters"
    >
      <i
        v-if="link.label === 'prev'"
        class="fas fa-chevron-left"
      />
      <i
        v-else-if="link.label === 'next'"
        class="fas fa-chevron-right"
      />
      <span
        v-else
        :class="{'active': link.active}"
      >{{ link.label }}</span>
    </InertiaLink>
  </div>
</template>

<script>
export default {
	name: 'BasePagination',
	props: {
		meta: {
            type: Object,
            required: true,
        },
		filters: {
            type: Object,
            default: {},
        },
	}
};
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
