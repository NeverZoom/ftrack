<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    // type: String,
    required: true,
});

const props = defineProps({
  placeholderText: String,
  inputType: String,
  edited: Boolean
})

const input = ref(null);
const focused = ref(false);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }

    if(props.edited == true) focused.value = true
});

const focus = () => {
    input.value.blur();
    focused.value = false
}

defineExpose({ focus });
</script>

<template>
    <div class="input_wrapper" :class="focused ? 'active' : ''">
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
.input_wrapper.active {
    span {
        top: 6px;
        font-size: 12px;
        color: rgba($dark-font, .8);
    }
    input {
      padding-top: 22px;
      padding-bottom: 6px;
    }
}
.input_wrapper {
    position: relative;
    span {
        pointer-events: none;
        font-size: 16px;
        line-height: 100%;
        color: $dark-font;
        position: absolute;
        top: 16px;
        transition: all 0.3s ease;
        left: 16px;
        z-index: 2;
    }
    input {
        width: 100%;
        background: $light-grey;
        border: none;
        border-radius: 12px;
        padding: 14px 16px;
        font-weight: 400;
        font-size: 16px;
        line-height: 120%;
        color: $dark-font;
        margin-bottom: 15px;
        &::placeholder {
            color: $dark-font;
        }
    }
}

input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active{
    -webkit-background-clip: text;
    -webkit-text-fill-color: $dark-font;
}

</style>
