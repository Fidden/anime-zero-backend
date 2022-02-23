<template>
    <button class="ti-btn" ref="tiBtn" @click="animateRipple">
        <slot></slot>
        <transition-group v-if="ripples.length > 0">
            <span
                class="ripple"
                :ref="'ripple-' + i"
                :key="'ripple' + i"
                v-for="(item, i) in ripples"
                :style="{'top': item.y + 'px', 'left': item.x + 'px'}"
            >
            </span>
        </transition-group>
    </button>
</template>

<script>
export default {
    name: "BaseButton",
    data() {
        return {
            ripples: []
        }
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
}
</script>

<style scoped>

i {
    margin-right: 5px;
}


</style>
