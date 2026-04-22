<script setup>
const props = defineProps({
  calendarDays: Array,
  selectDate: Function
});
const weekDays = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс']
</script>
<template>
  <div class="calendar-grid">
    <div class="calendar-weekdays">
      <div v-for="wday in weekDays" :key="wday">{{ wday }}</div>
    </div>
    <div class="calendar-days">
      <div
        v-for="(day, idx) in calendarDays"
        :key="idx"
        :class="{
            'not-current-month': !day.currentMonth,
            today: day.isToday,
            selected: day.isSelected,
        }"
        @click="props.selectDate(day)"
      >
        {{ day.date.getDate() }}
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">

.calendar-days {
  display: flex;
  gap: 15px 5px;
  flex-wrap: wrap;
  div {
    width: calc(100% / 7 - 30px / 7);
    height: 50px;
    cursor: pointer;
    display: inline-block;
    font-weight: 500;
    font-size: 16px;
    line-height: 100%;
    color: $light-font;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
  }
}
.calendar-days > div.today {
  color: $accent;
}
.calendar-days > div.selected {
  border: 1px solid $accent;
  color: $accent;
}
.calendar-days > div.not-current-month {
  font-weight: 500;
  font-size: 16px;
  line-height: 100%;
  color: rgba($light-grey, 0.6);
}
.calendar-weekdays {
  display: flex;
  margin-bottom: 15px;
  div {
    width: calc(100% / 7);
    text-align: center;
    font-weight: 300;
    font-size: 14px;
    line-height: 120%;
    color: rgba($grey, 0.8);
  }
}

</style>
