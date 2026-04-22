<script setup>
import InputError from '@/Components/Guest/InputError.vue';
import PrimaryButton from '@/Components/Guest/PrimaryButton.vue';
import TextInput from '@/Components/Guest/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthPageLayout from '@/Layouts/AuthPageLayout.vue';


const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthPageLayout>
        <Head title="Confirm Password" />
        <div class="wrapper">

        <p class="login_subtitle">
            Это защищенная область приложения. Пожалуйста, подтвердите свой<br>пароль, прежде чем продолжить.
        </p>

        <form @submit.prevent="submit">
            <div>
                <TextInput
                    id="password"
                    inputType="password"
                    placeholderText="Пароль"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirm
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