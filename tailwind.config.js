/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
            primary: {
                100: "#E9F2FF",
                500: "#0C66E4",
                600: "#084EC4",
                700: "#063AA4",
                800: "#032984",
                900: "#021C6D",
            },
            success: "#2CCF6F",
            danger: "#C10C0C",
            secondary: "#281284",
            layer: "#F6F9FC",
            f9: "#F9F9F9",
            blueShadow: "#CED7E6",
        }
    },
  },
  plugins: [],
}