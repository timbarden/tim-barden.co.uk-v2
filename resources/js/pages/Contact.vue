<script setup>
import { ref } from 'vue';

const form = ref({
	name: '',
	email: 'timbarden@outlook.com',
	messages: ''
});

const formResponse = ref('');

const submitForm = () => {
};
</script>

<template>
	<div class="w-full">
		<p v-if="formResponse">{{ formResponse }}</p>
		<form v-else @submit.prevent="submitForm"
			class="flex flex-col space-y-4 text-left w-full">
			<div class="flex flex-col">
				<label for="name" class="text-gray-400">Name:</label>
				<input v-model="form.name" type="text" id="name" name="name" required class="border border-gray-700 px-3 py-2">
			</div>

			<div class="flex flex-col">
				<label for="email" class="text-gray-400">Email:</label>
				<input v-model="form.email" type="email" id="email" name="email" required class="border border-gray-700 px-3 py-2">
			</div>

			<div class="flex flex-col">
				<label for="body" class="text-gray-400">Message:</label>
				<textarea v-model="form.body" id="body" name="body" required class="border border-gray-700 px-3 py-2 resize-none" rows="5"></textarea>
			</div>

			<button type="submit" class="bg-gradient-to-r from-[#0e55e8] to-[#5e32cf] text-white py-2 px-4 uppercase">Send!</button>
		</form>
	</div>
</template>