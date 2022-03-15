<template>
    <div
        v-click-outside="Close"
        class="select"
    >
        <div
            class="select-head"
            @click="SwitchOpenState"
        >
            <p class="select-head-title">
                {{ title }}
            </p>
            <i
                class="fal fa-chevron-down"
                :class="{'open': open}"
            />
        </div>
        <div
            v-if="open"
            class="select-body"
        >
            <div
                v-for="option in options"
                :key="option.id"
                class="select-item"
                :class="{'active': IsSelected(option)}"
                @click="PushItem(option)"
            >
                {{ option.name }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BaseSelect',
    props: {
        title: {
            type: String,
            required: true,
        },
        options: {
            type: Array,
            required: true,
        },
        single: {
            type: Boolean,
            default: false,
        },
        backup: {
            type: Array,
            required: true,
        },
    },
    emits: ['change'],
    data() {
        return {
            open: false,
            selected: [],
        };
    },
    watch: {
        backup() {
            this.selected = this.backup;
        },
    },
    methods: {
        Close() {
            this.open = false;
        },
        SwitchOpenState() {
            this.open = !this.open;
        },
        PushItem(option) {
            if (this.IsSelected(option) && (!this.single && this.selected.length))
                this.RemoveItem(option);
            else {
                if (this.single)
                    this.selected = [option.name];
                else
                    this.selected.push(option.name);
            }

            this.$emit('change', this.selected);
        },
        RemoveItem(option) {
            this.selected = this.selected.filter(item => item !== option.name);
        },
        IsSelected(option) {
            return this.selected.findIndex(item => item === option.name) !== -1;
        }
    }
};
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
    font-family: 'Montserrat', sans-serif;
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
    font-family: 'Montserrat', sans-serif;
}

.fa-chevron-down {
    transition: 0.5s;
}

.open {
    transform: rotate(180deg);
}
</style>
