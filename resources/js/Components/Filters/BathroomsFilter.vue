<!-- BathroomsFilter.vue -->
<template>
    <el-radio-group v-model="selectedBathrooms" @change="handleBathroomsChange">
        <el-radio v-for="n in availableBathrooms" :value="n">{{ n }} Bathrooms</el-radio>
    </el-radio-group>
</template>

<script setup>
import {ref, defineProps, defineEmits, inject, watch} from 'vue';

const needReset = inject('needReset');

const {availableBathrooms} = defineProps({
    availableBathrooms: Array,
});

const selectedBathrooms = ref(null);
const emit = defineEmits(['updateFilter']);

const handleBathroomsChange = (value) => {
    emit('updateFilter', {bathrooms: value});
};

watch(needReset, (newVal) => {
    selectedBathrooms.value = null;
});
</script>
