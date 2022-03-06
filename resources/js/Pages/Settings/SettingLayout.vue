<template>
    <app-layout :title="title">
        <!--Header-->
        <template #header>
            <slot name="header"/>
        </template>

        <!--Action Buttons-->
        <template #action-buttons>
            <slot name="action-buttons"/>
        </template>

        <!--Menu-->
        <div class="flex justify-between w-full space-x-4">
            <Menu
                class="max-w-[15rem] h-min"
                :default-selected-keys="['1']"
                :default-open-keys="['sub1']"
                mode="inline"
            >
                <SubMenu key="sub1" title="İş Emri">
                    <MenuItem key="3">
                        <Link :href="route('task-type.index')">
                            İş Emri Türleri
                        </Link>
                    </MenuItem>
                </SubMenu>
            </Menu>

            <!--Content-->
            <div class="flex w-full">
                <slot></slot>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {Link} from "@inertiajs/inertia-vue3";
import {Menu, MenuItem, SubMenu} from "ant-design-vue"

export default {
    name: "SettingLayout",
    components: {
        AppLayout,
        Link,
        Menu,
        MenuItem,
        SubMenu
    },
    props: {
        title: {
            type: String,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
