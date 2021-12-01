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
            xs: '4px',
            sm: '6px',
            md: '15px',
            lg: '19px',
            full: '9999px',
        },
        colors: {
            white: 'white',
            black: 'black',
            blue: {
                100: '#ecf4ff',
                200: '#d2d9f5',
                300: '#6098ff',
                400: '#5732a3',
                500: '#4444af',
                600: '#232378',
                DEFAULT: '#4444af',
            },
            gray: {
                500: '#c6c8d5',
                DEFAULT: '#c6c8d5',
            },
            green: {
                500: '#03D079',
                DEFAULT: '#03D079',
            },
            red: {
                500: '#FF3265',
                DEFAULT: '#FF3265',
            },
            orange: {
                500: '#fba200',
                DEFAULT: '#fba200',
            },
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
        fontSize: {
            xs: ['10px', '17px'],
            sm: ['14px', '21px'],
            base: ['15px', '24px'],
            lg: ['16px', '24px'],
            xl: ['31px', '33px'],
        },
        boxShadow: {
            top: '0px -7px 10px 0px rgba(0,0,0,0.11)',
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
