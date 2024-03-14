<template>
    <div>
        <el-autocomplete
            v-model="name"
            :fetch-suggestions="querySearch"
            :trigger-on-focus="false"
            placeholder="Type to search names"
            @select="handleSelect"
            clearable
            @clear="handleClear"
        ></el-autocomplete>
    </div>
</template>

<script setup>
import {inject, ref, watch} from 'vue';
import {defineEmits} from 'vue';

const needReset = inject('needReset');
// Emits an event to update filters in the parent component
const emit = defineEmits(['updateFilter']);

const name = ref('');

const props = defineProps({
    availableNames: Array
});

// Modify the querySearch method to use availableNames for suggestions
const querySearch = (queryString, cb) => {
    const results = queryString
        ? props.availableNames
            .filter(name => name.toLowerCase().includes(queryString.toLowerCase()))
            .map(name => ({value: name})) // Ensure the result is in the expected format
        : props.availableNames.map(name => ({value: name}));
    cb(results);
};

const handleSelect = (item) => {
    // When a name is selected, emit an event to update the filter state in the parent component
    emit('updateFilter', {name: item.value});
};

const handleClear = () => {
    // Reset the name value to clear the filter
    name.value = '';
    // Emit an update to the parent component, indicating the name filter has been cleared
    emit('updateFilter', {name: ''});
};

watch(needReset, () => {
    name.value = '';
});
</script>

<style scoped>

</style>
