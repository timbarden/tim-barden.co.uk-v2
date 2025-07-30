<script setup lang="ts"></script>

<template>
	<div class="welcome__list">
		<ul>
			<li>
				<a href="https://github.com/timbarden" target="_blank">
					<span>GitHub</span>
				</a>
			</li>
			<li>
				<a href="https://codepen.io/timbarden" target="_blank">
					<span>Codepen</span>
				</a>
			</li>
			<li>
				<a href="http://www.ethelbertsdiary.co.uk/" target="_blank">
					<span>Ethelbert's Diary</span>
				</a>
			</li>
			<li>
				<RouterLink to="/contact">
					<span>Contact</span>
				</RouterLink>
			</li>
		</ul>
	</div>
</template>

<style scoped>
ul {
	list-style: none;
	padding: 0 5%;
	margin: 0;
	text-transform: uppercase;
	letter-spacing: 0.2em;
	line-height: 1.5;
	li {
		display: block;
		margin: 2.5em 0 0;
		a {
			position: relative;
			display: inline-block;
			vertical-align: bottom;
			&:after {
				position: absolute;
				content: '';
				bottom: -0.5em;
				left: 0.5em;
				right: 0.5em;
				margin: auto;
				height: 3px;
				max-width: 200px;
				opacity: 0.8;
				background: #fff;
				transform: scale(0, 1);
				transition: transform 0.3s ease;
				background: linear-gradient(to right, #0e55e8, #5e32cf);
			}
			span {
				display: inline-block;
				vertical-align: bottom;
			}
			@media (hover: hover) {
				&:hover:after {
					transform: scale(1, 1);
				}
			}
		}
	}
}
</style>
