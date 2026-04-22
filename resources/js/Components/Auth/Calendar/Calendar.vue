<script setup>
import { computed, ref } from 'vue';
import CalendarGrid from './CalendarGrid.vue';
import CalendarHeader from './CalendarHeader.vue';

const today = new Date()
const currentMonth = ref(today.getMonth())      // Индекс месяца: 0 - январь
const currentYear = ref(today.getFullYear())
const selectedDate = ref(null) // Хранит выбранную дату

const props = defineProps({
  openCal: Boolean,
  closeCal: Function,
  changeDate: Function
})

const generateCalendar = () => {
    // 1. Определяем первый и последний день месяца
    const firstDayOfMonth = new Date(currentYear.value, currentMonth.value, 1)
    const lastDayOfMonth = new Date(currentYear.value, currentMonth.value + 1, 0)
    // 2. Определяем день недели для первого дня месяца: 0 - воскресенье
    let startDay = firstDayOfMonth.getDay()
    // Для недели, где Пн - первый, превращаем 0 в 6, иначе уменьшаем на 1
    startDay = (startDay + 6) % 7

    const days = []

    // 3. Добавляем предыдущие дни (от конца прошлого месяца, если нужно)
    for (let i = 0; i < startDay; i++) {
      const date = new Date(
        currentYear.value, 
        currentMonth.value, 
        -(startDay - i - 1)
      )
      days.push({
        date,
        currentMonth: false,
        isToday: isToday(date),
        isSelected: isSelected(date)
      })
    }

    // 4. Текущий месяц
    for (let d = 1; d <= lastDayOfMonth.getDate(); d++) {
      const date = new Date(currentYear.value, currentMonth.value, d)
      days.push({
        date,
        currentMonth: true,
        isToday: isToday(date),
        isSelected: isSelected(date)
      })
    }

    // 5. Дополняем до полного количества ячеек (6 строк по 7 дней)
    while (days.length % 7 !== 0) {
      const date = new Date(currentYear.value, currentMonth.value + 1, days.length - lastDayOfMonth.getDate() - startDay + 1)
      days.push({
        date,
        currentMonth: false,
        isToday: isToday(date),
        isSelected: isSelected(date)
      })
    }
    return days
}

const isToday = (date) => {
  // Проверяет, совпадает ли дата с сегодняшней
  return (
    date.getDate() === today.getDate() &&
    date.getMonth() === today.getMonth() &&
    date.getFullYear() === today.getFullYear()
  )
}

const isSelected = (date) => {
  if (!selectedDate.value) return false
  return (
    date.getDate() === selectedDate.value.getDate() &&
    date.getMonth() === selectedDate.value.getMonth() &&
    date.getFullYear() === selectedDate.value.getFullYear()
  )
}

const calendarDays = computed(() => { 
  return generateCalendar()
})

const prevMonth = ()=> {
  // Переход на предыдущий месяц
  if (currentMonth.value === 0) {
    currentMonth.value = 11
    currentYear.value -= 1
  } else {
    currentMonth.value -= 1
  }
}

const nextMonth = () => {
  // Переход на следующий месяц
  if (currentMonth.value === 11) {
    currentMonth.value = 0
    currentYear.value += 1
  } else {
    currentMonth.value += 1
  }
}

const selectDate = (day) => {
  if (!day.currentMonth) {
    // Если пользователь кликнул по дню из прошлого/следующего месяца — перелистываем месяц
    const date = day.date
    currentMonth.value = date.getMonth()
    currentYear.value = date.getFullYear()
  }

  let strDate = new Date(day.date - new Date().getTimezoneOffset() * 60000).toISOString().replace('T', ' ').replace('Z', '').split('.')[0];
  selectedDate.value = day.date
  props.closeCal()
  props.changeDate(strDate)
}

</script>
<template>
  <Transition name="slide-fade" mode="out-in">
    <div v-if="props.openCal" class="calendar_wrapper">
      <CalendarHeader :currentMonth :currentYear :prevMonth :nextMonth/>
      <CalendarGrid :calendarDays :selectDate />
    </div>
  </Transition>
</template>
<style scoped lang="scss">
.calendar_wrapper {
  border-radius: 20px;
  max-width: 410px;
  background: $dark;
  padding: 20px 15px;
  position: absolute;
  top: 0;
}
</style>
