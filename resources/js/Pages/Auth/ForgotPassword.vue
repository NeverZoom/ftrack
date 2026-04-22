<script setup>
import InputError from '@/Components/Guest/InputError.vue';
import PrimaryButton from '@/Components/Guest/PrimaryButton.vue';
import TextInput from '@/Components/Guest/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthPageLayout from '@/Layouts/AuthPageLayout.vue';


defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AuthPageLayout>
        <Head title="Forgot Password" />
        <div class="wrapper">
        <h1 class="login_title">Забыли пароль?</h1>
        <p class="login_subtitle">Просто напишите свой адрес электронной почты,<br> и мы вышлем вам ссылку для сброса пароля,<br> которая позволит вам выбрать новый.</p>

        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>

                <TextInput
                    id="email"
                    inputType="email"
                    placeholderText="Email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                   Восстановить пароль
                </PrimaryButton>
            </div>
        </form>
        </div>
    </AuthPageLayout>
</template>
<style scoped lang="scss">
.wrapper, form {
  width: 100%;
}
</style>