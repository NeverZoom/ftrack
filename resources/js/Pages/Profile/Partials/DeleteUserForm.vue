<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/Guest/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/Auth/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section>
        <header>
            <h2>Удалить аккаунт</h2>

            <p>
            После удаления вашей учетной записи все ее ресурсы и данные будут безвозвратно удалены. Перед удалением учетной записи, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Удалить аккаунт</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div>
                <h2>
                    Вы уверены, что хотите удалить свой аккаунт?
                </h2>

                <p>
                После удаления вашей учетной записи все ее ресурсы и данные будут безвозвратно удалены. Пожалуйста, введите свой пароль, чтобы подтвердить, что вы хотите навсегда удалить свою учетную запись.
                </p>

                <div>

                    <TextInput
                        placeholderText="Введите пароль"
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div>
                    <SecondaryButton @click="closeModal">
                        Отмена
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Удалить аккаунт
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
