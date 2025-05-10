# Travelling Cooks Theme

[![Release](https://img.shields.io/badge/release-v1.0.0-blue)](https://github.com/fgaletic/travelling-cooks-theme/releases)
[![License](https://img.shields.io/badge/License-MIT-blue)](#license)

Travelling Cooks Theme is a custom WordPress theme based on [TailPress](https://tailpress.io/), a minimal boilerplate theme that uses [Tailwind CSS](https://tailwindcss.com/). This theme has been tailored specifically for the Travelling Cooks project, with additional features and customizations.

## Getting Started

### Installation

To use this theme, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/fgaletic/travelling-cooks-theme.git
   cd travelling-cooks-theme
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development environment:
   ```bash
   npm run watch
   ```

4. Before deploying to production, build the assets:
   ```bash
   npm run production
   ```

### General Information

- Editable CSS and JavaScript files are located in the `/resources` folder.
- The theme uses Tailwind CSS for styling and supports block editor styles via `editor-style.css`.
- Customizations specific to the Travelling Cooks project can be found in the `theme.json` and `tailwind.config.js` files.

## NPM Scripts

| Script     | Description                                                                    |
|------------|--------------------------------------------------------------------------------|
| production | Creates a production (minified) build of app.js, app.css, and editor-style.css. |
| dev        | Creates a development build of app.js, app.css, and editor-style.css.           |
| watch      | Runs several watch scripts concurrently.                                       |

## Customizations

### Block Editor Styling

The block editor styling has been customized to match the front-end design of the Travelling Cooks website. You can find these styles in `editor-style.css`.

### Tailwind CSS Configuration

The `tailwind.config.js` file has been updated to include custom colors, fonts, and other design elements specific to the Travelling Cooks project.

### Theme Settings

The `theme.json` file contains predefined settings for colors, typography, and layout. These settings can be adjusted to meet the project's requirements.

## Links

* [Tailwind CSS Documentation](https://tailwindcss.com/docs)
* [Laravel Mix Documentation](https://laravel-mix.com)
* [Esbuild Documentation](https://esbuild.github.io)

## Contributors

* [Your Name](https://github.com/your-profile)
* [All contributors](https://github.com/your-repo/travelling-cooks-theme/graphs/contributors)

## License

This theme is licensed under the MIT License. Please see the [License File](/LICENSE) for more information.
