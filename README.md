# Employee Directory for TYPO3

[English](README.md) | [Deutsch](README.de.md)

A TYPO3 extension for maintaining employee profiles and displaying a searchable, filterable employee directory.

> **Release status:** Documentation draft for version **1.0.0**. On **14 October 2026**, the extension was successfully uploaded as a ZIP, manually activated, and checked with two existing employee cards in a separate **TYPO3 14.3.7 Classic Mode** installation (ALL-INKL, without Composer). A complete clean-install test with newly created records and full functional acceptance testing are still pending. Publication on TER or Packagist has not been confirmed.

## Features

- Employee records with title, first name, last name, photo, phone, email, room, location, office hours and rich-text description.
- Separate department and job-function records, assignable to employees.
- Three plugin variants: combined employee directory (LIST + SHOW), standalone employee list (LIST), and standalone employee detail view (SHOW).
- Employee overview with profile cards and individual detail pages.
- Search by last name, filters for department and job function, and an A–Z last-name filter.
- Filter options for departments and job functions are restricted to values currently used by employee records.
- German and English frontend labels; an additional Low German translation is included.
- Site Set integration and bundled CSS.

## Requirements

- TYPO3 **14.3 or later, but below 15.0** (according to the extension's Composer constraints).
- PHP and database versions supported by your TYPO3 installation.
- TYPO3 Core, Extbase and Fluid (`typo3/cms-core`, `typo3/cms-extbase`, `typo3/cms-fluid`).
- A functioning TYPO3 site with an appropriate site configuration, file storage and image processing.

## Installation

### Composer installation (intended installation method)

The extension package is named `dirk-lehmann/employee-directory` and its extension key is `employee_directory`.

**For a local source checkout**, add the directory as a Composer path repository in the **root project's** `composer.json` (adapt the path to your environment):

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "./packages/employee_directory",
      "options": { "symlink": true }
    }
  ]
}
```

Then run from the TYPO3 project root:

```bash
composer require dirk-lehmann/employee-directory:@dev
```

The `@dev` constraint is **only an example for the current local development checkout**, not a recommended production release constraint. Once a tagged release is published through a Composer repository, use its published version and normal installation instructions instead. **Publication and Packagist availability are not yet confirmed.**

After installing, run the TYPO3 database/schema update appropriate for your environment, for example using the TYPO3 backend maintenance tools. Do not assume that adding the package alone creates all required database tables.

### Classic Mode (without Composer) — ZIP upload tested successfully

**Test environment:** TYPO3 14.3.7, Classic Mode installation without Composer on ALL-INKL, `employee_directory` version 1.0.0 (14 October 2026).

1. Create a ZIP archive with `composer.json`, `Classes/`, `Configuration/`, and `Resources/` **at the archive root**, not nested inside an additional `employee_directory/` directory.
2. In the TYPO3 backend, open **System → Settings → Extension Configuration → extensionmanager**. If necessary, disable **“Install extensions automatically after download from TER or file upload”** (`automaticInstallation`) and save.
3. In **System → Extension**, use **Upload Extension** to upload `employee_directory.zip`.
4. Confirm the successful upload and the **Employee Directory** entry (`employee_directory`, version 1.0.0) in the extension list.
5. Activate the extension manually using the **A/D** column. Then verify configuration and perform the database/schema update if required.

**Observed in this test environment:** With `automaticInstallation = 1`, uploading either `employee_directory` or the official `container` extension failed with `Extension … is not available`; `typo3conf/ext/` was empty afterwards. After disabling automatic installation, both ZIP uploads succeeded and the extensions appeared in the list. Once manually activated, `employee_directory` again rendered two existing employee cards in the frontend.


Manual installation via FTP was also tested successfully. The ZIP upload workflow has been tested. Installation from the **TYPO3 Extension Repository (TER)** has not been tested, and TER publication is not confirmed.

## Configuration in TYPO3

1. Install and activate the extension in your TYPO3 installation.
2. Add the extension's Site Set (`dirk-lehmann/employee-directory`) to the relevant site's set dependencies, using the TYPO3 site configuration UI. The set provides the extension's TypoScript integration, including its stylesheet.
3. Create a page or sysfolder to hold the employee, department and job-function records.
4. Create department and job-function records, then create employee records and assign the appropriate relations.
5. Add the combined **Employee Directory** plugin to a frontend page, or use the standalone **Employee List** and **Employee Detail** plugins on separate pages.
6. In the plugin's record-storage setting, select the page/sysfolder containing the relevant records. Ensure related records are accessible to the repository queries as well.
7. If using the separate LIST and SHOW plugins, configure **detailPageUid** (page containing the standalone detail plugin) and **listPageUid** (page containing the standalone list plugin) in the extension's **Site Set settings** under the page-linking category. Both default to `0` and must be set to the appropriate page IDs for separate-page navigation. These settings are not fields in the list plugin's FlexForm.
8. Clear caches if needed and check the frontend output.

The Site Set imports `Configuration/TypoScript/setup.typoscript`. There is no demo `setup.typoscript` at the extension root.

## Using the directory

Visitors can filter employees by last name, job function, department and first letter of the last name. Selecting a profile opens its detail view. The current implementation's **“Back to overview”** link returns to the unfiltered overview; preserving the previous filter state is planned for a later release.

The employee record's **hidden** toggle controls whether the record is displayed in the frontend. Separate LIST and SHOW plugins are implemented in 1.0.0 and have been used successfully in initial practical tests; edge cases and fresh-install acceptance testing are still pending.

In the list template, the **More** button is shown only for employees with a description. With the standalone list plugin, it links to the configured detail page; the standalone detail plugin's **Back to overview** button links to the configured list page.

## Language support

Interface labels are available in English and German, with an additional Low German frontend translation. **Record content is not yet configured for TYPO3's per-record translation workflow**; translated UI labels should not be confused with translated employee, department or job-function data.

## Known limitations

- The A–Z filter is based on last names. Matching umlauts can depend on the database collation.
- The directory has no pagination in the current version.
- Multiple independently filtered instances on the same page have not been validated.
- No Route Enhancer for readable employee-detail URLs is shipped by default.
- Back-navigation does not preserve active list filters.
- Standalone LIST/SHOW plugins have passed initial practical use, but direct-link access to hidden/deleted records, unset target page IDs, multiple instances, and caching edge cases still require validation.
- ZIP upload and manual activation were successful in a separate TYPO3 14.3.7 Classic Mode installation; a full clean-install test with new records and complete functional acceptance tests are still pending.

## Troubleshooting

| Symptom | What to check |
| --- | --- |
| ZIP upload reports `Extension employee_directory is not available` | In the tested TYPO3 14.3.7 Classic Mode setup, disabling `automaticInstallation` under Extension Configuration → extensionmanager, re-uploading the ZIP, and activating manually resolved the issue. This is not a universal diagnosis for other installations. |
| No employee records appear | Plugin record-storage page, record visibility, and whether the records are stored in the expected location. |
| Department or job-function filter is empty | Whether corresponding records exist, are accessible, and are assigned to visible employees. |
| Styles are missing | Whether the extension Site Set is included in the site's set dependencies. |
| Images are missing | File references, file storage permissions and TYPO3 image processing. |
| Rich text is not displayed as expected | Rich-text editor availability and the active TypoScript rendering configuration. |
| Detail view loses the current filters | Known limitation; improvement planned for a later release. |

## Release acceptance checklist

- [ ] Install in an **independent TYPO3 14.3+ Composer project**.
- [ ] Confirm dependency resolution and database schema setup.
- [ ] Confirm Site Set integration and CSS without demo TypoScript.
- [ ] Create departments, job functions and employee records in a new storage folder.
- [ ] Test employee list, detail view, images, rich text and all filters with page caching enabled.
- [x] Initial practical use of standalone LIST and SHOW plugins without observed issues (not a complete acceptance test).
- [ ] Validate standalone LIST/SHOW links in both directions, direct detail URLs, missing page-ID configuration, hidden/deleted employee access, multiple instances and caching.
- [ ] Test record visibility and the German/English interface.
- [x] Verify ZIP upload and manual activation in TYPO3 14.3.7 Classic Mode (14 October 2026).
- [ ] Perform a complete clean-install acceptance test in Classic Mode, including schema setup, new records, and all features.
- [ ] Add verified screenshots and release metadata before publication.

## Screenshots (to be added)

Suggested screenshots: record-storage folder and record types; employee edit form; plugin configuration and storage selection; frontend list with filters; employee detail view.

## License

GPL-2.0-or-later (as declared in `composer.json`).
