<script setup>
import Tabs from './Tabs.vue';
import AddForm from './AddForm.vue';
import { inject } from 'vue';

const props = defineProps({
  isModal: Boolean
})

const {closeModal} = inject('modalActions')
</script>
<template>
  <div class="modal-overlay transaction" :class="{ active: props.isModal }" @click="closeModal">
    <div class="modal-scroll">
      <div class="modal__wrapper">
        <div class="modal" @click.stop>
          <div class="modal_hide-line" v-touch:swipe.bottom="closeModal"></div>
          <div class="content">
            <Tabs>
              <template #firstTab>
                <AddForm :isIncome="true" />
              </template>
              <template #secondTab>
                <AddForm :isIncome="false" />
              </template>
            </Tabs>
          </div>
          <!-- START hidden -->
          <div class="close d-none" @click="closeModal">
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
  .modal {
    min-height: 75vh;
  }
</style>