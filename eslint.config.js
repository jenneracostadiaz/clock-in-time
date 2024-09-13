import globals from 'globals';
import pluginJs from '@eslint/js';
import tseslint from 'typescript-eslint';
import eslintConfigPrettier from 'eslint-config-prettier';
import pluginTailwind from 'eslint-plugin-tailwindcss';

export default [
    { files: ['**/*.{js,mjs,cjs,ts}'] },
    { languageOptions: { globals: globals.browser } },
    pluginJs.configs.recommended,
    ...tseslint.configs.recommended,
    {
        name: 'tailwindcss/rules',
        plugins: {
            tailwindcss: pluginTailwind,
        },
        rules: {
            'tailwindcss/no-custom-classname': 'off',
        },
    },
    eslintConfigPrettier,
];
