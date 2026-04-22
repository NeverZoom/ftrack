<template>
    <button class="button">
        <slot />
    </button>
</template>
<style scoped lang="scss">
.button {
  margin: 0 auto;
  margin-top: 22px; 
  display: block;
  padding: 9px 37px;
  font-weight: 500;
  font-size: 16px;
  line-height: 120%;
  color: $light-font;
  border-radius: 11px;
  background: $accent;
}
</style>