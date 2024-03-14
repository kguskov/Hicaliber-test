<!-- BedroomsFilter.vue -->
<template>
    <el-radio-group v-model="selectedBedrooms" @change="handleBedroomsChange">
        <el-radio v-for="n in availableBedrooms" :value="n">{{ n }} Bedrooms</el-radio>
    </el-radio-group>
</template>

<script setup>
import {ref, defineProps, defineEmits, inject, watch} from 'vue';

const needReset = inject('needReset');
const {availableBedrooms} = defineProps({
    availableBedrooms: Array,
});

const selectedBedrooms = ref(null);
const emit = defineEmits(['updateFilter']);

const handleBedroomsChange = (value) => {
    emit('updateFilter', {bedrooms: value});
};
watch(needReset, (newVal) => {
    selectedBedrooms.value = null;
});
</script>
