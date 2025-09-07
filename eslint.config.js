import pluginVue from 'eslint-plugin-vue';

export default [
    ...pluginVue.configs['flat/essential'], ...pluginVue.configs['flat/recommended'], 
    {
        ignores: ['vendor', 'node_modules', 'public', 'tailwind.config.js'],
    },
    {
        rules: {
            "vue/html-indent": ["error", ("tab")],
            'vue/multi-word-component-names': 'off',
            'vue/no-unused-vars': 'error',
            "vue/script-indent": ["error", ("tab")],
        },
        languageOptions: {
            sourceType: 'module'
        }
    }
]