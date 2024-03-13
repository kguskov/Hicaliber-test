<template>
    <el-scrollbar>
        <el-table :data="tableData">
            <el-table-column prop="name" label="Name"/>
            <el-table-column prop="price" label="Price"/>
            <el-table-column prop="bedrooms" label="Bedrooms"/>
            <el-table-column prop="bathrooms" label="Bathrooms"/>
            <el-table-column prop="storeys" label="Storeys"/>
            <el-table-column prop="garages" label="Garages"/>
        </el-table>
    </el-scrollbar>
</template>
<script>
import {defineComponent} from 'vue';

export default defineComponent({
    name: "Table",
    props: {
        tableData: {
            type: Array,
            required: true
        }
    }
})
</script>

<style scoped>

</style>
