<script setup>
  const props = defineProps({
    currentMonth: Number,
    currentYear: Number,
    prevMonth: Function,
    nextMonth: Function
  });

  const monthNames = [
    'Январь', 'Февраль', 'Март', 'Апрель', 
    'Май', 'Июнь', 'Июль', 'Август', 
    'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
  ]

</script>
<template>
  <div class="calendar-header">
    <div @click="props.prevMonth">
      <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.37365 0.068182C9.70766 0.243979 9.83424 0.679956 9.65844 1.03507C9.63031 1.09132 7.83366 2.90907 5.66433 5.06786L1.71944 8.99868L5.66433 12.926C7.83366 15.0883 9.63031 16.906 9.65844 16.9623C9.83775 17.3244 9.70415 17.7569 9.36662 17.9292C9.19082 18.0206 8.86384 18.0241 8.70913 17.9362C8.52982 17.8413 0.161872 9.50498 0.0774889 9.33621C0.0247498 9.24128 0.000138283 9.12877 0.000138283 8.99868C0.000138283 8.86859 0.0247498 8.75608 0.0774889 8.66115C0.165388 8.49239 8.53334 0.15608 8.70913 0.0611496C8.86735 -0.0232334 9.20488 -0.0197182 9.37365 0.068182Z" fill="white"/>
      </svg>
    </div>
    <span>{{ monthNames[currentMonth] }} {{ currentYear }}</span>
    <div @click="props.nextMonth">
      <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.364633 0.068182C0.0306184 0.243979 -0.0959557 0.679956 0.0798416 1.03507C0.107969 1.09132 1.90462 2.90907 4.07396 5.06786L8.01885 8.99868L4.07396 12.926C1.90462 15.0883 0.107969 16.906 0.0798416 16.9623C-0.0994716 17.3244 0.0341343 17.7569 0.371665 17.9292C0.547462 18.0206 0.874445 18.0241 1.02915 17.9362C1.20846 17.8413 9.57641 9.50498 9.66079 9.33621C9.71353 9.24128 9.73814 9.12877 9.73814 8.99868C9.73814 8.86859 9.71353 8.75608 9.66079 8.66115C9.57289 8.49239 1.20494 0.15608 1.02915 0.0611496C0.870929 -0.0232334 0.533399 -0.0197182 0.364633 0.068182Z" fill="white"/>
      </svg>
    </div>
  </div>
</template>
<style scoped lang="scss">
  .calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 8px 0;
    font-weight: 500;
    font-size: 18px;
    line-height: 120%;
    color: $light-font;
    margin-bottom: 35px;
  }
</style>