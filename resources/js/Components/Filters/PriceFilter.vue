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
import {ref, watch, defineProps, defineEmits, computed, onMounted} from "vue";
// Define props and emits
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
    console.log('Emitting price change:', { price: value });
    emit('updateFilter', { price: value });
};
</script>
<style scoped>

</style>
