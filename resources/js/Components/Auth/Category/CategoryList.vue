<script setup>
import {ref} from 'vue'
import CategoryCard from './CategoryCard.vue';
import { router } from '@inertiajs/vue3';
import CategoryEdit from './CategoryEdit.vue';

  const props = defineProps({
    categories: Object, 
  })

  let isEditModal = ref(false)
  let currentModalItem = ref()

  const openEditModal = (item) => {
    isEditModal.value = true;
    currentModalItem.value = item;
    document.body.classList.add('modalOpened');
    document.querySelectorAll('.blured').forEach((elem) => {
      elem.classList.add('modalOpened')
    })
  }

  const closeModal = () => {
    isEditModal.value = false;
    document.body.classList.remove('modalOpened');
    document.querySelectorAll('.blured').forEach((elem) => {
      elem.classList.remove('modalOpened')
    })
  }

  function hideAll() {
    var listelems = document.querySelectorAll('.transaction-list__card');
    listelems.forEach(element => {
      element.classList.remove('swipeRight');
      element.classList.remove('swipeLeft');
    });
  }

  const destroy = (id) => {
    router.delete(route('category.destroy', id), {preserveScroll: true})
    hideAll()
  };

</script>
<template>
  <div class="transactions-list" v-if="props.categories.length !== 0">
    <CategoryCard :destroy="destroy" :hideAll="hideAll" v-for="(item, i) in props.categories" :item=item :openEditModal />
  </div>
  <div v-else>
    <p class="empty_list">Нет категорий!</p>
  </div>

  <CategoryEdit :isEditModal=isEditModal :item=currentModalItem :closeModal />
</template>
<style lang="scss" scoped>
.transactions-list {
  display: flex;
  gap: 10px;
  flex-direction: column;
}
</style>