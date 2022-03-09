<template>
    <app-layout title="Müşteriler">
        <template #header>
            Müşteriler
        </template>

        <!--Add New Customer-->
        <template #action-buttons>
            <Button type="primary" @click="showAddForm=true">
                <icon icon="plus" class="mr-2"/>
                Yeni Müşteri Ekle
            </Button>
        </template>
        <Table :dataSource="customers" :columns="columns">
            <template #bodyCell="{ column, text, record }">
                <!--Name-->
                <template v-if="column.dataIndex === 'name'">
                    <span v-text="record.name"/>
                </template>
                <!--Email-->
                <template v-if="column.dataIndex === 'email'">
                    <span v-text="record.email"/>
                </template>
                <!--Phone-->
                <template v-if="column.dataIndex === 'phone'">
                    <span v-text="record.phone"/>
                </template>
                <!--Action-->
                <template v-if="column.dataIndex === 'action'">
                    <div class="flex justify-center items-center space-x-4">
                        <!--Edit-->
                        <icon icon="edit" class="cursor-pointer hover:scale-110 text-sky-600"
                              @click="form.id = record.id; form.name = record.name"/>
                        <Popconfirm
                            v-if="customers.length"
                            title="Silinecek, emin misiniz?"
                            ok-text="Evet, sil"
                            cancel-text="Vazgeç"
                            @confirm="onDelete(record.id)"
                        >
                            <div class="cursor-pointer hover:scale-110">
                                <!--Delete-->
                                <icon icon="trash" class="text-rose-600"/>
                            </div>
                        </Popconfirm>
                    </div>
                </template>
            </template>
        </Table>
    </app-layout>
    <teleport to="body">
        <Modal v-model:visible="showAddForm" title="Yeni Müşteri Ekle" @ok="save">
            <Form
                :model="addForm"
                autocomplete="off"
            >
                <!--Name-->
                <FormItem
                    label="Müşteri Adı"
                    name="name"
                    :rules="[{ required: true, message: 'Lütfen müşteri adı alanını doldurunuz' }]"

                >
                    <Input v-model:value="addForm.name"/>
                </FormItem>

                <!--Email-->
                <FormItem
                    label="Email"
                    name="email"
                    :rules="[{ required: true, message: 'Lütfen email alanını doldurunuz' }]"

                >
                    <Input v-model:value="addForm.email"/>
                </FormItem>

                <!--Phone-->
                <FormItem
                    label="Telefon"
                    name="phone"
                    :rules="[{ required: true, message: 'Lütfen telefon alanını doldurunuz' }]"
                >
                    <Input v-model:value="addForm.phone"/>
                </FormItem>

                <!--Address-->
                <FormItem
                    label="Adres"
                    name="address"
                    :rules="[{ required: true, message: 'Lütfen adres alanını doldurunuz' }]"
                >
                    <Textarea v-model:value="addForm.address"/>
                </FormItem>
            </Form>
        </Modal>
    </teleport>
</template>
<script>
/*Main functions*/
import {nextTick, onUpdated, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";

/*Components*/
import AppLayout from "@/Layouts/AppLayout.vue";
import {
    Table,
    Button,
    ButtonGroup,
    Input,
    Textarea,
    Popconfirm,
    Modal,
    Form,
    FormItem,
    notification
} from "ant-design-vue";

/*Icons*/
import {library} from '@fortawesome/fontawesome-svg-core'
import {faCheck, faEdit, faCancel, faTrash, faPlus} from '@fortawesome/free-solid-svg-icons'

library.add(faCheck, faEdit, faCancel, faTrash, faPlus)

export default ({
    name: 'CustomerIndex',
    components: {
        AppLayout,
        Table,
        Button,
        ButtonGroup,
        Input,
        Textarea,
        Popconfirm,
        Modal,
        Form,
        FormItem
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
            {
                title: '',
                dataIndex: 'action'
            }
        ]

        /*Add Form*/
        const showAddForm = ref(false);
        const addForm = useForm({
            name: null,
            email: null,
            phone: null,
            address: null
        })

        /*Edit*/
        const form = useForm({
            id: null,
            name: null,
            email: null,
            phone: null,
            address: null
        })

        const update = () => {
            form.patch(route('customer.update', form.id), {
                data: {
                    form
                }
            })

            form.reset()
        }

        /*Delete*/
        const onDelete = id => {
            form.delete(route('customer.update', id))
        }

        const save = () => {
            addForm.post(route('customer.store'), {
                data: {
                    addForm
                }
            })

            addForm.reset()
            showAddForm.value = false
        }

        onUpdated(() => {
            console.log(Inertia.page.props)
            if (Inertia.page.props.flash.message) {
                openNotification(Inertia.page.props.flash.message)
                nextTick(() => {
                    Inertia.page.props.flash.message = null
                })
            }
        })

        /*Notification*/
        const openNotification = (message) => {
            notification.open({
                description: message.content
            });
        };

        return {columns, form, update, onDelete, showAddForm, addForm, save}

    }
})
</script>
