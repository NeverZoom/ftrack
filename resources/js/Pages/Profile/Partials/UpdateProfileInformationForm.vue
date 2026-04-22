<script setup>
import InputError from '@/Components/Guest/InputError.vue';
import PrimaryButton from '@/Components/Auth/PrimaryButton.vue';
import TextInput from '@/Components/Auth/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <form @submit.prevent="form.patch(route('profile.update'))" >
            <div>
                <TextInput
                    id="name"
                    :edited=true
                    placeholderText="Имя"
                    type="text"
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
                    :edited=true
                    placeholderText="Email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p>
                    Ваш адрес электронной почты не подтвержден.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                    >
                        Нажмите здесь, чтобы повторно отправить письмо с подтверждением.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                >
                    На ваш электронный адрес отправлена ​​новая ссылка для подтверждения.
                </div>
            </div>

            <div class="flex items-center gap-4">
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
    </section>
</template>
