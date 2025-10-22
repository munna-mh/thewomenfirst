# The Women First — WordPress Theme

This repository contains a WordPress theme called "The Women First". It's a minimal theme with the following files:

- `front-page.php` — Front page template
- `header.php` — Header template
- `index.php` — Main index
- `single.php` — Single post template
- `functions.php` — Theme functions and setup
- `style.css` — Theme stylesheet
- `assets/` — Static assets (CSS/JS)

How to use

1. Copy this folder into your WordPress `wp-content/themes/` directory.
2. Activate the theme in the WordPress admin under Appearance → Themes.

License

This project is available under the MIT License — see `LICENSE`.

Developer / Maintainer notes

- Installation (local WordPress):
	1. Copy this folder into your WordPress `wp-content/themes/` directory or use a symlink for development.
	2. Activate the theme in the WordPress admin under Appearance → Themes.
 3. For CLI-based deployment or testing, WP-CLI can be used (https://wp-cli.org/).

- Development

	- PHP: This theme targets PHP 7.4+ / 8.x. Use a local PHP environment (Valet, Docker, WSL, XAMPP).
	- Assets: `assets/custom.css` and `assets/script.js` are included as examples. You can add a build step if needed.

- Contributing

	Please read `CONTRIBUTING.md` for contribution guidelines. Open issues for bugs or feature requests and send PRs against `main`.

Contact

If you need to reach me about this repo, open an issue or contact the owner on GitHub: https://github.com/munna-mh
