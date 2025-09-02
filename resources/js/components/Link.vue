<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    url: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: true
    }
});
const classes = "relative inline-block align-bottom after:absolute after:bottom-[-0.5em] after:left-1 after:right-1 after:mx-auto after:h-1 after:max-w-[200px] after:opacity-80 after:scale-x-0 after:bg-white after:transition-transform after:duration-300 after:ease after:bg-gradient-to-r after:from-[#0e55e8] after:to-[#5e32cf] hover:after:scale-x-100";
</script>

<template>
    <li class="mx-2 my-6">
        <RouterLink
            v-if="props.url.startsWith('/')"
            :to="props.url"
            :class="classes"
        >
            <span>{{ props.label }}</span>
        </RouterLink>
        <a 
            v-else
            :href="props.url" 
            target="_blank"
            :class="classes"
        >
            <span>{{ props.label }}</span>
        </a>
    </li>
</template>