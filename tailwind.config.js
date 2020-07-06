module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/View/Components/*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter, sans-serif'],
                display: ['Rubik', 'sans-serif'],
            },
            colors: {
                red: {
                    '100': '#FFF2F4',
                    '200': '#FFC7D0',
                    '300': '#4A5568',
                    '400': '#F9587C',
                    '500': '#EE215A',
                    '600': '#D90E4C',
                    '700': '#BB0646',
                    '800': '#960441',
                    '900': '#6E0636',
                },
                blue: {
                    '100': '#F5FBFF',
                    '200': '#C7E6FA',
                    '300': '#9BD4F5',
                    '400': '#58B9E9',
                    '500': '#24A3D6',
                    '600': '#0190BC',
                    '700': '#047A9F',
                    '800': '#095F79',
                    '900': '#0B3F4F',
                },
            },
        },
    },
    variants: {
        textColor: ['responsive', 'hover', 'focus', 'active', 'group-hover']
    },
    plugins: [require('@tailwindcss/custom-forms')],
};
