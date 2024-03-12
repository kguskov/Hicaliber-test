<template>
    <el-config-provider :size="size" :z-index="zIndex">
        <Property></Property>
    </el-config-provider>
</template>

<script>
import { defineComponent } from 'vue'
import { ElConfigProvider } from 'element-plus'
import Property from "./Pages/Property.vue";

export default defineComponent({
    components: {
        Property,
        ElConfigProvider,
    },
    setup() {
        return {
            zIndex: 3000,
            size: 'small',
        }
    },
})
</script>
