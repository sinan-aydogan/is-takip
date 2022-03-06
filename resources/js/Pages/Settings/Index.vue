<template>
    <setting-layout title="Ayarlar">
        <Alert
            message="Ayarlar için lütfen sol taraftan seçim yapınız."
            class="w-full h-min border"
            banner
            type="info"
        />
    </setting-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {Alert} from "ant-design-vue"
import SettingLayout from "@/Pages/Settings/SettingLayout";

export default {
    name: "Index",
    components: {
        SettingLayout,
        AppLayout,
        Alert
    }
}
</script>

<style scoped>

</style>
