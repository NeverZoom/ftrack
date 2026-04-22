<script setup>
import { computed, ref } from 'vue';

const tabFirst = ref(true)
const tabSecond = ref(false)

const changeTab = () => {
  tabFirst.value = !tabFirst.value
  tabSecond.value = !tabSecond.value
}

</script>
<template>

  <div class="tabs">

    <div class="tabs_nav">
      <div class="trigger" :class="tabFirst ? 'active' : ''" @click="changeTab">Доходы</div>
      <div class="trigger" :class="tabSecond ? 'active' : ''" @click="changeTab">Расходы</div>
    </div>

    <div class="tabs_content">
      <Transition name="slide-fade" mode="out-in">
        <div v-if="tabFirst">
          <slot name="firstTab" />
        </div>
        <div v-else-if="tabSecond">
          <slot name="secondTab" />
        </div>
      </Transition>
    </div>
    
  </div>

</template>

<style scoped lang="scss">
.tabs_nav {
  border-radius: 12px;
  background: $light-grey;
  padding: 4px;
  display: flex;
  gap: 4px;
  margin-bottom: 25px;
  .trigger.active {
    box-shadow: 0 3px 10px 0 rgba($dark, 0.06);
    background: $bg;
  }
  .trigger {
    width: 50%;
    padding: 11px;
    @include flex-center;
    font-weight: 400;
    font-size: 18px;
    line-height: 100%;
    color: $dark-font;
    border-radius: 8px;
    transition: all 0.5s ease;
  }
}

</style>