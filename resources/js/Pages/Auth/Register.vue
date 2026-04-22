<script setup>
import AuthPageLayout from '@/Layouts/AuthPageLayout.vue';
import InputError from '@/Components/Guest/InputError.vue';
import PrimaryButton from '@/Components/Guest/PrimaryButton.vue';
import TextInput from '@/Components/Guest/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthPageLayout>
        <Head title="Register" />
        
        <form @submit.prevent="submit">
            <h1 class="login_title">Зарегистрироваться</h1>
            <p class="login_subtitle">Введите ваши данные</p>
            <div>
                <TextInput
                    id="name"
                    inputType="text"
                    placeholderText="Ваше имя"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <TextInput
                    id="email"
                    inputType="email"
                    placeholderText="Email"
                    v-model="form.email"
                    required
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
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div>
                <TextInput
                    id="password_confirmation"
                    inputType="password"
                    placeholderText="Подтвердите пароль"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="d-flex flex-column align-items-center mt-2">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Зарегистрироваться
                </PrimaryButton>

                <Link
                    :href="route('login')"
                    class="auth_links"
                >
                    войти
                </Link>
            </div>
        </form>
    </AuthPageLayout>
</template>

<style scoped lang="scss">
form {
    width: 100%;
}
</style>