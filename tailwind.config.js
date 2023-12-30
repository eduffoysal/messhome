module.exports = {
  content: ["**/*.{php,html}","./layouts/**/*.html", "./content/**/*.md", "./content/**/*.html", "./src/**/*.js", "./node_modules/flowbite/**/*.js", "./node_modules/tw-elements/dist/js/**/*.js"],
  // theme: {
  //   extend: {},
  // },
  // plugins: [],

  safelist: [
    'w-64',
    'w-1/2',
    'rounded-l-lg',
    'rounded-r-lg',
    'bg-gray-200',
    'grid-cols-4',
    'grid-cols-7',
    'h-6',
    'leading-6',
    'h-9',
    'leading-9',
    'shadow-lg'
  ],

  // presets: [
  //   require('@acmecorp/base-tailwind-config')
  // ],

  // enable dark mode via class strategy
  darkMode: 'class',

  theme: {
    extend: {
      // extend base Tailwind CSS utility classes
    }
  },
  plugins: [
    // include Flowbite as a plugin in your Tailwind CSS project
    require('flowbite/plugin'),
    require('tw-elements/dist/plugin')
  ]


}
