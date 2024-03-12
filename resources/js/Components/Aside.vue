<template>
    <el-aside width="200px">
        <el-scrollbar>
            <el-menu :default-openeds="['1', '3']">
                <el-sub-menu index="1">
                    <template #title>
                        <el-icon>
                            <svg class="h-8 w-8 text-gray-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />  <circle cx="7" cy="10" r="1" /></svg>
                        </el-icon>
                        Bedrooms
                    </template>
                    <div class="p-4 mb-2 flex items-center text-sm w-0.5">
                        <el-radio-group class="pl-4 ml-4">
                            <el-radio :value="3">3 Bedrooms</el-radio>
                            <el-radio :value="4">4 Bedrooms</el-radio>
                            <el-radio :value="5">5 Bedrooms</el-radio>
                        </el-radio-group>
                    </div>
                </el-sub-menu>
                <el-sub-menu index="2">
                    <template #title>
                        <el-icon>
                            <message/>
                        </el-icon>
                        Navigator Two
                    </template>
                    <el-menu-item-group>
                        <template #title>Group 1</template>
                        <el-menu-item index="2-1">Option 1</el-menu-item>
                        <el-menu-item index="2-2">Option 2</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="Group 2">
                        <el-menu-item index="2-3">Option 3</el-menu-item>
                    </el-menu-item-group>
                    <el-sub-menu index="2-4">
                        <template #title>Option 4</template>
                        <el-menu-item index="2-4-1">Option 4-1</el-menu-item>
                    </el-sub-menu>
                </el-sub-menu>
                <el-sub-menu index="3">
                    <template #title>
                        <el-icon>
                            <setting/>
                        </el-icon>
                        Navigator Three
                    </template>
                    <el-menu-item-group>
                        <template #title>Group 1</template>
                        <el-menu-item index="3-1">Option 1</el-menu-item>
                        <el-menu-item index="3-2">Option 2</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="Group 2">
                        <el-menu-item index="3-3">Option 3</el-menu-item>
                    </el-menu-item-group>
                    <el-sub-menu index="3-4">
                        <template #title>Option 4</template>
                        <el-menu-item index="3-4-1">Option 4-1</el-menu-item>
                    </el-sub-menu>
                </el-sub-menu>
            </el-menu>
        </el-scrollbar>
    </el-aside>
</template>
<script>
import {Message, Setting} from "@element-plus/icons-vue";

export default {
    name: "Aside",
    components: {Message, Setting}
}
</script>
<style scoped>

</style>
