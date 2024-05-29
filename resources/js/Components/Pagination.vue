<template>
    <nav>
        <ul class="flex">
            <li v-for="link in links" :key="link.url" class="mx-1">
                <InertiaLink
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    :class="[
                        'px-2 py-1 border rounded',
                        {
                            'bg-gray-300': link.active,
                            'hover:bg-gray-200': !link.active,
                        },
                    ]"
                ></InertiaLink>
                <span v-else v-html="link.label" class="px-2 py-1 border rounded text-gray-500"></span>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { Link as InertiaLink } from "@inertiajs/vue3";

defineProps({
    links: Array
});
</script>
