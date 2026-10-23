# Employee Directory for TYPO3

[English](README.md) | [Deutsch](README.de.md)

A TYPO3 extension for maintaining employee profiles and displaying a searchable, filterable employee directory.

> **Project status (23 October 2026):** Source code is publicly available on [GitHub](https://github.com/dirklehmann68/employee-directory). Installation directly from the GitHub VCS repository and functional testing were successful in a fresh TYPO3 14.3.10 Composer/DDEV project. Combined directory functionality, filters, image and display settings, and standalone LIST/SHOW navigation were tested. Packagist/TER publication, an official release tag and remaining edge-case tests are still pending.

## Features

- Employee records with title, first name, last name, photo, phone, email, room, location, office hours and rich-text description.
- Separate department and job-function records, assignable to employees.
- Three plugin variants: combined employee directory (LIST + SHOW), standalone employee list (LIST), and standalone employee detail view (SHOW).
- Employee overview with profile cards and individual detail pages.
- Search by last name, filters for department and job function, and an A–Z last-name filter.
- Filter options for departments and job functions are restricted to values currently used by employee records.
- German and English frontend labels; an additional Low German translation is included.
- Site Set integration with selectable standalone or Bootstrap-oriented CSS.
- Configurable filters, card fields, images, placeholder display and frontend labels.

## Requirements

- TYPO3 **14.3 or later, but below 15.0** (according to the extension's Composer constraints).
- PHP and database versions supported by your TYPO3 installation.
- TYPO3 Core, Extbase and Fluid (`typo3/cms-core`, `typo3/cms-extbase`, `typo3/cms-fluid`).
- A functioning TYPO3 site with an appropriate site configuration, file storage and image processing.

## Installation

### Composer installation (intended installation method)

The extension package is named `dirk-lehmann/employee-directory` and its extension key is `employee_directory`.

**Verified GitHub VCS installation (TYPO3 14.3.10, DDEV, 23 October 2026):** From the TYPO3 project root, register the public Git repository and require the development version:

```bash
composer config repositories.employee-directory vcs https://github.com/dirklehmann68/employee-directory
composer require "dirk-lehmann/employee-directory:@dev"
```

In DDEV, prefix both commands with `ddev`. After installation, run the TYPO3 extension/database setup as appropriate, for example:

```bash
ddev exec vendor/bin/typo3 extension:setup
```

The GitHub VCS approach above was verified in a fresh Composer project. **It does not mean that the package is already available on Packagist.**

**Alternative: local source checkout.** Add the directory as a Composer path repository in the **root project's** `composer.json` (adapt the path to your environment):

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

The `@dev` constraint is for the current development version (both GitHub VCS and local path installations), not a recommended production release constraint. Once a tagged release is published through a Composer repository, use its published version and normal installation instructions instead. **Publication and Packagist availability are not yet confirmed.**

After installing, run the TYPO3 database/schema update appropriate for your environment, using `extension:setup` or the TYPO3 backend maintenance tools. Do not assume that adding the package alone creates all required database tables. In the fresh DDEV test, the schema was subsequently confirmed as up to date.

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

### Plugin variants

| Plugin | Purpose | Page linking |
| --- | --- | --- |
| **Employee directory** | Combined filterable list and detail view | Detail is handled within the combined plugin. |
| **Employee list** | Standalone employee list | Set **Page for employee profiles** (`detailPageUid`) to the page containing **Employee detail**. |
| **Employee detail** | Standalone employee profile | Set **Page for employee list** (`listPageUid`) to the page containing **Employee list**. |

For standalone LIST/SHOW navigation, set **both** page IDs under **Sites → Settings → Employee Directory → Page linking**. In the fresh-install test, leaving the list target at `0` caused the **Back to overview** link to reach an `EmployeeController->show` action without the required `employee` argument. Configuring the correct list page ID resolved the problem; this is a configuration requirement, not evidence that the missing-ID case is handled gracefully.

### Display and filter settings

The following controls were verified in the fresh TYPO3 installation:

- **Sites → Settings → Employee Directory → Filter:** show/hide name search, job-function filter, department filter and A–Z filter. Apply/reset controls disappear when all three form filters are disabled; the A–Z filter is independent.
- **Sites → Settings → Employee Directory → Appearance:** choose **Standalone CSS** or **Bootstrap CSS**. Only the selected stylesheet was loaded in the test.
- **Sites → Settings → Employee Directory:** optional custom frontend labels; empty overrides fall back to translated labels.
- **Content element → Plugin → Card content:** show/hide job function, department, phone, email, location, room and office hours.
- **Content element → Plugin → Images:** show/hide employee photos and the placeholder for missing photos. The placeholder respects the photo visibility setting.

The tested card-content and image visibility switches affect the **LIST** presentation; they do **not** control which fields appear in the **SHOW** detail view. The record-storage starting point must be configured for the list as described above.

## Readable URLs (route enhancers)

Without site-specific routing, detail links may contain Extbase query parameters. Add a route enhancer to **each TYPO3 site's own site configuration** (`config/sites/<site-identifier>/config.yaml`, depending on project layout). **The extension does not install this site-specific configuration automatically.**

The following complete example handles the combined plugin on page **3** and the standalone detail plugin on page **5**. **Replace both example page UIDs with your own.** If you only use the combined plugin, keep only the first enhancer.

```yaml
routeEnhancers:
  EmployeeDirectory:
    type: Extbase
    extension: EmployeeDirectory
    plugin: EmployeeList
    limitToPages:
      - 3  # REPLACE: page UID containing the combined plugin
    routes:
      -
        routePath: '/{employee}'
        _controller: 'Employee::show'
        _arguments:
          employee: employee
    defaultController: 'Employee::list'
    aspects:
      employee:
        type: PersistedAliasMapper
        tableName: tx_employeedirectory_domain_model_employee
        routeFieldName: slug

  EmployeeDirectoryDetail:
    type: Extbase
    extension: EmployeeDirectory
    plugin: EmployeeDetail
    limitToPages:
      - 5  # REPLACE: page UID containing the standalone detail plugin
    routes:
      -
        routePath: '/{employee}'
        _controller: 'Employee::show'
        _arguments:
          employee: employee
    aspects:
      employee:
        type: PersistedAliasMapper
        tableName: tx_employeedirectory_domain_model_employee
        routeFieldName: slug
```

**Important notes:**

- `limitToPages` restricts each enhancer to its corresponding plugin page. Without it, overlapping enhancers caused missing required `employee` action arguments on the standalone detail page in our practical test.
- `routeFieldName: slug` resolves the employee record's slug; ensure that the slug field is populated correctly.
- For separate LIST/SHOW pages, also set `detailPageUid` and `listPageUid` in the **Site Set settings**.
- **Multiple TYPO3 sites:** In our test, Extbase could list employee records stored under another site using the configured record-storage starting point, but `PersistedAliasMapper` returned 404 for their slugs. An employee stored within the demo site's own page tree could be resolved. This is an observation from our setup, not a universal statement about all TYPO3 configurations. Check site ownership and record storage when diagnosing slug-related 404s.
- Each TYPO3 site requires its own route-enhancer configuration and correct page UIDs. Clear TYPO3 caches after changes if necessary.

## Using the directory

Visitors can filter employees by last name, job function, department and first letter of the last name. Selecting a profile opens its detail view. The current implementation's **“Back to overview”** link returns to the unfiltered overview; preserving the previous filter state is planned for a later release.

The employee record's **hidden** toggle controls whether the record is displayed in the frontend. Separate LIST and SHOW plugins were successfully tested with new records in the fresh TYPO3 14.3.10 Composer installation; remaining edge cases are listed below.

In the list template, the **More** button is shown only for employees with a description. With the standalone list plugin, it links to the configured detail page; the standalone detail plugin's **Back to overview** button links to the configured list page.

## Language support

Interface labels are available in English and German, with an additional Low German frontend translation. **Record content is not yet configured for TYPO3's per-record translation workflow**; translated UI labels should not be confused with translated employee, department or job-function data.

## Known limitations

- The A–Z filter is based on last names. Matching umlauts can depend on the database collation.
- The directory has no pagination in the current version.
- Multiple independently filtered instances on the same page have not been validated.
- No route enhancer is installed automatically; see the complete site-configuration example above.
- Back-navigation does not preserve active list filters.
- Standalone LIST/SHOW navigation was verified in both directions on a fresh installation. Direct-link access to hidden/deleted records, unset target page IDs, multiple instances, and caching edge cases still require validation.
- An unset list-page ID can cause a frontend exception when using the standalone detail view’s back link; configure both page IDs.
- ZIP upload and manual activation were successful in a separate TYPO3 14.3.7 Classic Mode installation; a full clean-install test with new records and complete functional acceptance tests are still pending.

## Troubleshooting

| Symptom | What to check |
| --- | --- |
| ZIP upload reports `Extension employee_directory is not available` | In the tested TYPO3 14.3.7 Classic Mode setup, disabling `automaticInstallation` under Extension Configuration → extensionmanager, re-uploading the ZIP, and activating manually resolved the issue. This is not a universal diagnosis for other installations. |
| Slug URL returns 404 | Check `limitToPages`, the slug field, site configuration, and whether employee records belong to the expected site. |
| No employee records appear | Plugin record-storage page, record visibility, and whether the records are stored in the expected location. |
| Department or job-function filter is empty | Whether corresponding records exist, are accessible, and are assigned to visible employees. |
| Styles are missing | Whether the extension Site Set is included in the site's set dependencies. |
| Images are missing | File references, file storage permissions and TYPO3 image processing. |
| Rich text is not displayed as expected | Rich-text editor availability and the active TypoScript rendering configuration. |
| Detail view loses the current filters | Known limitation; improvement planned for a later release. |
| Standalone detail view back link raises `RequiredArgumentMissingException` | Check **Sites → Settings → Employee Directory → Page linking → Page for employee list**. Set it to the actual standalone list page ID; the default `0` is not suitable for this setup. |

## Release acceptance checklist

- [x] Install from the public GitHub VCS repository in an **independent TYPO3 14.3.10 Composer/DDEV project** (23 October 2026).
- [x] Confirm Composer dependency resolution and TYPO3 database schema setup in that project.
- [x] Confirm Site Set integration and standalone/Bootstrap stylesheet selection without demo TypoScript.
- [x] Create a department, job function and employee in a new record-storage folder.
- [x] Test list, detail view, images, placeholder behavior, rich text, search, filters, reset and no-results display in the fresh project.
- [x] Test individual card-content/image switches and Site Set filter/label controls.
- [x] Verify standalone LIST → SHOW → LIST navigation, including repeating the cycle, with both page IDs configured.
- [x] Verify German frontend labels in the fresh installation.
- [x] Verify ZIP upload and manual activation in TYPO3 14.3.7 Classic Mode (14 October 2026).
- [ ] Verify all features with **page caching explicitly enabled** and check caching edge cases.
- [ ] Test direct links to hidden/deleted employee records, missing page-ID configuration and multiple plugin instances.
- [ ] Complete an explicit English-interface test and additional record-visibility cases.
- [ ] Perform a complete clean-install acceptance test in Classic Mode, including schema setup, new records and all features.
- [ ] Add verified screenshots and release metadata before publication.

## Screenshots (to be added)

Suggested screenshots: record-storage folder and record types; employee edit form; plugin configuration and storage selection; frontend list with filters; employee detail view.

## License

GPL-2.0-or-later (as declared in `composer.json`).
