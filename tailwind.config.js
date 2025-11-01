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
                    "primary": "hsl(204, 52%, 15%)",        // Dark blue/teal - main brand color (#122937)
                    "primary-content": "hsl(0, 0%, 100%)", // White text on primary
                    "secondary": "hsl(38, 51%, 59%)",       // Gold - accent color for highlights (#CEA761)
                    "secondary-content": "hsl(204, 52%, 15%)", // Dark blue text on secondary
                    "accent": "hsl(28, 60%, 36%)",          // Darker gold - tertiary color (#925E25)
                    "accent-content": "hsl(0, 0%, 100%)",   // White text on accent
                    "neutral": "hsl(220, 14%, 28%)",          // Default neutral (#3d4451)
                    "base-100": "hsl(0, 0%, 100%)",        // White background
                    "base-200": "hsl(0, 0%, 95%)",        // Light gray background
                    "base-300": "hsl(0, 0%, 90%)",        // Medium gray background
                    "base-content": "hsl(220, 13%, 18%)",     // Dark text color
                    "info": "hsl(199, 89%, 48%)",            // Info color
                    "success": "hsl(142, 76%, 36%)",         // Success color
                    "warning": "hsl(43, 96%, 56%)",         // Warning color
                    "error": "hsl(0, 91%, 71%)",           // Error color
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
        darkTheme: "dark", // name of one of the included themes for dark mode
        defaultTheme: "rantauhub", // name of default theme
    },
};

