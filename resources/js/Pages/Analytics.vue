<script setup>
import AuthenticatedLayout from '@/Layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Аналитика" />
    <AuthenticatedLayout>
        <template #header>
            <div class="container">
                  <div class="row">
                      <div class="col-12">
                          <div class="page-header">
                              <h2>Аналитика</h2>
                          </div>
                      </div>
                  </div>
              </div>
        </template>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>Analytics be here</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>