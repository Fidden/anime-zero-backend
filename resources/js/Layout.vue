<template>
    <div class="template">
        <TheHeader/>
        <main>
            <slot/>
        </main>
        <TheFooter/>
    </div>
</template>

<script>
import TheHeader from "./components/TheHeader";
import TheFooter from "./components/TheFooter";
export default {
    name: "Layout",
    components: {TheFooter, TheHeader}
}
</script>

<style scoped>

</style>
