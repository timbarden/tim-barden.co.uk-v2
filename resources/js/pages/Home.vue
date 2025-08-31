<script setup>
import AppLayout from '@/pages/App.vue';
import Link from '@/components/Link.vue';

const links = [
    { url: 'https://github.com/timbarden', label: 'GitHub' },
    { url: 'https://codepen.io/timbarden', label: 'CodePen' },
    { url: 'http://www.ethelbertsdiary.co.uk', label: "Ethelbert's Diary" },
    { url: '/contact', label: 'Contact' }
];
</script>

<template>
	<AppLayout>
		<ul class="uppercase tracking-[0.2em] mt-10">
			<Link 
				v-for="link in links" 
				:key="link.url" 
				:url="link.url" 
				:label="link.label" 
			/>
		</ul>
	</AppLayout>
</template>
