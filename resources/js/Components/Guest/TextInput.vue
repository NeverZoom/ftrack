<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

defineProps({
  placeholderText: String,
  inputType: String
})

const input = ref(null);
const focused = ref(false);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div :class="focused ? 'active' : ''">
        <span v-if="placeholderText">{{ placeholderText }}</span>
        <input
            @focus="focused = true"
            @blur="model ? '' : focused = false"
            v-model="model"
            ref="input"
            :type=inputType
        />
    </div>
</template>

<style scoped lang="scss">
div.active {
    span {
        top: -7px;
        font-size: 14px;
    }
}
div {
    position: relative;
    span {
        pointer-events: none;
        font-size: 16px;
        line-height: 100%;
        color: $light-grey;
        position: absolute;
        top: 18px;
        transition: all 0.3s ease;
        left: 17px;
        background: $dark;
        z-index: 2;
    }
    input {
        width: 100%;
        border: 1px solid $light-grey;
        border-radius: 12px;
        background: none;
        padding: 16px;
        font-weight: 400;
        font-size: 16px;
        line-height: 120%;
        color: $light-grey;
        margin-bottom: 16px;
        &::placeholder {
            color: $light-grey;
        }
    }
}

input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active{
    -webkit-background-clip: text;
    -webkit-text-fill-color: $light-grey;
}

</style>
