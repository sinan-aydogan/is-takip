<template>
    <app-layout title="Müşteriler">
        <Table :dataSource="customers" :columns="columns" />
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Table } from "ant-design-vue"

export default ({
    name: 'CustomerIndex',
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
                title: 'Müşteri',
                dataIndex: 'name',
                key: 'name',
            },
            {
                title: 'Email',
                dataIndex: 'email',
                key: 'email',
            },
            {
                title: 'Telefon',
                dataIndex: 'phone',
                key: 'phone',
            },
        ]

        return { columns }
    }
})
</script>
