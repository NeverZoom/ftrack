<script setup>
import DashboardMenu from "@/Components/Auth/Dashboard/DashboardMenu.vue";

</script>

<template>
    <div>
        <template v-if="$page.props.flash.message">
            <div class="flash-message">
                {{ $page.props.flash.message }}
            </div>
        </template>

        <header v-if="$slots.header">
            <div class="mx-auto">
                <slot name="header" />
            </div>
        </header>

        <main>
            <slot />
        </main>

        <div class="menu_wrapper_h"></div>
        <DashboardMenu />
    </div>
</template>

<style lang="scss">
body {
    background: $bg;
}
.menu_wrapper_h {
    margin-bottom: 100px;
    display: block;
}
</style>
