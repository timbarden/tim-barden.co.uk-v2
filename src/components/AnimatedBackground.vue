<script setup lang="ts">
import { onMounted } from 'vue';

function canvasAnimation() {
	const intMaxSize = 25;
	const intQty = 2500;
	const intOpacitySpeed = 1;
	const spinSpeed = 0.4; // between 0 and 1
	const c = document.querySelector('canvas');
	const ctx = c ? c.getContext('2d') : null;

	let cX: number;
	let cY: number;
	let arr: CanvasObject[] = [];

	class CanvasObject {
		x: number;
		y: number;
		multiplier: number;
		originalSize: number;
		size: number;
		opacity: number;
		blnOpacityUp: boolean;
		color: string;
		rotate: number;
		rotateSpeed: number;

		constructor(x: number, y: number) {
			this.x = x;
			this.y = y;
			this.multiplier = this.x / (cX / 2);
			this.originalSize = this.multiplier * 40;
			if (this.originalSize > intMaxSize) {
				this.originalSize = intMaxSize;
			}
			this.size = this.originalSize;
			this.opacity = getRandomInt(10) / 10;
			this.blnOpacityUp = Math.random() >= 0.5;
			this.color = randomColor();
			this.rotate = getRandomInt(360);
			this.rotateSpeed = this.multiplier;
		}

		draw() {
			if (this.opacity < 0.1) {
				this.blnOpacityUp = true;
			}
			if (this.opacity > 0.65) {
				this.blnOpacityUp = false;
			}
			ctx.fillStyle = 'rgba(' + this.color + ', ' + this.opacity + ')';
			ctx.translate(cX / 2, cY / 2);
			ctx.rotate((this.rotate * Math.PI) / 180);
			ctx.fillRect(this.x, this.y, this.size, this.size);
			ctx.setTransform(1, 0, 0, 1, 0, 0);
		}

		update() {
			if (this.blnOpacityUp) {
				this.opacity += 0.01 * intOpacitySpeed;
			} else {
				this.opacity -= 0.01 * intOpacitySpeed;
			}
			this.rotate += this.rotateSpeed;
			if (this.rotateSpeed < 0.01) {
				this.rotateSpeed = 0.01;
			}
			if (this.rotateSpeed >= this.multiplier * spinSpeed) {
				this.rotateSpeed = this.multiplier * spinSpeed;
			}
			this.draw();
		}
	}

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
	function getRandomInt(max: number) {
		return Math.floor(Math.random() * Math.floor(max));
	}
	function init() {
		arr = [];
		for (let i = 0; i < intQty; i++) {
			arr.push(new CanvasObject(getRandomInt(cX), getRandomInt(cY)));
		}
	}
	function animate() {
		if (!ctx) return;

		requestAnimationFrame(animate);
		ctx.clearRect(0, 0, cX, cY);
		for (let i = 0; i < arr.length; i++) {
			arr[i].update();
		}
	}
	function randomIntFromInterval(min: number, max: number) {
		return Math.floor(Math.random() * (max - min + 1) + min);
	}
	function randomColor() {
		const r = () => (Math.random() * 256) >> 0;
		return r() + ',' + randomIntFromInterval(40, 70) + ',' + 255;
	}

	setCanvas();
	init();
	animate();
}

onMounted(() => {
	canvasAnimation();
});
</script>

<template>
	<canvas></canvas>
</template>

<style scoped>
canvas {
	position: fixed;
	top: 50%;
	left: 50%;
	min-width: 100%;
	min-height: 100%;
	margin: auto;
	background: #000;
	transform: translate(-50%, -50%);
	z-index: -1;
}
</style>
