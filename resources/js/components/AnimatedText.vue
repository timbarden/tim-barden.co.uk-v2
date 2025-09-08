<script setup>
import { onMounted } from "vue";

import { gsap } from "gsap";
import { SplitText } from "gsap/SplitText";

const props = defineProps({
	text: {
		type: Array,
		required: true
	}
});

onMounted(() => {
	let timeline = gsap.timeline({
		repeat: -1,
	});
	props.text.forEach((line, index) => {
		const split = SplitText.create(`.gsap_line-${index}`, { type: "chars" });

		timeline.from(split.chars, {
			duration: 0.05,
			y: 1,
			autoAlpha: 0,
			stagger: 0.12,
		}).to(`.gsap_line-${index}`, { 
			opacity: 0,
			y: -10,
			duration: .15,
			delay: 2.5,
		})
	});
});
</script>

<template>
	<div class="grid grid-cols-1 grid-rows-1">
		<p
			v-for="(line, index) in props.text"
			:id="index"
			:key="index"
			:class="`gsap_line-${index} row-span-full col-span-full`"
		>
			{{ line }}
		</p>
	</div>
</template>
