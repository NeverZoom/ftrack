<script setup>
defineProps({
  goal: Object
})
</script>

<template>
  <div class="goals__item">
    <div class="info">
      <div class="name">{{ goal.name }}</div>
      <div class="percent">{{ goal.percent }}%</div>
    </div>
    <div class="price">{{ goal.price.toLocaleString("ru-RU") }} ₽</div>
  </div>
</template>
<style lang="scss">
.goals__item {
  background: $accent;
  border-radius: 11px;
  padding: 10px;
  color: $light-font;
  display: flex;
  flex-direction: column;
  gap: 55px;
  justify-content: space-between;
  .info {
    display: flex;
    justify-content: space-between;
    .name {
      font-weight: 500;
      font-size: 18px;
      line-height: 100%;
      width: min-content;
    }
    .percent {
      font-weight: 900;
      font-size: 20px;
      line-height: 100%;
    }
  }
  .price {
    font-weight: 900;
    font-size: 30px;
    line-height: 100%;
    text-align: right;
  }
}
</style>