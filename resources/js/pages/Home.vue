<script setup>
import { ref, watch } from 'vue';

import Link from '@/components/Link.vue';

const emits = defineEmits(['hoverChange']);

const links = [
    { url: 'https://github.com/timbarden', label: 'GitHub' },
    { url: 'https://codepen.io/timbarden', label: 'CodePen' },
    { url: 'http://www.ethelbertsdiary.co.uk', label: "Ethelbert's Diary" },
    { url: '/contact', label: 'Contact' }
];

const isHovering = ref(false);

const handleMouseEnter = () => {
    isHovering.value = true;
};
const handleMouseLeave = () => {
    isHovering.value = false;
};

watch(isHovering, (newVal) => {
	emits('hoverChange', newVal);
});
</script>

<template>
	<ul class="uppercase">
		<Link 
			v-for="link in links" 
			:key="link.url" 
			:url="link.url" 
			:label="link.label" 
			variation="gradient"
			@mouseEnter="handleMouseEnter"
			@mouseLeave="handleMouseLeave"
		/>
	</ul>
</template>
