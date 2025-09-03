<script setup>
import { RouterView } from 'vue-router';
import Link from '@/components/Link.vue';
import SiteBackground from '@/components/SiteBackground.vue';
</script>

<template>
	<SiteBackground />
	<section class="relative min-h-screen flex flex-col text-center">
		<header class="flex items-center justify-between px-[5%] py-6 gap-6 uppercase relative before:absolute before:inset-0 before:opacity-30 before:bg-white before:ease before:bg-gradient-to-r before:from-[#0e55e8] before:to-[#5e32cf]">
			<img 
				src="https://github.com/timbarden.png?size=200" 
				alt="Avatar"
				class="rounded-full w-[25vw] h-[25vw] max-w-14 max-h-14 shrink-0 overflow-hidden bg-white border-2 border-gray-200 relative"
			/>
			<nav class="flex">
				<ul class="flex gap-6">
					<Link url="/" label="Home">Home</Link>
					<Link url="/contact" label="Contact">Contact</Link>
				</ul>
			</nav>
		</header>
		<main class="w-[90%] max-w-[30em] mx-auto flex-1 flex flex-col align-center justify-center">
			<Transition>
				<RouterView />
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