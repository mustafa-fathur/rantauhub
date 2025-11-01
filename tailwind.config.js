/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    plugins: [
        require('daisyui'),
    ],
    daisyui: {
        themes: [
            {
                rantauhub: {
                    "primary": "#122937",        // Dark blue/teal - main brand color
                    "primary-content": "#ffffff", // White text on primary
                    "secondary": "#CEA761",       // Gold - accent color for highlights
                    "secondary-content": "#122937", // Dark text on secondary
                    "accent": "#925E25",          // Darker gold - tertiary color
                    "accent-content": "#ffffff",   // White text on accent
                    "neutral": "#3d4451",          // Default neutral
                    "base-100": "#ffffff",        // White background
                    "base-200": "#f2f2f2",        // Light gray background
                    "base-300": "#e5e6e6",        // Medium gray background
                    "base-content": "#1f2937",     // Dark text color
                    "info": "#3abff8",            // Info color
                    "success": "#36d399",         // Success color
                    "warning": "#fbbd23",         // Warning color
                    "error": "#f87272",           // Error color
                },
            },
            "light",
            "dark",
        ],
        base: true, // applies background color and foreground color for root element by default
        styled: true, // include daisyUI colors and design decisions for all components
        utils: true, // adds responsive and modifier utility classes
        prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
        logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
        themeRoot: ":root", // The element that receives theme color CSS variables
    },
};

