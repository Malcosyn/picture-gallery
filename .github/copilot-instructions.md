# Copilot instructions for this CodeIgniter4 app

This repository is a CodeIgniter 4 application (see [README.md](README.md)). The goal of these instructions is to help an AI coding agent be immediately productive by pointing to project-specific conventions, workflows, and examples.

High-level facts
- Framework: CodeIgniter 4 (PSR-4 autoloading: `App\\` -> `app/`). See `composer.json`.
- PHP: requires PHP ^8.2.
- App layout: main code in `app/`, public entry in `public/index.php`, writable in `writable/`, vendor in `vendor/`.

Where to look first
- Controllers: `app/Controllers/` (e.g. `BaseController.php`, `Home.php`).
- Models: `app/Models/` (e.g. `UserModel.php`). Models usually extend `CodeIgniter\\Model`.
- Views: `app/Views/` (rendered by controllers).
- Config: `app/Config/` (site settings, routing, services). See `app/Config/App.php` for baseURL and environment assumptions.
- Database migrations: `app/Database/Migrations/` (schema changes). Example: `2026-02-11-135059_CreateComment.php` defines `comments` table.
- Public entry: `public/index.php` — webserver should point here.

Common developer workflows (commands you may need to run)
- Install deps: `composer install`.
- Copy env: `cp env .env` and edit `.env` (database, baseURL).
- Serve locally: `php spark serve` (CodeIgniter CLI).
- Make models/controllers/migrations: `php spark make:model|controller|migration` (examples already in use: `php spark make:model UserModel`).
- Run migrations: `php spark migrate`.
- Run tests: `composer test` or `vendor/bin/phpunit` (phpunit configured in `composer.json`).

Project-specific conventions and examples
- Migrations live under `app/Database/Migrations` and use CodeIgniter `Migration` class. Example migration fields use `INT`, `VARCHAR`, `TEXT`, `DATETIME` and add foreign keys (`$this->forge->addForeignKey(...)`). Follow that style when adding migrations.
- Controllers often call views from `app/Views/` and use `BaseController` for shared behavior.
- Models are PSR-4 namespaced under `App\\Models` and are autoloaded by Composer. Use `$table`, `$primaryKey`, `$allowedFields` consistent with existing models.
- Configs are the authoritative source for environment settings; prefer editing `.env` for instance-specific changes and `app/Config/*.php` for code-level defaults.

Testing and CI hints
- Tests live under `tests/` and use PHPUnit 10 (see `composer.json` require-dev). Run `composer test` to execute the suite.
- Many test helpers live in `tests/_support` and are autoloaded via `autoload-dev` in `composer.json`.

Integration points & external deps
- The only declared dependency is `codeigniter4/framework` (and dev dependencies). External integrations (DB, mail, etc.) are configured via `.env` and `app/Config/*`.

What not to change without confirmation
- Do not move `public/index.php` out of `public/` or change the `indexPage` config without checking webserver setup in `.env`/`app/Config/App.php`.
- Avoid altering PSR-4 mappings in `composer.json` unless you update all namespaces accordingly.

When opening a pull request or making edits
- Add migration files to `app/Database/Migrations/` rather than running raw SQL.
- Keep `app/` changes backward compatible where possible; framework upgrades are tracked in README.
- Run `composer test` locally before pushing.

Examples to reference in this repo
- Migration example: `app/Database/Migrations/2026-02-11-135059_CreateComment.php` (adds `comments` table, foreign keys to `photos` and `users`).
- Config entrypoint: `app/Config/App.php` (baseURL, indexPage, CSP settings).
- Model generator example: `php spark make:model UserModel` (used in development).

If anything here is unclear or you want the agent to follow additional conventions, ask and we will iterate.
