<template>
    <app-layout title="İş Emirleri">
        <template #header>
            İş Emirleri
        </template>

        <!--Add New Customer-->
        <template #action-buttons>
            selam
        </template>
        <Table :dataSource="tasks" :columns="columns" />
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Table } from "ant-design-vue"

export default ({
    name: 'TaskIndex',
    components: {
        AppLayout,
        Table
    },
    props: {
        customers: {
            type: Object,
            default: () => {
                return {}
            }
        }
    },
    setup() {
        const columns = [
            {
                title: 'İş Emri ID',
                dataIndex: 'code',
                key: 'code',
            }
        ]

        return { columns }
    }
})
</script>
