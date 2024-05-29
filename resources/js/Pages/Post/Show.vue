<template>
    <Head title="Posts" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{post.title}}</h5>
                                        <p class="m-4 font-normal text-gray-700 dark:text-gray-400 text-center">{{post.content}}</p>
                                        <NavLink class="m-4" :href="route('posts.index')">Back</NavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";

defineProps({
    post: Object
})

</script>

