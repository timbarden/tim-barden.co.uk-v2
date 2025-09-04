<script setup>
import { ref } from 'vue';
import axios from 'axios';

const form = ref({
	name: '',
	email: '',
	messages: ''
});

const formResponse = ref('');

const submitForm = () => {
	grecaptcha.ready(function() {
		grecaptcha.execute(import.meta.env.VITE_RECAPTCHA_KEY, {
			action: 'contactFormSubmit'
		}).then(function(token) {
			axios.post('/contact/submit', {
				name: form.value.name,
				email: form.value.email,
				body: form.value.body,
				'g-recaptcha-response': token
			})
			.then((res) => {
				formResponse.value = res.data.message;
				if (res.status === 200) {
					form.value.name = '';
					form.value.email = '';
					form.value.body = '';
				} else {
					console.error("Error:", res);
				}
			})
			.catch((error) => {
				console.error("Error:", error)
			})
		});
	});
};
</script>

<template>
	<div class="w-full">
		<p v-if="formResponse">{{ formResponse }}</p>
		<form v-else @submit.prevent="submitForm"
			class="flex flex-col space-y-4 text-left w-full">
			<div class="flex flex-col">
				<label for="name" class="text-gray-400 mb-1">Name</label>
				<input v-model="form.name" type="text" id="name" name="name" required class="border-2 border-gray-800 px-3 py-2 outline-none focus:border-[#0e55e8]">
			</div>

			<div class="flex flex-col">
				<label for="email" class="text-gray-400 mb-1">Email</label>
				<input v-model="form.email" type="email" id="email" name="email" required class="border-2 border-gray-800 px-3 py-2 outline-none focus:border-[#0e55e8]">
			</div>

			<div class="flex flex-col">
				<label for="body" class="text-gray-400 mb-1">Message</label>
				<textarea v-model="form.body" id="body" name="body" required class="border-2 border-gray-800 px-3 py-2 resize-none outline-none focus:border-[#0e55e8]" rows="5"></textarea>
			</div>

			<button type="submit" class="bg-gradient-to-r from-[#0e55e8] to-[#5e32cf] text-white py-2 px-4 uppercase tracking-[0.2em]">Send!</button>
		</form>
	</div>
</template>