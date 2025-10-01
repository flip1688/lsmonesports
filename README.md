# LSM Sports WordPress Theme

A modern, responsive WordPress theme built with TailwindCSS and PostCSS.

## Features

- **Modern Design**: Clean, professional design perfect for sports websites
- **TailwindCSS Integration**: Utility-first CSS framework for rapid development
- **PostCSS Processing**: Automated CSS processing and optimization
- **Responsive Layout**: Mobile-first design that works on all devices
- **Customizer Options**: Extensive theme customization options
- **Block Editor Support**: Full Gutenberg block editor compatibility
- **SEO Optimized**: Clean, semantic HTML structure
- **Performance Focused**: Optimized for speed and performance
- **Accessibility Ready**: WCAG compliant and screen reader friendly

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Node.js 14 or higher
- npm or yarn

## Installation

1. **Upload the theme** to your WordPress themes directory (`/wp-content/themes/`)

2. **Install dependencies** by running the following commands in the theme directory:
   ```bash
   npm install
   ```

3. **Build the CSS** files:
   ```bash
   npm run build:all
   ```

4. **Activate the theme** in your WordPress admin panel under Appearance > Themes

## Development

### Available Scripts

- `npm run build` - Build production CSS
- `npm run build:css` - Build main stylesheet
- `npm run build:editor` - Build editor stylesheet
- `npm run build:all` - Build both main and editor stylesheets
- `npm run watch` - Watch for changes and rebuild CSS automatically
- `npm run watch:css` - Watch main stylesheet
- `npm run watch:editor` - Watch editor stylesheet
- `npm run dev` - Watch both stylesheets simultaneously

### Development Workflow

1. **Start the development server**:
   ```bash
   npm run dev
   ```

2. **Make changes** to your CSS in `src/css/style.css` or `src/css/editor-style.css`

3. **The CSS will automatically rebuild** when you save changes

### File Structure

```
lsmonsports/
├── dist/                   # Compiled CSS files
│   └── css/
│       ├── style.css       # Main compiled stylesheet
│       └── editor-style.css # Editor compiled stylesheet
├── src/                    # Source files
│   └── css/
│       ├── style.css       # Main source stylesheet
│       └── editor-style.css # Editor source stylesheet
├── inc/                    # Theme includes
│   ├── customizer.php      # Theme customizer options
│   ├── template-functions.php # Template functions
│   └── template-tags.php   # Template tags
├── js/                     # JavaScript files
│   └── navigation.js       # Navigation and interactive features
├── style.css               # Theme information and fallback styles
├── index.php               # Main template file
├── single.php              # Single post template
├── footer.php              # Footer template
├── sidebar.php             # Sidebar template
├── functions.php           # Theme functions
├── package.json            # Node.js dependencies
├── tailwind.config.js      # TailwindCSS configuration
├── postcss.config.js       # PostCSS configuration
└── README.md               # This file
```

## Customization

### Theme Options

The theme includes several customization options available in the WordPress Customizer:

- **Colors**: Primary and secondary color schemes
- **Typography**: Font selection for body and headings
- **Layout**: Container width and blog layout options
- **Social Media**: Social media links for footer
- **Header**: Header style options

### TailwindCSS Customization

You can customize the design by:

1. **Modifying `tailwind.config.js`** to add custom colors, fonts, or spacing
2. **Editing `src/css/style.css`** to add custom components or utilities
3. **Running the build process** to compile your changes

### Adding Custom Styles

Add custom styles in the `@layer components` or `@layer utilities` sections in `src/css/style.css`:

```css
@layer components {
  .my-custom-button {
    @apply px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600;
  }
}
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This theme is licensed under the GPL v2 or later.

## Support

For support and documentation, please visit [your support URL].

## Changelog

### Version 1.0.0
- Initial release
- TailwindCSS integration
- PostCSS processing
- Responsive design
- Customizer options
- Block editor support
