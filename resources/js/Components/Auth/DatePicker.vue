<script setup>
import { ref } from 'vue';
import Calendar from './Calendar/Calendar.vue';

const model = defineModel({
  type: String
});

const props = defineProps({
  modelValue: String,
  activeCal: Boolean,
  removeDateString: Function,
  setDateString: Function
})

const openCal = ref(false)

const emit = defineEmits(["update:modelValue"])

function changeDate(date) {
  emit("update:modelValue", date)
}

const getNow = () => {
  const today = new Date()
  return getSendDate(today)
}

const getYesterday = () => {
  const today = new Date()
  today.setDate(today.getDate() - 1)
  return getSendDate(today)
}

const getSendDate = (today) => {
  const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  const dateTime = date +' '+ time;
  return dateTime;
}

const setActive = (e) => {
  let tabs = document.querySelectorAll('.picker_wrapper .check');
  tabs.forEach((tab) => {
    if (tab != e.target) tab.classList.remove('active')
  })

  if (e.target.classList.contains('calendarItem')) props.setDateString()
  else props.removeDateString()
  e.target.classList.add('active')
}

const closeCal = () => {
  openCal.value = false
}

</script>
<template>
  
  <div class="picker_wrapper">
    <div class="check today active" @click="setActive($event); changeDate(getNow())">Сегодня</div>
    <div class="check" @click="setActive($event); changeDate(getYesterday())">Вчера</div>
    <div class="check calendarItem" @click="setActive($event); openCal = true;">
      {{props.activeCal ? props.modelValue.split(' ')[0] : 'Выбрать дату'}}
    </div>
  </div>

  <Calendar :changeDate :openCal :closeCal/>

</template>
<style scoped lang="scss">

.picker_wrapper {
  display: flex;
  gap: 15px;
  align-items: center;
  margin-top: 15px;
  .check.active {
    border: 1px solid $accent;
    color: $accent;
  }
  .check {
    transition: all 0.3s ease;
    padding: 8px;
    text-align: center;
    width: 100%;
    font-weight: 400;
    font-size: 14px;
    line-height: 120%;
    color: $dark-font;
    border: 1px solid $light-grey;
    background: $light-grey;
    border-radius: 12px;
  }
}

</style>