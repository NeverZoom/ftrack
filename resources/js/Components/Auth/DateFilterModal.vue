<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { computed, ref, reactive, watch } from 'vue';

const props = defineProps({
  isModal: Boolean,
  closeModal: Function,
  firstdate: {
    type: Object,
    default: () => ({}),
  },
  filters: {
    type: Object,
    default: () => ({}),
  }
})

const page = usePage()

let activeDate = ref(null)
let nonFilter = ref(true)

const form = reactive({
  month: props.filters.month,
  year: props.filters.year,
});

watch(form, (value) => {
  router.visit(
    route('home'),
    {
    data: { month: form.month, year: form.year, page: undefined},
    only: ['transactions', 'filters', 'allIncome', 'allExpence', 'lastIncome', 'lastExpence'],
    preserveState: true,
    replace: true,
    reset: ['transactions', 'filters', 'allIncome', 'allExpence', 'lastIncome', 'lastExpence'],
    },
    
  );
});

var allMonths = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь']
// var allMonths = ['Декабрь', 'Ноябрь', 'Октябрь', 'Сентябрь', 'Август', 'Июль', 'Июнь', 'Май', 'Апрель', 'Март', 'Февраль', 'Январь']

var fisrtdate = page.props.firstdate.publish_date.split(' ')[0]
var year = fisrtdate.split("-")[0]
var month = fisrtdate.split("-")[1]

var now = new Date()
var currrentMonth = now.getMonth()
var currrentYear = now.getFullYear()
var loopDate = new Date(currrentYear, currrentMonth)

const monthsList = computed(() => {
  const months = []
  let current = new Date(year, month-1)

  // Цикл до текущей даты
  while (loopDate >= current) {
    let selectedYear = current.getFullYear()
    const month = current.getMonth();
    const month_full = String(current.getMonth() + 1).padStart(2, '0');
    months.push({ selectedYear: selectedYear, month: month, month_full: month_full })
    // Увеличиваем месяц
    current.setMonth(current.getMonth() + 1)
  }
  return months.reverse()
})

const toggleDate = (year, month, index) => {
  nonFilter.value = false;

  if (activeDate.value == index) {
    form.year = currrentYear;
    form.month = currrentMonth + 1;
    activeDate.value = 0;
  } else {
    activeDate.value = index;
    form.year = year;
    form.month = month;
  }

  props.closeModal()
}

</script>

<template>
  <div class="modal-overlay transaction" :class="{ active: props.isModal }" @click="props.closeModal">
    <div class="modal-scroll">
      <div class="modal__wrapper">
        <div class="modal" @click.stop>
          <div class="modal_hide-line" v-touch:swipe.bottom="props.closeModal"></div>
          <div class="content">
            <div class="date_wrapper">
              <div class="year">
                <template v-for="(item, index) in monthsList" :key="item" >
                  <template v-if="index != 0">
                    <div class="title" v-if="monthsList[index - 1].selectedYear != monthsList[index].selectedYear">{{ item.selectedYear }}</div>
                  </template>
                  <template v-else>
                    <div class="title">{{ item.selectedYear }}</div>
                  </template>
                  
                  <div class="item" :class="activeDate == index ? 'active' : ''" @click="toggleDate(item.selectedYear, item.month_full, index)">{{ allMonths[item.month] }}</div>

                </template>
              </div>
            </div>
          </div>
          <!-- START hidden -->
          <div class="close d-none" @click="props.closeModal">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_2017_633)">
              <path d="M0.75 0.75L11.4314 11.2813" stroke="#252525" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M11.4313 0.75L0.75 11.2813" stroke="#252525" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round"/>
              </g>
              <defs>
              <clipPath id="clip0_2017_633">
              <rect width="12" height="12" fill="white"/>
              </clipPath>
              </defs>
            </svg>
          </div>
          <!-- END hidden -->
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
  .date_wrapper {
    .title {
      margin-bottom: 10px;
      margin-top: 10px;
      font-weight: 900;
      font-size: 40px;
      line-height: 120%;
      color: $dark-font;
    }
    .year {
      // margin-bottom: 20px;
      display: flex;
      gap: 10px 20px;
      flex-wrap: wrap;
      .title {
        width: 100%;
        &:first-child {
          margin-top: 0;
        }
      }
      .item.active {
        border: 1px solid $accent;
      }
      .item {
        width: calc(100% / 3 - (40px / 3));
        font-weight: 500;
        font-size: 14px;
        line-height: 120%;
        color: $dark-font;
        border: 1px solid $grey;
        border-radius: 20px;
        padding: 10px;
        @include flex-center
      }
    }
  }
</style>