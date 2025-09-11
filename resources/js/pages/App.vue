<script setup>
import { ref } from 'vue';
import { RouterView } from 'vue-router';

import { House, Send } from 'lucide-vue-next';

import Link from '@/components/Link.vue';
import SiteBackground from '@/components/SiteBackground.vue';
import AnimatedText from '@/components/AnimatedText.vue';

const isHovering = ref(false);
const animatedText = ref([
	'Tim Barden',
	'Full Stack Developer',
]);

const handleMouseEnter = () => {
	isHovering.value = true;
};
const handleMouseLeave = () => {
	isHovering.value = false;
};
</script>

<template>
	<SiteBackground :animate="!isHovering" />
	<section class="relative min-h-screen flex flex-col text-center">
		<header class="flex items-center justify-between px-[5%] py-6 gap-6 uppercase relative before:absolute before:inset-0 before:opacity-22 before:bg-white before:bg-gradient-to-r before:from-[var(--color-primary)] before:to-[var(--color-secondary)] backdrop-blur-sm">
			<div class="flex items-center gap-5">
				<img 
					src="https://github.com/timbarden.png?size=200" 
					alt="Avatar"
					class="rounded-full w-[13vw] h-[13vw] max-w-14 max-h-14 shrink-0 overflow-hidden bg-white border-2 border-gray-200 relative"
				>
				<div class="flex flex-col text-left tracking-[0.2em]">
					<AnimatedText :text="animatedText" />
				</div>
			</div>
			<nav class="flex absolute top-[calc(100%+1em)] right-[5%] md:relative md:inset-auto">
				<ul class="flex gap-[2em] text-[0.8em] md:text-[1em]">
					<Link 
						url="/" 
						:label="Home"
						@mouse-enter="handleMouseEnter"
						@mouse-leave="handleMouseLeave"
					>
						<House class="w-[1.4em] h-[1.4em]" />
					</Link>
					<Link 
						url="/contact" 
						:label="Contact"
						@mouse-enter="handleMouseEnter"
						@mouse-leave="handleMouseLeave"
					>
						<Send class="w-[1.4em] h-[1.4em]" />
					</Link>
				</ul>
			</nav>
		</header>
		<main class="w-[90%] max-w-[30em] py-6 mx-auto flex-1 flex flex-col align-center justify-center">
			<Transition>
				<RouterView @hover-change="isHovering = $event" />
			</Transition>
		</main>
	</section>
</template>

<style>
.v-enter-active,
.v-leave-active {
	transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
	opacity: 0;
}
</style>