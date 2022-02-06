module.exports = {
    extends: [
        'plugin:vue/vue3-recommended',
        'plugin:vue/recommended'
    ],
    rules: {
        'vue/no-unused-vars': 'error',
        "vue/script-indent": ["error", 4, {"baseIndent": 1}],
        "vue/html-indent": ["error", 4, {"baseIndent": 1}]
    }
}