<script setup>
import { ref } from 'vue';
import axios from 'axios';

import Input from '@/components/Input.vue';

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
		<p v-if="formResponse">
			{{ formResponse }}
		</p>
		<form
			v-else
			class="flex flex-col space-y-4 text-left w-full"
			@submit.prevent="submitForm"
		>
			<div class="flex flex-col">
				<Input 
					id="name" 
					v-model="form.name" 
					type="text" 
					name="name" 
					label="Name"
					autocomplete="name"
					required
				/>
			</div>

			<div class="flex flex-col">
				<Input 
					id="email" 
					v-model="form.email" 
					type="email" 
					name="email" 
					label="Email"
					autocomplete="email"
					required
				/>
			</div>

			<div class="flex flex-col">
				<Input 
					id="body" 
					v-model="form.body" 
					name="body" 
					required 
					label="Message"
					:multiline="6"
				/>
			</div>

			<button
				type="submit"
				class="bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] text-white py-2 px-4 uppercase tracking-[0.2em] cursor-pointer before:content-[''] before:absolute before:inset-0 before:bg-black before:opacity-0 before:transition-opacity hover:before:opacity-15 relative overflow-hidden"
			>
				Send!
			</button>
		</form>
	</div>
</template>