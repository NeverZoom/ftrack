<script setup>
import InputError from '@/Components/Guest/InputError.vue';
import PrimaryButton from '@/Components/Auth/PrimaryButton.vue';
import TextInput from '@/Components/Auth/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>

        <form @submit.prevent="updatePassword">
            <div>

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    placeholderText="Введите текущий пароль"
                    v-model="form.current_password"
                    type="password"
                    autocomplete="current-password"
                />

                <InputError :message="form.errors.current_password" />
            </div>

            <div>

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    placeholderText="Введите новый пароль"
                    type="password"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" />
            </div>

            <div>

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    placeholderText="Повторите новый пароль"
                    type="password"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div>
                <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful">
                        Сохранено!
                    </p>
                </Transition>
            </div>
        </form>
</template>
