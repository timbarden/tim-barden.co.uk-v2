<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import SiteBackground from '@/components/SiteBackground.vue';
</script>

<template>
	<SiteBackground />
	<section class="relative min-h-screen flex flex-col items-center justify-center text-center">
		<header>
			<img 
				src="https://github.com/timbarden.png?size=200" 
				alt="Avatar"
				class="rounded-full w-[25vw] h-[25vw] max-w-18 max-h-18 shrink-0 overflow-hidden bg-white border-2 border-gray-200 relative m-auto mb-4"
			/>
			<nav>
				<Link href="/">Home</Link>
				<Link href="/contact">Contact</Link>
			</nav>
		</header>
		<main>
			<slot />
		</main>
	</section>
</template>
