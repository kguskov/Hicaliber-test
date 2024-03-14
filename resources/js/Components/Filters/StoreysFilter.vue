<!-- StoreysFilter.vue -->
<template>
    <el-radio-group v-model="selectedStoreys" @change="handleStoreysChange">
        <el-radio v-for="n in availableStoreys" :value="n">{{ n }} Storeys</el-radio>
    </el-radio-group>
</template>

<script setup>
import {ref, defineProps, defineEmits, inject, watch} from 'vue';

const needReset = inject('needReset');

const {availableStoreys} = defineProps({
    availableStoreys: Array,
});

const selectedStoreys = ref(null);
const emit = defineEmits(['updateFilter']);

const handleStoreysChange = (value) => {
    emit('updateFilter', {storeys: value});
};

watch(needReset, (newVal) => {
    selectedStoreys.value = null;
});
</script>
