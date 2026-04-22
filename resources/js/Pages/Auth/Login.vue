<script setup>
import Checkbox from '@/Components/Guest/Checkbox.vue';

import InputError from '@/Components/Guest/InputError.vue';
import PrimaryButton from '@/Components/Guest/PrimaryButton.vue';
import TextInput from '@/Components/Guest/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthPageLayout from '@/Layouts/AuthPageLayout.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthPageLayout>
        <Head title="Log in" />
        
        <div v-if="status" class="mb-4">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <h1 class="login_title">Войти</h1>
            <p class="login_subtitle">Введите ваши данные</p>

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
            <div>
                <TextInput
                    id="password"
                    inputType="password"
                    placeholderText="Пароль"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mb-4">
                <label class="d-flex align-items-center justify-content-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span>Запомнить меня</span>
                </label>
            </div>

            <div class="d-flex flex-column align-items-center mt-2">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Войти
                </PrimaryButton>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="auth_links"
                >
                     Забыли пароль?
                </Link>
            </div>
        </form>
    </AuthPageLayout>
</template>

<style scoped lang="scss">
form {
    width: 100%;
}

label {
    gap: 8px;
    span {
        color: $grey;
    }
}

</style>