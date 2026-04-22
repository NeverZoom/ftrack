<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <div :class="props.checked ? 'active' : ''">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="18" height="18" rx="4" fill="#CFCFCF"/>
            <rect class="checker" x="3" y="3" width="12" height="12" rx="4" fill="#252525"/>
        </svg>
        <input
            type="checkbox"
            :value="value"
            v-model="proxyChecked"
        />
    </div>
</template>

<style scoped lang="scss">
div.active {
    svg {
        transform: rotate(180deg);
        .checker {
            opacity: 1;
        }
    }
}
div {
    display: flex;
    align-items: center;
    input {
        display: none;
    }
    svg {
        transition: all 0.3s ease;
        .checker {
            opacity: 0;
            transition: all 0.3s ease;
        }
    }
}


</style>