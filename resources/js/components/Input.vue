<script setup>
const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    type: {
        type: String,
        default: 'text'
    },
    id: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        default: ''
    },
    required: {
        type: Boolean,
        default: false
    },
    multiline: {
        type: Number,
        default: 1
    },
    label: {
        type: String,
        default: ''
    }
});

const classes = "border-2 border-gray-800 px-3 py-2 outline-none focus:[border-image:linear-gradient(to_top_right,var(--color-primary),var(--color-secondary))_1]";
</script>

<template>
    <label :for="props.id" class="text-gray-400 mb-1">
        {{ props.label + (props.required ? ' *' : '') }}
    </label>
    <textarea 
        v-if="type === 'text' && props.multiline > 1" 
        :v-model="modelValue" 
        :id="props.id" 
        :name="props.name" 
        :required="props.required" 
        :rows="props.multiline" 
        :class="classes"
    ></textarea>
    <input
        v-else 
        :v-model="modelValue"
        :type="props.type" 
        :id="props.id" 
        :name="props.name" 
        :required="props.required" 
        :class="classes"
    />
</template>