<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Links
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-5
            rounded-xl bg-gradient-to-r bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 p-2 sm:p-6">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-if="flash" 
                        class="bg-green-400 border-t-4 border-t- border-green-500 rounded-md text-green-900 px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ $page.props.flash.message }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end w-full mb-4">
                        <jet-button @click.native="openCreateForm" class="bg-blue-600 hover:bg-blue-500 justify-end">
                            Create
                        </jet-button>
                    </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">
                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Title
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                URL
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Author
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-right text-gray-700 uppercase dark:text-gray-400">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    <tr v-for="(link) in links" :key="link.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a :href="link.url" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">
                                                {{ link.title }}
                                            </a>
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                            <a :href="link.url" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">
                                                {{ link.url }}
                                            </a>
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                            {{ link.user.name }}
                                        </td>
                                        <td class="flex space-x-4 items-center justify-end py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <a @click="edit(link)" href="#" 
                                                class="text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <a @click="destroy(link)" href="#" 
                                                class="cursor-pointer text-red-600 dark:text-red-500 hover:underline">
                                                <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <jet-dialog-modal :show="isOpen">
                    <template #title>
                        <h2>Edit link</h2>
                    </template>
                    <template #content>
                        <div class="flex flex-col">
                            <form>
                                <div>
                                    <jet-label :for="'title'+formData.id" value="Title" />
                                    <jet-input :id="'title'+formData.id" type="text" class="mt-1 block w-full" v-model="formData.title" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <jet-label :for="'url'+formData.id" value="Url" />
                                    <jet-input :id="'url'+formData.id" type="text" class="mt-1 block w-full" v-model="formData.url" required autofocus/>
                                </div>
                            </form>
                        </div>
                    </template>
                    <template #footer>
                        <jet-danger-button class="ml-2" @click.native="update(formData)">
                            Update
                        </jet-danger-button>
                        <jet-secondary-button @click.native="closeModal">
                            Cancel
                        </jet-secondary-button>
                    </template>
                </jet-dialog-modal>

                <jet-dialog-modal :show="showCreateForm">
                    <template #title>
                        <h2>Create new link</h2>
                    </template>
                    <template #content>
                        <div class="flex flex-col p-5">
                            <form>
                                <div class="mt-4">
                                    <jet-label for="title" value="Title" />
                                    <jet-input id="title" type="text" class="mt-1 block w-full" 
                                        v-model="formData.title" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <jet-label for="url" value="Url" />
                                    <jet-input id="url" type="text" class="mt-1 block w-full" 
                                        v-model="formData.url" required autofocus/>
                                </div>
                                <div class="mt-4">
                                    <jet-label for="description" value="Description" />
                                    <textarea id="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        v-model="formData.description" required autofocus></textarea>
                                </div>
                            </form>
                        </div>
                    </template>
                    <template #footer>
                        <jet-danger-button class="ml-2" @click.native="create(formData)">
                            Create
                        </jet-danger-button>
                        <jet-secondary-button @click.native="showCreateForm = false">
                            Cancel
                        </jet-secondary-button>
                    </template>
                </jet-dialog-modal>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import CreateLink from './CreateLink'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetButton from '@/Jetstream/Button'

    export default {
        props: ['links'],

        components: {
            AppLayout,
            Welcome,
            CreateLink,
            JetDialogModal,
            JetInput,
            JetLabel,
            JetDangerButton,
            JetSecondaryButton,
            JetButton,
        },

        data() {
            return {
                isOpen: false,
                showCreateForm: false,
                formData: {
                    title: null,
                    url: null,
                    descrition: null,
                }
            }
        },

        methods: {
            edit(data) {
                this.formData =  Object.assign({}, data);
                this.openModal();
            },

            openModal() {
                this.isOpen = true;
            },

            closeModal() {
                this.isOpen = false;
                // this.formData = {};
            },

            update(formData) {
                formData._method = 'PUT';
                this.$inertia.post('/links/' + formData.id, formData);
                this.closeModal();
            },

            destroy(formData) {
                formData._method = 'DELETE';
                this.$inertia.post('/links/' + formData.id, formData);
                this.closeModal();
            },

            create(formData) {
                this.$inertia.post('/links/', formData);
                this.showCreateForm = false;
                // this.formData = {};
            },

            openCreateForm() {
                this.formData = {};
                this.showCreateForm = true;
            }
        },

        computed: {
            flash() {
                setTimeout(() => {
                    this.$page.props.flash.message = null;
                }, 4000);

                return this.$page.props.flash.message;
            },
        }
    }
</script>
