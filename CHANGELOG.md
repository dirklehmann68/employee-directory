# Changelog

All notable changes to Employee Directory for TYPO3 are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).

## [1.4.0] - 2026-11-21

### Added

- Added an optional setting to hide department headings in the department-grouped LIST view.
- Employees are displayed in one continuous card grid while preserving the configured department order.

### Changed

- Updated German and English plugin configuration labels and descriptions for the new setting.

### Upgrade notes

- Clear the TYPO3 caches after updating.
- No database schema changes are required.

## [1.3.0] - 2026-11-18

### Added

- Optional department descriptions in the department-grouped LIST view, displayed either as a subline or as a paragraph.
- Optional links to further department information, with a keyboard-accessible link and a translated accessible label.
- Support for TYPO3's employee record publication start and end fields (`starttime` and `endtime`).
- Support for employee record access restrictions based on frontend user groups (`fe_group`).

### Changed

- Updated standalone and Bootstrap stylesheets to accommodate department information and links, including hover and keyboard focus states.
- Updated German and English documentation and interface labels for the new features.

### Upgrade notes

- Synchronize the database schema after updating to add the new department and employee fields.
- Clear the TYPO3 and PHP caches after updating.
- Frontend user group selection is available in employee records when frontend user groups exist in TYPO3.

## [1.2.1] - 2026-11-13

### Fixed

- Corrected the employee card image layout below 576 px in standalone mode by making the card columns full width on small screens.
- Bootstrap styling remains unchanged.

## [1.2.0] - 2026-11-11

### Added

- Configurable department ordering in the department-grouped LIST view. Selected departments appear first in the configured order, followed by remaining departments alphabetically. Employees without a department remain last.

### Changed

- Improved German and English descriptions of plugin configuration options.

### Fixed

- Improved alignment of the detail buttons at the bottom of employee cards in standalone mode.

### Upgrade notes

- Clear the TYPO3 and PHP caches to rebuild the dependency injection container when updating from an earlier version. An outdated container may cause an error involving `DepartmentItemsProvider`.

## [1.1.0]

### Added

- Optional department grouping for the employee list, with alphabetical department ordering and a separate final group for employees without a department.
- Dedicated Display tab in the plugin settings for switching between standard and department-grouped views.

## [1.0.1]

### Fixed

- Removed the Bootstrap `bg-light` class from employee cards to avoid overriding their intended background styling.
- Added vertical spacing to the Bootstrap filter row using `gy-3`.

## [1.0.0]

### Added

- Initial release of Employee Directory for TYPO3 14.3.

<!-- Historical entries are reconstructed from project documentation and development records. -->

[1.4.0]: https://github.com/dirklehmann68/employee-directory/releases/tag/v1.4.0
[1.3.0]: https://github.com/dirklehmann68/employee-directory/releases/tag/v1.3.0
[1.2.1]: https://github.com/dirklehmann68/employee-directory/releases/tag/v1.2.1
[1.2.0]: https://github.com/dirklehmann68/employee-directory/releases/tag/v1.2.0
[1.1.0]: https://github.com/dirklehmann68/employee-directory/releases/tag/v1.1.0
[1.0.1]: https://github.com/dirklehmann68/employee-directory/releases/tag/v1.0.1
[1.0.0]: https://github.com/dirklehmann68/employee-directory/releases/tag/v1.0.0
