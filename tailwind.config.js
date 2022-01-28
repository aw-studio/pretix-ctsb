const plugin = require('tailwindcss/plugin');

module.exports = {
    // mode: 'jit',
    purge: ['./resources/**/*.vue', './resources/views/**/*.php'],
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
                100: 'var(--primary-100)',
                200: 'var(--primary-200)',
                300: 'var(--primary-300)',
                400: 'var(--primary-400)',
                500: 'var(--primary-500)',
                600: 'var(--primary-600)',
                DEFAULT: 'var(--primary-DEFAULT)',
            },
            gray: {
                500: '#c6c8d5',
                600: '#676767',
                DEFAULT: '#c6c8d5',
            },
            green: {
                500: 'var(--success-500)',
                DEFAULT: 'var(--success-DEFAULT)',
            },
            red: {
                500: 'var(--danger-500)',
                DEFAULT: 'var(--danger-DEFAULT)',
            },
            orange: {
                500: 'var(--secondary-500)',
                DEFAULT: 'var(--secondary-DEFAULT)',
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
