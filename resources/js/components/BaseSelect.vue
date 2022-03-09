<template>
    <div class="select" v-click-outside="Close">
        <div class="select-head" @click="SwitchOpenState">
            <p class="select-head-title">{{ title }}</p>
            <i class="fal fa-chevron-down"></i>
        </div>
        <div class="select-body" v-if="open">
            <div class="select-item"
                 :class="{'active': IsSelected(option)}"
                 v-for="option in options"
                 :key="option.id"
                 @click="PushItem(option)">
                {{ option.name }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseSelect",
    props: {
        title: String,
        options: Array,
    },
    data() {
        return {
            open: false,
            selected: [],
        }
    },
    methods: {
        Close() {
            this.open = false;
        },
        SwitchOpenState() {
            this.open = !this.open;
        },
        PushItem(option) {
            if (this.IsSelected(option))
                this.RemoveItem(option);
            else
                this.selected.push(option);

            this.$emit('change', this.selected);
        },
        RemoveItem(option) {
            this.selected = this.selected.filter(item => item.id !== option.id);
        },
        IsSelected(option) {
            return this.selected.findIndex(item => item.id === option.id) !== -1;
        }
    }
}
</script>

<style scoped>
.select {
    display: flex;
    flex-direction: column;
    flex: 1;
    position: relative;
}

.select-head {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 0 14px;
    background: #222222;
    border-radius: 3px;
    height: 100%;
    cursor: pointer;
}

.select-head-title {
    margin-right: auto;
}

.select-body {
    background: #222222;
    border-radius: 3px;
    position: absolute;
    left: 0;
    top: calc(100% + 10px);
    width: 100%;
    overflow-y: scroll;
    max-height: 200px;
    padding: 14px 0 0 0;
    z-index: 100;
}

.fa-chevron-down {
    font-size: 14px;
}

.active {
    color: var(--main-color);
    font-weight: bold;
}

.select-item {
    padding: 0 14px;
    cursor: pointer;
    margin-bottom: 14px;
}
</style>
