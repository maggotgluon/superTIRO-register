const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets:[
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],

    theme: {
        extend: {
            colors:{
                'content-dark':'#585958',
                'gray-light':'#F7F7F7',
                'gray-dark':'#C8C8C8',
                'primary-blue':'#36737A',
                'primary-lite':'#E9EFF6',
                'secondary-red':'#9F1236', 
                'gradient-start':'#789866',
                'gradient-end':'#367379',
            },
            fontFamily: {
                sans: ['Prompt','Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
