<script setup>
  import {ref} from 'vue'

  import GoalsItem from './GoalsItem.vue';
  
  var goals = ref([])
  goals = [
    {
      id: 1,
      name: 'Финансовая подушка',
      percent: 10,
      price: 9000 
    },
    {
      id: 2,
      name: 'Инвестиции',
      percent: 20,
      price: 18000 
    },
    {
      id: 3,
      name: 'Путешествие 🏝️🇱🇰',
      percent: 5,
      price: 4500 
    }
  ]
</script>

<template>

<section class="goals blured">
  <div class="container">
    <div class="row">
      <div class="col-12 section-header__wrapper">
        <h3 class="section_title">Финансовые цели</h3>
        <a href="#" class="section_link">Смотреть все</a>
      </div>
      <div class="col-12">
        <div class="goals__slider">
          
          <GoalsItem v-for="(goal, i) in goals" :goal=goal />

        </div>
      </div>
    </div>
  </div>

</section>

</template>

<style lang="scss">

.goals {
  overflow: hidden;
}

.goals__slider {
  width: 100%;
  display: flex;
  flex-wrap: no-wrap;
  overflow-x: auto;
  gap: 10px;
  -ms-overflow-style: none;
  scrollbar-width: none; 
  &::-webkit-scrollbar {
    display: none;
  }
  .goals__item {
    width: 310px;
    flex: 0 0 auto;
  }
}

</style>