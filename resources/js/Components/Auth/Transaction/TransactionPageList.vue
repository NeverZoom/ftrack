<script setup>
  import {ref} from 'vue'
  import TransactionCard from './TransactionCard.vue';
  import TransactionModal from './TransactionModal.vue';
  import { InfiniteScroll, router } from '@inertiajs/vue3';
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

  const renderDateName = (date) => {
    const monthNames = [
      "января", 
      "февраля", 
      "марта", 
      "апреля", 
      "мая", 
      "июня",
      "июля", 
      "августа", 
      "сентября", 
      "октября", 
      "ноября", 
      "декабря"
    ];
    var currenYear = new Date().getFullYear();
    var currenMounth = new Date().getMonth();
    var currenDay = new Date().getDate();
    var yesterday = new Date().getDate() - 1;

    var year = new Date(date).getFullYear();
    var mounth = new Date(date).getMonth();
    var day = new Date(date).getDate();


    if(currenDay == day && mounth == currenMounth && year == currenYear) {
      day = 'Сегодня';
    } else if(day == yesterday && mounth == currenMounth && year == currenYear) {
      day = 'Вчера';
    }

    if (year == currenYear) {
      year = '';
    }

    if (day == 'Сегодня' || day == 'Вчера') {
      mounth = '';
    } else {
      mounth = monthNames[mounth];
    }

    return day+' '+mounth+' '+year;
  }

  const checkDate = (date, prevDate) => {
    var curentDate = renderDateName(date);
    if (prevDate) {      
      var prevDate = renderDateName(prevDate.publish_date);
      if (curentDate == prevDate) {
        return '';
      }
    }
    return curentDate;
  }
  
</script>

<template>
<section class="transactions blured">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div v-if="transactions.length !== 0">
          <InfiniteScroll data="transactions" class="transactions-page-list">
            <template v-for="(item, i) in transactions.data">
              <h3 class="section_title" v-if="checkDate(item.publish_date, transactions.data[i - 1])">{{ checkDate(item.publish_date, transactions.data[i - 1]) }}</h3>
              <TransactionCard :destroy="destroy" :hideAll="hideAll" :item=item :openModal :openEditModal />
            </template>
          </InfiniteScroll>
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
.transactions-page-list {
  display: flex;
  gap: 10px;
  flex-direction: column;
  h3.section_title {
    color: rgba(34, 33, 47, 0.8);
    margin: 0;
  }
}

.transactions {
  overflow: hidden;
  padding-bottom: 20px;
}

</style>