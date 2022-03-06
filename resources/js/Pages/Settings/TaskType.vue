<template>
    <setting-layout title="İş Emri Türü">
        <!--Header-->
        <template #header>
            İş Emri Türleri
        </template>

        <template #action-buttons>
            <Button type="primary" @click="showAddForm=true">
                <icon icon="plus" class="mr-2"/>
                Yeni Tür Ekle
            </Button>
        </template>

        <!--Content-->
        <Table :dataSource="taskTypes" :columns="columns" class="w-full">
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.dataIndex === 'name'">
                    <div class="flex justify-between items-center space-x-4">
                        <div v-if="form.id === record.id"
                             class="flex justify-between items-center space-x-4">
                            <Input v-model:value="form.name"/>
                            <icon icon="check" class="cursor-pointer hover:scale-110" @click="update"/>
                            <icon icon="cancel" class="cursor-pointer hover:scale-110" @click="form.reset()"/>
                        </div>

                        <div v-else class="flex justify-between items-center space-x-4">
                            <span v-text="record.name"/>
                            <icon icon="edit" class="cursor-pointer hover:scale-110"
                                  @click="form.id = record.id; form.name = record.name"/>
                        </div>
                    </div>

                    <div>

                    </div>
                </template>
                <template v-else-if="column.dataIndex === 'action'">
                    <Popconfirm
                        v-if="taskTypes.length"
                        title="Silinecek, emin misiniz?"
                        ok-text="Evet, sil"
                        cancel-text="Vazgeç"
                        @confirm="onDelete(record.id)"
                    >
                        <div class="flex justify-center items-center cursor-pointer hover:scale-110">
                            <icon icon="trash" class="text-rose-600"/>
                        </div>
                    </Popconfirm>
                </template>
            </template>
        </Table>
    </setting-layout>

    <teleport to="body">
        <Modal v-model:visible="showAddForm" title="Yeni İş Emri Türü Ekle" @ok="save">
            <Form
                :model="addForm"
                autocomplete="off"
            >
                <FormItem
                    label="Tür"
                    name="name"
                    :rules="[{ required: true, message: 'Lütfen iş emri türü alanını doldurunuz' }]"

                >
                    <Input v-model:value="addForm.name"/>
                </FormItem>
            </Form>
        </Modal>
    </teleport>
</template>

<script>
import SettingLayout from "@/Pages/Settings/SettingLayout";
import {Table, Button, ButtonGroup, Input, Popconfirm, Modal, Form, FormItem, notification} from "ant-design-vue";
import {nextTick, onMounted, onUpdated, reactive, ref, toRefs} from "vue";
import {cloneDeep} from "lodash";

/*Icons*/
import {library} from '@fortawesome/fontawesome-svg-core'
import {faCheck, faEdit, faCancel, faTrash, faPlus} from '@fortawesome/free-solid-svg-icons'
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

library.add(faCheck, faEdit, faCancel, faTrash, faPlus)


export default {
    name: "TaskType",
    components: {
        SettingLayout,
        Table,
        Button,
        ButtonGroup,
        Input,
        Popconfirm,
        Modal,
        Form,
        FormItem
    },
    props: {
        taskTypes: {
            type: Object,
            default: () => {
                return {}
            }
        }
    },
    setup(props) {
        const {taskTypes} = toRefs(props)

        /*Table*/
        const columns = [
            {
                title: 'Tür',
                dataIndex: 'name',
                key: 'name',
            },
            {
                title: '',
                dataIndex: 'action'
            }
        ]

        /*Add Form*/
        const showAddForm = ref(false);
        const addForm = useForm({
            name: null
        })

        /*Edit*/
        const form = useForm({
            id: null,
            name: null
        })

        const update = () => {
            form.patch(route('task-type.update', form.id), {
                data: {
                    form
                }
            })

            form.reset()
        }

        /*Delete*/
        const onDelete = id => {
            form.delete(route('task-type.update', id))
        }

        const save = () => {
            addForm.post(route('task-type.store'), {
                data: {
                    addForm
                }
            })

            addForm.reset()
            showAddForm.value = false
        }

        onUpdated(()=>{
            console.log(Inertia.page.props)
            if(Inertia.page.props.flash.message){
                openNotification(Inertia.page.props.flash.message)
                nextTick(()=>{
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
}
</script>

<style scoped>

</style>
