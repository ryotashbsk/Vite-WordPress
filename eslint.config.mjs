import js from '@eslint/js';
import eslintConfigPrettier from 'eslint-config-prettier';
import importPlugin from 'eslint-plugin-import';
import unuserdPlugin from 'eslint-plugin-unused-imports';
import globals from 'globals';

export default [
  js.configs.recommended,
  eslintConfigPrettier,
  {
    files: ['**/*.js'],
    languageOptions: {
      globals: {
        ...globals.browser,
        ...globals.es2022,
        ...globals.node
      }
    },
    plugins: {
      'import': importPlugin,
      'unused-imports': unuserdPlugin
    },
    rules: {
      'import/order': [
        'error',
        {
          'groups': ['builtin', 'external', 'internal', ['parent', 'sibling'], 'object', 'type', 'index'],
          'newlines-between': 'always',
          'pathGroupsExcludedImportTypes': ['builtin'],
          'alphabetize': {
            order: 'asc',
            caseInsensitive: true
          }
        }
      ],
      'no-duplicate-imports': ['error', { includeExports: true }],
      'no-nested-ternary': 'off',
      'no-console': 'off',
      'no-unused-expressions': 'error',
      'no-unused-expressions': ['error', { allowTernary: true }],
      'no-var': 'error',
      'prefer-const': 'error',
      'eqeqeq': ['error', 'always', { null: 'ignore' }],
      'unused-imports/no-unused-imports': 'warn',
      'unused-imports/no-unused-vars': 'off'
    }
  },
  {
    ignores: ['dist', 'node_modules', 'src/env.d.ts', '**/*.mjs']
  }
];
