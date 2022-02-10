<template>
    <jet-dialog-modal :show="show">
        <template #content>
            <div class="flex flex-col p-5">
                <a @click="show = !show" class="cursor-pointer">X</a>
                <form>
                    <div class="mt-4">
                        <jet-label :for="'title'+link.id" value="Title" />
                        <jet-input :id="'title'+link.id" type="text" class="mt-1 block w-full" v-model="link.title" required autofocus />
                    </div>

                    <div class="mt-4">
                        <jet-label :for="'url'+link.id" value="Url" />
                        <jet-input :id="'url'+link.id" type="text" class="mt-1 block w-full" v-model="link.url" required autofocus/>
                    </div>
                </form>
            </div>
        </template>
    </jet-dialog-modal>
</template>

<script>
    import JetLabel from '@/Jetstream/Label'
    import JetInput from '@/Jetstream/Input'
    import JetDialogModal from '@/Jetstream/DialogModal'

    export default {
        props: ['link', 'show'],

        components: {
            JetLabel,
            JetInput,
            JetDialogModal
        },

        data() {
            return {
                // show: false
            }
        },

        mounted() {

        },
    }
</script>
