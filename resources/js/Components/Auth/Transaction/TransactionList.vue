<script setup>
  import {ref} from 'vue'
  import TransactionCard from './TransactionCard.vue';
  import TransactionModal from './TransactionModal.vue';
  import { Link, router } from '@inertiajs/vue3';
  import TransactionEdit from './TransactionEdit.vue';

  defineProps({
    transactions: Object, 
  })

  let isModal = ref(false)
  let isEditModal = ref(false)
  let currentModalItem = ref()

  const openModal = (item) => {
    isModal.value = true;
    currentModalItem.value = item;
    document.body.classList.add('modalOpened');
    document.querySelectorAll('.blured').forEach((elem) => {
      elem.classList.add('modalOpened')
    })
  }

  const openEditModal = (item) => {
    isEditModal.value = true;
    currentModalItem.value = item;
    document.body.classList.add('modalOpened');
    document.querySelectorAll('.blured').forEach((elem) => {
      elem.classList.add('modalOpened')
    })
  }

  const closeModal = () => {
    isModal.value = false;
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
    router.delete(route('transaction.destroy', id), {preserveScroll: true})
    hideAll()
  };
  
</script>

<template>

<section class="transactions blured">
  <div class="container">
    <div class="row">
      <div class="col-12 section-header__wrapper">
        <h3 class="section_title">Последние операции</h3>
        <Link :href="route('transactions')" class="section_link">Смотреть все</Link>
      </div>
      <div class="col-12">
        <div class="transactions-list" v-if="transactions.length !== 0">
          
          <TransactionCard :destroy="destroy" :hideAll="hideAll" v-for="(item, i) in transactions" :item=item :openModal :openEditModal />

        </div>
        <div v-else>
          <p class="empty_list">Нет операций!</p>
        </div>
      </div>
    </div>
  </div>
</section>

<TransactionModal :destroy="destroy" :openEditModal :isModal=isModal :item=currentModalItem :closeModal />
<TransactionEdit :isEditModal=isEditModal :item=currentModalItem :closeModal />
</template>

<style lang="scss">
.transactions {
  overflow: hidden;
  padding-bottom: 20px;
}
.transactions-list {
  display: flex;
  gap: 10px;
  flex-direction: column;
}

</style>