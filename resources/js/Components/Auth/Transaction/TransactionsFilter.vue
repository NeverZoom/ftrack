<script setup>
import { reactive, ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  transactions: {
    type: Object,
    default: () => ({}),
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
  availableCats: {
    type: Object,
    default: () => ({}),
  },
});

let activeType = ref(null)
let activeCat = ref(null)
let nonFilter = ref(true)

const form = reactive({
  category: props.filters.category,
  type: props.filters.type,
});

watch(form, (value) => {
  router.visit(
    route('transactions'),
    {
    data: { category: form.category, type: form.type, page: undefined},
    only: ['transactions', 'availableCats', 'filters'],
    preserveState: true,
    replace: true,
    reset: ['transactions', 'availableCats', 'filters'],
    },
    
  );
});

const toggleTag = (value, index) => {
  nonFilter.value = false;

  if (activeCat.value == index) {
    form.category = null;
    activeCat.value = null;
  } else {
    activeCat.value = index;
    form.category = value;
  }
}

const toggleType = (value, index) => {
  nonFilter.value = false;
  form.category = null;
  activeCat.value = null;
  
  if (activeType.value == index) {
    form.type = null;
    activeType.value = null;
  } else {
    activeType.value = index;
    form.type = value;
  }
}

const types = [
  {
    'id': false,
    'title': 'Расходы'
  },
    {
    'id': 1,
    'title': 'Доходы'
  }
]

const removeActive = () => {
  nonFilter.value = true;
  form.category = null;
  form.type = null;
  activeType.value = null;
  activeCat.value = null;
}

</script>
<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="filter_wrapper">
          <div class="item" :class="nonFilter ? 'active' : ''" @click="removeActive()">Все</div>
          <button class="item" :class="activeType == i ? 'active' : ''" v-for="(type, i) in types" @click="toggleType(type.id, i)">{{type.title}}</button>
          <button class="item" :class="activeCat == i ? 'active' : ''" v-for="(cat, i) in $page.props.availableCats" @click="toggleTag(cat.id, i)">{{cat.title}}</button>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
  .filter_wrapper {
    display: flex;
    gap: 10px;
    flex-wrap: no-wrap;
    overflow-x: auto;
    -ms-overflow-style: none;
    scrollbar-width: none; 
    &::-webkit-scrollbar {
      display: none;
    }
    .item.active {
      color: $light-font;
      background: $dark;
    }
    .item {
      border: none;
      font-weight: 400;
      font-size: 16px;
      line-height: 120%;
      color: $dark-font;
      padding: 5px 24px;
      background: $light-grey;
      border-radius: 20px;
    }
  }
</style>