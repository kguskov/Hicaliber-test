<template>
    <el-header style="text-align: right; font-size: 12px">
        <div class="toolbar">
            <el-dropdown>
                <el-icon style="margin-right: 8px; margin-top: 1px"><setting /></el-icon>
                <template #dropdown>
                    <el-dropdown-menu>
                        <el-dropdown-item>View</el-dropdown-item>
                        <el-dropdown-item>Add</el-dropdown-item>
                        <el-dropdown-item>Delete</el-dropdown-item>
                    </el-dropdown-menu>
                </template>
            </el-dropdown>
            <span>User</span>
        </div>
    </el-header>
</template>

<script setup lang="ts">
import { Setting } from '@element-plus/icons-vue'
</script>

<style scoped>
.el-header {
    position: relative;
    background-color: var(--el-color-primary-light-7);
    color: var(--el-text-color-primary);
}
.toolbar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    right: 20px;
}
</style>
