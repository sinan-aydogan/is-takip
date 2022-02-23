<template>
    <app-layout title="İş Emri Oluşturma">
        <Form
            :model="form"
            name="basic"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            @finish="form.task_type_id"
            @finishFailed="form.task_type_id"
        >
            <!-- Task Type ID -->
            <FormItem
                label="Username"
                name="username"
                :rules="[{ required: true, message: 'Please input your username!' }]"
            >
                <Input v-model:value="form.name" />
            </FormItem>

            <FormItem :wrapper-col="{ offset: 8, span: 16 }">
                <Button type="primary" html-type="submit">Submit</Button>
            </FormItem>
        </Form>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Form, FormItem, Button, Input } from "ant-design-vue"
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        Form,
        FormItem,
        Button,
        Input
    },
    setup() {

        const form = useForm({
            task_type_id: null,
            task_id: null,
            deadline_date: null,
            planned_date: null,
            production_target: null,
            status_id: null
        })

        return {
            form
        }
    },
}
</script>
