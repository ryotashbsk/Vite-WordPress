export default {
  plugins: [
    'stylelint-declaration-block-no-ignored-properties', //
    'stylelint-plugin-logical-css'
  ],
  extends: [
    'stylelint-config-standard', //
    'stylelint-config-recommended-scss',
    'stylelint-config-recess-order',
    'stylelint-config-html',
    'stylelint-scss'
  ],
  rules: {
    'plugin/declaration-block-no-ignored-properties': true,
    'selector-pseudo-class-no-unknown': null,
    'selector-class-pattern': null,
    'media-query-no-invalid': null,
    'no-descending-specificity': null,
    'import-notation': null,
    'custom-property-empty-line-before': null,
    'custom-property-pattern': null,
    'plugin/use-logical-properties-and-values': [
      true,
      {
        severity: 'warning',
        ignore: ['overflow-y', 'overflow-x']
      }
    ]
  }
};
