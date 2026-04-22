<script setup>
import { ref } from 'vue';

const model = defineModel({
    type: Number
});

const props = defineProps({
  categories: Object,
  modelValue: Number,
  curentCategory: String
})

const emit = defineEmits(["update:modelValue"])

let list = ref(false)
let activeItem = ref('')

function changeSelect(item) {
  activeItem = item.title; 
  emit("update:modelValue", item.id)
}

</script>
<template>
  <div class="select_wrapper" v-if="categories.length !== 0">
    <div class="name">
      <slot name="icon" />
      <span><slot name="title" /></span>
    </div>

    <div class="list_trigger" @click="list = !list">
      <span v-if="activeItem == ''"> <template v-if="props.curentCategory">{{ props.curentCategory }}</template><template v-else>Выбрать</template></span>
      <span v-else>{{ activeItem }}</span>
      <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.243089 0.0454549C0.0204123 0.162653 -0.0639704 0.453305 0.0532277 0.690045C0.0719794 0.727548 1.26974 1.93938 2.71597 3.37857L5.3459 5.99912L2.71597 8.61733C1.26974 10.0589 0.0719794 11.2707 0.0532277 11.3082C-0.0663144 11.5496 0.0227562 11.8379 0.247777 11.9528C0.364975 12.0137 0.582964 12.0161 0.686098 11.9575C0.80564 11.8942 6.38427 6.33665 6.44053 6.22414C6.47569 6.16086 6.4921 6.08585 6.4921 5.99912C6.4921 5.9124 6.47569 5.83739 6.44053 5.7741C6.38193 5.66159 0.803296 0.104054 0.686098 0.040767C0.58062 -0.0154881 0.355599 -0.0131442 0.243089 0.0454549Z" fill="#252525"/>
      </svg>

      <div class="list_wrapper" :class="list ? 'active' : ''">
        <ul>
          <li @click="changeSelect(item)" v-for="(item, i) in categories">{{ item.title }}</li>
          <li @click="changeSelect({id: null, title: 'Без категории'})">Без категории</li>
        </ul>
      </div>
    </div>
    
    <select v-model="model">
      <template v-for="(item, i) in categories">
        <option :value="item.id">{{ item.title }}</option>
      </template>
    </select>
  </div>
</template>
<style scoped lang="scss">

.select_wrapper {
  @include flex-between;
  position: relative;
  select {
    display: none;
  }
  .name {
    display: flex;
    align-items: center;
    gap: 7px;
    font-weight: 500;
    font-size: 16px;
    line-height: 120%;
    color: $dark-font;
    svg {
      width: 14px;
      height: auto;
    }
  }
  .list_trigger {
    display: flex;
    gap: 11px;
    align-items: center;
    font-weight: 400;
    font-size: 16px;
    line-height: 120%;
    color: $dark-font;
    padding: 9px 16px;
    border-radius: 12px;
    background: $light-grey;
    transition: all 0.3s ease;
    .list_wrapper.active {
      opacity: 1;
      pointer-events: all;
    }
    .list_wrapper {
      transition: all 0.3s ease;
      opacity: 0;
      pointer-events: none;
      position: absolute;
      right: 0;
      left: 0;
      top: 42px;
      background: $light-grey;
      border: 1px solid $grey;
      border-radius: 12px;
      max-height: 135px;
      padding: 16px;
      z-index: 3;
      overflow-y: scroll;
      ul {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 16px;
        li {
          font-weight: 400;
          font-size: 16px;
          line-height: 120%;
          color: $dark-font;
        }
      }
    }
  }
}

</style>