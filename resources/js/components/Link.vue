<script setup>
const props = defineProps({
    url: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: true
    },
    variation: {
        type: String,
        required: false,
        default: "white"
    }
});

const emits = defineEmits('mouseEnter', 'mouseLeave');

const classes = "relative inline-block align-bottom tracking-[0.2em] after:absolute after:bottom-[-0.5em] after:left-1 after:right-1 after:mx-auto after:h-1 after:max-w-[200px] after:opacity-80 after:scale-x-0 after:transition-transform after:duration-300 after:ease after:bg-gradient-to-r hover:after:scale-x-100";
const variations = {
    white: "after:bg-white",
    gradient: "after:from-[var(--color-primary)] after:to-[var(--color-secondary)]"
};
</script>

<template>
    <li class="mx-2 my-6">
        <RouterLink
            v-if="props.url.startsWith('/')"
            :to="props.url"
            :class="[classes, variations[props.variation]]"
            activeClass="after:scale-x-100"
            @mouseenter="emits('mouseEnter')"
            @mouseleave="emits('mouseLeave')"
        >
            <span>{{ props.label }}</span>
        </RouterLink>
        <a 
            v-else
            :href="props.url" 
            target="_blank"
            :class="[classes, variations[props.variation]]"
            @mouseenter="emits('mouseEnter')"
            @mouseleave="emits('mouseLeave')"
        >
            <span>{{ props.label }}</span>
        </a>
    </li>
</template>