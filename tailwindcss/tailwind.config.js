/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["../views/*.php"],
  theme: {
    extend: {
      colors: {
        sexyred: "#D7472C",
        "sexyred-dark": "#812B1A",
        "sexyred-light": "rgba(215, 71, 44, 0.75)",
        "hot-noir": "#121212",
        "50-shades": "#212121",
        "mr-grey": "#2C2C2C",
        "soft-white": "#D0D0D0",
        "transparent-50": "rgba(0, 0, 0, 0.5)",
      },
    },
  },
  plugins: [],
  darkMode: "class",
};
