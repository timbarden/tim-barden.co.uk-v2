<script setup>
import Link from '@/components/Link.vue';

const links = [
    { url: 'https://github.com/timbarden', label: 'GitHub' },
    { url: 'https://codepen.io/timbarden', label: 'CodePen' },
    { url: 'http://www.ethelbertsdiary.co.uk', label: "Ethelbert's Diary" },
    { url: '/contact', label: 'Contact' }
];
</script>

<template>
	<ul class="uppercase">
		<Link 
			v-for="link in links" 
			:key="link.url" 
			:url="link.url" 
			:label="link.label" 
		/>
	</ul>
</template>
