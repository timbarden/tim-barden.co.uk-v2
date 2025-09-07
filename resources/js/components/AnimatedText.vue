<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
	text: {
		type: Array,
		required: true
	}
});

const animatedText = ref(props.text[0]);
const intCurrentTextIndex = ref(0);
const active = ref(true);

setInterval(() => {
	active.value = false;
	intCurrentTextIndex.value = (intCurrentTextIndex.value + 1) % props.text.length;
	animatedText.value = props.text[intCurrentTextIndex.value];
	setTimeout(() => {
		active.value = true;
	}, 1000);
}, 7000);

const computedAnimatedText = computed(() => {
	let html = '';
	animatedText.value.split('').forEach((letter, index) => {
		letter === ' ' && (letter = '&nbsp;');
		html += `<span style="transition-delay: ${0.1 * index}s;">${letter}</span>`;
	});
	return html;
});
</script>

<template>
	<p
		:class="{ active }"
		v-html="computedAnimatedText"
	/>
</template>

<style scoped>
	p :deep(span) {
		display: inline-block;
		vertical-align: bottom;
		opacity: 0;
		transform: scale(0.9);
		transform-origin: 50% 100%;
		transition: opacity 0s ease, transform 0.1s ease;
		will-change: opacity, transform;
	}
	p.active :deep(span) {
		opacity: 1;
		transform: scale(1);
	}
</style>
