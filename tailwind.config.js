/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}"],
  theme: {
    boxShadow: {
      bottom: "0 2px 4px rgba(0,0,0,.08), 0 4px 12px rgba(0,0,0,.08)",
    },
    extend: {
      colors: {
        "primary-color": "#FFFFFF",
        "second-color": "#393E46",
        "button-color": "#62CDFF",
        "text-color": "#252525",
        "gray-color": "#D3D3D3",
      },
      fontFamily: {
        body: ["Lato"],
      },
      fontSize: {
        xs: '0.75rem',
      },
    },
  },
  plugins: [],
};

// if you write in extends that means you add more style in tailwind but if outside extend you overide the style in tailwind
