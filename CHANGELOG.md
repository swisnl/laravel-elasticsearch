# Changelog

All notable changes to `swisnl/laravel-elasticsearch` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](https://keepachangelog.com/) principles.

## NEXT - YYYY-MM-DD

### Added
- Nothing

### Changed
- Nothing

### Deprecated
- Nothing

### Removed
- Nothing

### Fixed
- Nothing

### Security
- Nothing

## 0.6.0 - 2026-02-17

### Added

- You can specify the job classes in the config. This allows you to use your own custom job classes, for example if you want to use a different queue connection or queue name, add middleware, etc.

### Changed

- The `\Swis\Laravel\Elasticsearch\Contracts\IndexableInterface` contract now includes an `unindex()` method. This method is included in the default `\Swis\Laravel\Elasticsearch\Concerns\SyncsWithIndex` concern, so you don't need to implement it yourself.

## 0.5.0 - 2025-02-25

### Added

- Added support for Laravel 12

## 0.4.0 - 2024-03-27

### Added

- Added support for Laravel 11

## 0.3.0 - 2024-02-23

### Changed

- Use static as return type

## 0.2.0 - 2023-11-17

### Added

- Added support for Basic Authentication
