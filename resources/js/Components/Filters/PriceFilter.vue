<template>
    <el-slider
        v-model="range"
        range
        :min="minPrice"
        :max="maxPrice"
        @change="handlePriceChange"
    />
</template>
<script setup>
import {ref, defineProps, defineEmits, computed, inject, watch} from "vue";

const needReset = inject('needReset');
const props = defineProps({
    availablePrices: {
        type: Array,
        default: () => [0, 1000] // Default range
    }
});
const emit = defineEmits(["updateFilter"]);

// Assuming availablePrices contains the min and max price in its first and second elements
const minPrice = computed(() => props.availablePrices[0]);
const maxPrice = computed(() => props.availablePrices[1]);

const range = ref([...props.availablePrices]);
const handlePriceChange = (value) => {
    emit('updateFilter', {price: value});
};
watch(needReset, () => {
    range.value = props.availablePrices; // Reset the value whenever needReset changes
});
</script>
<style scoped>

</style>
