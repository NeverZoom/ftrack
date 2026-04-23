<script setup>
import CalendarTrigger from '@/Components/Auth/CalendarTrigger.vue';
import DashboardHeader from '@/Components/Auth/Dashboard/DashboardHeader.vue';
import GoalsSlider from '@/Components/Auth/Goal/GoalsSlider.vue';
import TransactionList from '@/Components/Auth/Transaction/TransactionList.vue';
import AuthenticatedLayout from '@/Layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Панель управления" />

    <AuthenticatedLayout>

        <DashboardHeader />
        <CalendarTrigger/>
        <!-- <GoalsSlider/> -->
        <TransactionList :transactions="$page.props.transactions" />

    </AuthenticatedLayout>
</template>
