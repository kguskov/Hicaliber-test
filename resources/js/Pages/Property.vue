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

<script lang="ts" setup>
import {ref} from 'vue'

import Header from "../Components/Header.vue";
import Aside from "../Components/Aside.vue";
import Table from "../Components/Table.vue";

const item = {

    name: 'The Victoria',
    price: '374662',
    bedrooms: '4',
    bathrooms: '2',
    storeys: '2',
    garages: '2',
}
const tableData = ref(Array.from({length: 10}).fill(item))
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
