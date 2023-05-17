<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification'

defineProps({
    posts: Array
})

const page = usePage()
const toast = useToast()

// console.log(page.props.greeting)

const form = useForm({
    body: '',
})

const createPost = () => {
    form.post(route('comments.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast('Comment posted!')
            form.reset()
        }
    })
}

const refreshComments = () => {
    router.get(route('comments.index'), {}, {
        preserveScroll: true,
        only: ['posts']
    })
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-3">
                <!-- {{ $page.props.greeting }} -->
                <form class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" v-on:submit.prevent="createPost">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" v-model="form.body" v-on:focus="form.clearErrors('body')"></textarea>
                    <div v-if="form.errors.body" class="text-sm text-red-500">
                        {{ form.errors.body }}
                    </div>
                    <button
                        type="submit"
                        class="mt-2 bg-gray-700 px-4 py-2 rounded-md font-medium text-white"
                        :disabled="form.processing"
                        :class="{ 'opacity-50': form.processing }"
                    >Post</button>
                </form>

                <div class="py-3 flex justify-center">
                    <!-- <Link href="/comments" class="text-sm text-indigo-700" preserve-scroll :only="['posts']">Refresh comments</Link> -->
                    <button class="text-sm text-indigo-700" type="button" v-on:click="refreshComments">Refresh comments</button>
                </div>

                <div v-for="post in $page.props.posts" :key="post.id">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="font-semibold">
                                <Link :href="route('users.show', post.user)">{{ post.user.name }}</Link>
                            </div>
                            <p class="mt-1">{{ post.body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Head title="Comments">
        <meta name="description" content="Comments index">
    </Head>
</template>
