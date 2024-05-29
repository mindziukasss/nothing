<template>
    <Head title="Posts" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <h2 class="m-2.5">Request duration: {{$page.props.duration}}</h2>
                                    <table class="table-fixed border-collapse table-fixed w-full text-sm">
                                        <thead>
                                        <tr>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">Id</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">Title</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">Content</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">Publish</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">Created</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">Updated</th>
                                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="post in $page.props.posts.data" :key="post.id">
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">{{ post.id }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">{{ post.title }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">{{ post.content.substring(0, 50) + '...' }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">{{ post.publish }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">{{ formatDate(post.created_at) }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">{{ formatDate(post.updated_at) }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                                                <NavLink :href="route('posts.show', post.id)"> Show </NavLink>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-4">
                                        <Pagination :links="genUrl($page.props.posts.links, $page.props.functionName)" />
                                    </div>
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
import { Head } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import Pagination from "@/Components/Pagination.vue";

function padToTwoDigits(number) {
    return number.toString().padStart(2, '0');
}

function genUrl(links, functionName) {
    return links.map(link => {
        if (link.url) {
            const url = new URL(link.url);
            url.searchParams.set('function', functionName);
            return {
                ...link,
                url: url.toString()
            };
        }
        return link;
    });
}

function formatDate(timestamp) {
    const date = new Date(timestamp);
    const year = date.getFullYear();
    const month = padToTwoDigits(date.getMonth() + 1);
    const day = padToTwoDigits(date.getDate());
    const hours = padToTwoDigits(date.getHours());
    const minutes = padToTwoDigits(date.getMinutes());
    const seconds = padToTwoDigits(date.getSeconds());

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}
</script>
