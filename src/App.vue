<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router';
import AnimatedBackground from './components/AnimatedBackground.vue';
</script>

<template>
	<AnimatedBackground />
	<section>
		<header>
			<img src="https://github.com/timbarden.png?size=400" alt="" />
			<nav>
				<RouterLink to="/">Home</RouterLink>
				<RouterLink to="/contact">Contact</RouterLink>
			</nav>
		</header>
		<main>
			<RouterView />
		</main>
	</section>
</template>

<style scoped>
section {
	background: rgba(255, 255, 255, 0.1);
	min-height: 100vh;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}
img {
	width: 4.5em;
	height: 4.5em;
	flex-shrink: 0;
	overflow: hidden;
	border-radius: 50%;
	background: #fff;
	border: 3px solid #fff;
	position: relative;
}
</style>
