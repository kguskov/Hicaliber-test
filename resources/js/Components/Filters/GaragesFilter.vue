<!-- GaragesFilter.vue -->
<template>
    <el-radio-group v-model="selectedGarages" @change="handleGaragesChange">
        <el-radio v-for="n in availableGarages" :value="n">{{ n }} Garages</el-radio>
    </el-radio-group>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const { availableGarages } = defineProps({
    availableGarages: Array,
});

const selectedGarages = ref(null);
const emit = defineEmits(['updateFilter']);

const handleGaragesChange = (value) => {
    emit('updateFilter', { garages: value });
};
</script>
