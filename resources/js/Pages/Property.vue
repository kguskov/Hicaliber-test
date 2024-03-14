<!-- Property.vue -->
<template>
    <div class="common-layout">
        <Header></Header>
        <el-container class="layout-container">
            <el-container>
                <Aside
                    :availableNames="availableNames"
                    :availablePrices="availablePrices"
                    @updateFilters="updateFilters"
                    @resetFilters="resetFilters">
                </Aside>
                <el-main>
                    <el-scrollbar>
                        <Table v-loading="isLoading" :table-data="tableData"></Table>
                    </el-scrollbar>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>

<script setup>
import {onMounted, ref, provide} from 'vue';
import axios from 'axios';
import Header from "../Components/Header.vue";
import Aside from "../Components/Aside.vue";
import Table from "../Components/Table.vue";

const needReset = ref(false);
const resetFilters = () => {
    filterStates.value = {...filterStates};
    needReset.value = !needReset.value;
    fetchTableData(); // Fetch table data without filters
};

provide('needReset', needReset);

const isLoading = ref(false);
const tableData = ref([]);
const availableNames = ref([]);
const availablePrices = ref([0, 1]);

const filterStates = ref({
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null,
    price: null,
    name: null,
});

const fetchTableData = async () => {
    let url = '/api/properties';
    const params = new URLSearchParams(Object.entries(filterStates.value).filter(([, value]) => value != null));

    try {
        isLoading.value = true; // Start loading
        await delay(200); // For demo purpose only: showing the loading indicator
        const response = await axios.get(`${url}?${params.toString()}`);
        tableData.value = response.data.properties;

        availableNames.value = response.data.properties.map(property => property.name);

        if (response.data.properties.length > 0) {
            const prices = response.data.properties.map(property => property.price);
            const minPrice = Math.min(...prices);
            const maxPrice = Math.max(...prices);
            availablePrices.value = [minPrice, maxPrice];
        }
    } catch (error) {
        console.error("There was an error fetching the properties data:", error);
    } finally {
        isLoading.value = false;
    }
};
const updateFilters = (newFilters) => {
    if (newFilters.price) {
        filterStates.value.min_price = newFilters.price[0];
        filterStates.value.max_price = newFilters.price[1];
    } else {
        filterStates.value = {...filterStates.value, ...newFilters};
    }
    fetchTableData();
};

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

onMounted(fetchTableData);
</script>
