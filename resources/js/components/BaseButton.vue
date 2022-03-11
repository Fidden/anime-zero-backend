<template>
  <button
    ref="tiBtn"
    class="ti-btn"
    @click="animateRipple"
  >
    <slot />
    <transition-group v-if="ripples.length > 0">
      <span
        v-for="(item, i) in ripples"
        :ref="'ripple-' + i"
        :key="'ripple' + i"
        class="ripple"
        :style="{'top': item.y + 'px', 'left': item.x + 'px'}"
      />
    </transition-group>
  </button>
</template>

<script>
export default {
	name: 'BaseButton',
    emits: ['click'],
	data() {
		return {
			ripples: []
		};
	},
	methods: {
		animateRipple(e) {
			let el = this.$refs.tiBtn;
			let pos = el.getBoundingClientRect();

			this.ripples.push({
				x: e.clientX - pos.left,
				y: e.clientY - pos.top,
				show: true
			});

			this.$emit('click');

			this.rippleEnd();
		},
		rippleEnd() {
			setTimeout(() =>  this.ripples.shift(), 3000);
		},
	},
};
</script>

<style scoped>

i {
    margin-right: 5px;
}

</style>
