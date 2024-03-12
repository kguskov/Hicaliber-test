<template>
    <div class="common-layout">
        <Header></Header>
        <el-container class="layout-container">
            <el-container>
                <Aside></Aside>
                <el-main>
                    <el-scrollbar>
                        <Table :table-data=tableData></Table>
                    </el-scrollbar>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

import Header from "../Components/Header.vue";
import Aside from "../Components/Aside.vue";
import Table from "../Components/Table.vue";

const tableData = ref([]);

const fetchTableData = async () => {
    try {
        const response = await axios.get('/api/properties');
        tableData.value = response.data.properties;
    } catch (error) {
        console.error("There was an error fetching the properties data:", error);
    }
}
// Fetch data from the API when the component is mounted
onMounted(fetchTableData);

</script>

<style scoped>

.layout-container .el-aside {
    color: var(--el-text-color-primary);
    background: var(--el-color-primary-light-8);
}

.layout-container .el-menu {
    border-right: none;
}

.layout-container .el-main {
    padding: 0;
}
</style>
