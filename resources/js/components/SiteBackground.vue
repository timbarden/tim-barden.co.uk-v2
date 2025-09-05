<script setup>
import { onMounted, ref } from 'vue';
import { useCssVar } from '@vueuse/core';

const props = defineProps({
	animate: {
		type: Boolean,
		default: true
	}
});

const animateBackground = ref(true);

const cssVarColorPrimary = useCssVar('--color-primary');
const cssVarColorSecondary = useCssVar('--color-secondary');

if (window.matchMedia(`(prefers-reduced-motion: reduce)`) === true || window.matchMedia(`(prefers-reduced-motion: reduce)`).matches === true){
	animateBackground.value = false;
}

function generate() {
	const options = {
		animate: animateBackground.value,
		maxSize: 30,
		opacityFlashSpeed: 1.5, // 0+
		quantity: 2500,
		spinSpeed: 0.4, // between 0 and 1
	};

	class CanvasObject {
		x = 0;
		y = 0;
		multiplier = 0;
		originalSize = 0;
		size = 0;
		opacity = 0;
		opacityIncreasing = false;
		color = '';
		rotate = 0;
		rotateSpeed = 0;

		constructor(x, y) {
			this.x = x;
			this.y = y;
			this.multiplier = this.x / (cX / 2);
			this.originalSize = this.multiplier * 40;
			if (this.originalSize > options.maxSize) {
				this.originalSize = options.maxSize;
			}
			this.size = this.originalSize;
			this.opacity = getRandomInt(10) / 10;
			this.opacityIncreasing = Math.random() >= 0.5;
			this.color = randomColor();
			this.rotate = getRandomInt(360);
			this.rotateSpeed = this.multiplier;
		}

		draw() {
			if (this.opacity < 0.1) {
				this.opacityIncreasing = true;
			}
			if (this.opacity > 0.65) {
				this.opacityIncreasing = false;
			}
			ctx.fillStyle = 'rgba(' + this.color + ', ' + this.opacity + ')';
			ctx.translate(cX / 2, cY / 2);
			ctx.rotate((this.rotate * Math.PI) / 180);
			ctx.fillRect(this.x, this.y, this.size, this.size);
			ctx.setTransform(1, 0, 0, 1, 0, 0);
		}

		update() {
			this.opacityIncreasing ? (this.opacity+=0.01 * options.opacityFlashSpeed) : (this.opacity-=0.01 * options.opacityFlashSpeed);
			this.rotate+= this.rotateSpeed;
			if (this.rotateSpeed >= this.multiplier * options.spinSpeed) {
				this.rotateSpeed = this.multiplier * options.spinSpeed;
			}

			if (props.animate) {
				if (this.rotateSpeed < 0.1) {
					this.rotateSpeed = 0.1;
				}
				if (this.rotateSpeed >= this.multiplier * options.spinSpeed + 0.1) {
					this.rotateSpeed = this.multiplier * options.spinSpeed + 0.1;
				} else {
					this.rotateSpeed = this.rotateSpeed * 1.07;
				}
			} else {
				if (this.rotateSpeed <= 0) {
					this.rotateSpeed = 0;
				} else {
					this.rotateSpeed = this.rotateSpeed * 0.93;
				}
			}

			this.draw();
		}
	}

	const c = document.querySelector('canvas');
	const ctx = c ? c.getContext('2d') : null;
	let cX = 0;
	let cY = 0;
	let arr = new CanvasObject();

	function setCanvas() {
		if (!c) return;

		if (window.innerWidth < 800) {
			c.width = 800;
		} else {
			c.width = window.innerWidth;
		}
		c.height = window.innerHeight;
		cX = c.width;
		cY = c.height;
	}
	function getRandomInt(max) {
		return Math.floor(Math.random() * Math.floor(max));
	}
	function init() {
		arr = [];
		for (let i = 0; i < options.quantity; i++) {
			arr.push(new CanvasObject(getRandomInt(cX), getRandomInt(cY)));
		}
	}
	function animate() {
		if (!ctx) return;

		if (options.animate) {
			requestAnimationFrame(animate);
		}
		ctx.clearRect(0, 0, cX, cY);
		for (let i = 0; i < arr.length; i++) {
			arr[i].update();
		}
	}
	function randomColor() {
		const arr = [];
		arr.push(cssVarColorPrimary.value.replace('#', '').match(/.{1,2}/g).map(x => parseInt(x, 16)).join(','));
		arr.push(cssVarColorSecondary.value.replace('#', '').match(/.{1,2}/g).map(x => parseInt(x, 16)).join(','));

		return arr[Math.floor(Math.random() * arr.length)];
	}

	setCanvas();
	init();
	animate();
}

onMounted(() => {
	generate();
});
</script>

<template>
	<canvas class="fixed top-1/2 left-1/2 min-w-full min-h-full translate-[-50%] bg-black"></canvas>
</template>