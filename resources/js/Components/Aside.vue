<template>
    <el-aside width="200px">
        <el-scrollbar>
            <el-menu :default-openeds="['0', '1', '2', '3', '4']">
                <!-- Reset Filter -->
                <div class="flex justify-center mt-4 mb-4 pt-4">
                    <el-button class="el-button--danger" :icon="Close" @click="emitResetEvent" v-show="filtersChanged">Reset filters</el-button> <!-- Use v-show here -->
                </div>
                <!-- Name Filter -->
                <el-sub-menu index="0">
                    <template #title>
                        <el-icon>
                            <Files></Files>
                        </el-icon>
                        Name
                    </template>
                    <div class="p-4 mb-2 flex items-center text-sm">
                        <NameFilter :availableNames="availableNames" @updateFilter="handleFilterChange"/>
                    </div>
                </el-sub-menu>
                <!-- Price Filter -->
                <el-sub-menu index="1">
                    <template #title>
                        <el-icon>
                            <Money></Money>
                        </el-icon>
                        Price
                    </template>
                    <div class="p-4 mb-2 flex items-center text-sm">
                        <PriceFilter :availablePrices="availablePrices" @updateFilter="handleFilterChange"/>
                    </div>
                </el-sub-menu>
                <!-- Bedrooms Filter -->
                <el-sub-menu index="2">
                    <template #title>
                        <el-icon>
                            <ReadingLamp></ReadingLamp>
                        </el-icon>
                        Bedrooms
                    </template>
                    <div class="p-4 mb-2 flex items-center text-sm w-0.5">
                        <BedroomsFilter :availableBedrooms="availableBedrooms" @updateFilter="handleFilterChange"/>
                    </div>
                </el-sub-menu>
                <!-- Bathrooms Filter -->
                <el-sub-menu index="3">
                    <template #title>
                        <el-icon>
                            <ToiletPaper></ToiletPaper>
                        </el-icon>
                        Bathrooms
                    </template>
                    <div class="p-4 mb-2 flex items-center text-sm w-0.5">
                        <BathroomsFilter :availableBathrooms="availableBathrooms" @updateFilter="handleFilterChange"/>
                    </div>
                </el-sub-menu>
                <!-- Storeys Filter -->
                <el-sub-menu index="4">
                    <template #title>
                        <el-icon>
                            <House></House>
                        </el-icon>
                        Storeys
                    </template>
                    <div class="p-4 mb-2 flex items-center text-sm w-0.5">
                        <StoreysFilter :availableStoreys="availableStoreys" @updateFilter="handleFilterChange"/>
                    </div>
                </el-sub-menu>
                <!-- Garages Filter -->
                <el-sub-menu index="5">
                    <template #title>
                        <el-icon>
                            <Van></Van>
                        </el-icon>
                        Garages
                    </template>
                    <div class="p-4 mb-2 flex items-center text-sm w-0.5">
                        <GaragesFilter :availableGarages="availableGarages" @updateFilter="handleFilterChange"/>
                    </div>
                </el-sub-menu>
            </el-menu>
        </el-scrollbar>
    </el-aside>
</template>

<script setup>
import {ref, defineEmits} from 'vue';
import BedroomsFilter from "./Filters/BedroomsFilter.vue";
import BathroomsFilter from "./Filters/BathroomsFilter.vue";
import StoreysFilter from "./Filters/StoreysFilter.vue";
import GaragesFilter from "./Filters/GaragesFilter.vue";
import {Close, House, Van, ToiletPaper, ReadingLamp, Files, Money} from "@element-plus/icons-vue";
import PriceFilter from "./Filters/PriceFilter.vue";
import NameFilter from "./Filters/NameFilter.vue";

const props = defineProps({
    availableNames: Array,
});

const availableBedrooms = ref([3, 4, 5]);
const availableBathrooms = ref([2, 3]);
const availableStoreys = ref([1, 2]);
const availableGarages = ref([1, 2]);
const availablePrices = ref([263604, 572002]);

const emit = defineEmits(['updateFilters', 'resetFilters']);

const handleFilterChange = (filters) => {
    emit('updateFilters', filters);
    filtersChanged.value = true;
};
const filtersChanged = ref(false);
const emitResetEvent = () => {
    emit('resetFilters');
    filtersChanged.value = false;
};
</script>
<style scoped>

</style>
