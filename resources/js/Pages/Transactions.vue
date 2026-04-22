<script setup>
import TransactionPageList from '@/Components/Auth/Transaction/TransactionPageList.vue';
import TransactionsFilter from '@/Components/Auth/Transaction/TransactionsFilter.vue';
import AuthenticatedLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Все операции" />
    <AuthenticatedLayout>
      <template #header>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="page-header">
                <Link :href="route('home')" >
                  <div class="back-btn">
                    <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M8.33213 0.060606C8.62903 0.21687 8.74154 0.604405 8.58528 0.920059C8.56028 0.970064 6.96326 2.58584 5.03496 4.50476L1.52839 7.99883L5.03496 11.4898C6.96326 13.4118 8.56028 15.0276 8.58528 15.0776C8.74467 15.3995 8.62591 15.7839 8.32588 15.9371C8.16962 16.0183 7.87897 16.0214 7.74145 15.9433C7.58206 15.8589 0.143886 8.44887 0.0688782 8.29886C0.0219994 8.21447 0.00012207 8.11446 0.00012207 7.99883C0.00012207 7.88319 0.0219994 7.78318 0.0688782 7.6988C0.147011 7.54879 7.58519 0.138739 7.74145 0.0543556C7.88209 -0.0206509 8.18212 -0.0175266 8.33213 0.060606Z" fill="#252525"/>
                    </svg>
                  </div>
                </Link>
                <h2>Все операции</h2>
              </div>
            </div>
          </div>
        </div>
      </template>    
      <TransactionsFilter />
      <TransactionPageList :transactions="$page.props.transactions" />
    </AuthenticatedLayout>
</template>