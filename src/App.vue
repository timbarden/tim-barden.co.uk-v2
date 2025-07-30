<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router';
import SiteBackground from './components/SiteBackground.vue';
</script>

<template>
	<SiteBackground />
	<section>
		<header>
			<img src="https://github.com/timbarden.png?size=200" alt="Avatar" />
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
	min-height: 100vh;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}
header,
main {
	width: 100%;
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
