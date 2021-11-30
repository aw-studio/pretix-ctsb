const plugin = require('tailwindcss/plugin');

module.exports = {
    // mode: 'jit',
    variants: {
        extend: {
            backgroundColor: ['active'],
            textColor: ['active'],
        },
    },
    theme: {
        container: {
            center: true,
        },
        borderRadius: {
            xs: '6px',
            sm: '11px',
            md: '15px',
            lg: '19px',
            full: '9999px',
        },
        colors: {
            white: 'white',
            black: 'black',
            blue: {
                300: '#ecf5ff',
                400: '#4a89fd',
                500: '#3177f1',
                DEFAULT: '#3177f1',
            },
            gray: {
                500: '#9da7d0',
                DEFAULT: '#9da7d0',
            },
            green: {
                500: '#00d17a',
                DEFAULT: '#78FFBF',
            },
            red: {
                500: '#D4002E',
                DEFAULT: '#FF8A96',
            },
            yellow: {
                500: '#FFCB18',
                DEFAULT: '#FFDC65',
            },
            orange: {
                500: '#fba301',
                DEFAULT: '#fba301',
            },
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
        fontSize: {
            xs: ['10px', '17px'],
            sm: ['12px', '21px'],
            base: ['14px', '24px'],
            lg: ['16px', '24px'],
            xl: ['25px', '33px'],
            '2xl': ['28px', '38px'],
        },
        boxShadow: {
            DEFAULT: '0px 0px 19px 0px rgba(0,0,0,0.08)',
        },
        extend: {
            typography: theme => ({
                DEFAULT: {
                    css: {
                        color: theme('colors.gray.700'),
                        h2: {
                            color: theme('colors.gray.800'),
                        },
                        h3: {
                            color: theme('colors.gray.800'),
                        },
                        strong: {
                            color: theme('colors.gray.800'),
                        },
                        a: {
                            color: theme('colors.green.500'),
                            '&:hover': {
                                color: theme('colors.green.600'),
                            },
                        },
                        ul: {
                            'list-style-type': 'none',
                        },
                    },
                },
            }),
        },
    },
};
