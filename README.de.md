# Mitarbeiterverzeichnis für TYPO3

[English](README.md) | [Deutsch](README.de.md)

Eine TYPO3-Extension zur Verwaltung von Mitarbeiterprofilen und zur Darstellung eines durchsuchbaren und filterbaren Mitarbeiterverzeichnisses.

> **Projektstand (22.10.2026):** Der Quellcode ist öffentlich auf [GitHub](https://github.com/dirklehmann68/employee-directory). Die kombinierten sowie getrennten LIST-/SHOW-Plugins wurden in einer bestehenden TYPO3-Installation einschließlich sprechender URLs praktisch getestet. Ein vollständiger Neuinstallationstest mit Composer, eine Packagist-/TER-Veröffentlichung und ein offizieller Release-Tag stehen noch aus.

## Funktionen

- Mitarbeiterdatensätze mit Anrede/Titel, Vorname, Nachname, Bild, Telefon, E-Mail, Raum, Standort, Sprechzeiten und Beschreibung mit Rich-Text-Editor.
- Eigene Datensätze für Abteilungen und Funktionen, die Mitarbeitern zugeordnet werden können.
- Drei Plugin-Varianten: kombiniertes Mitarbeiterverzeichnis (LIST + SHOW), eigenständige Mitarbeiterliste (LIST) und eigenständige Detailansicht (SHOW).
- Mitarbeiterübersicht mit Profilkarten und individuellen Detailansichten.
- Suche nach Nachnamen, Filter nach Abteilung und Funktion sowie alphabetischer A–Z-Filter für Nachnamen.
- In den Auswahllisten erscheinen nur Abteilungen und Funktionen, die Mitarbeiterdatensätzen zugeordnet sind.
- Deutsche und englische Oberflächenbeschriftungen; zusätzlich ist eine plattdeutsche Übersetzung enthalten.
- Integration über ein TYPO3 Site Set mit mitgeliefertem CSS.

## Systemvoraussetzungen

- TYPO3 **ab 14.3 und unterhalb von 15.0** (entsprechend den Composer-Versionsbedingungen).
- Eine zur TYPO3-Installation passende PHP- und Datenbankversion.
- TYPO3 Core, Extbase und Fluid (`typo3/cms-core`, `typo3/cms-extbase`, `typo3/cms-fluid`).
- Eine eingerichtete TYPO3-Website mit Site-Konfiguration, Dateispeicher und funktionierender Bildverarbeitung.

## Installation

### Installation mit Composer (vorgesehener Installationsweg)

Der Composer-Paketname lautet `dirk-lehmann/employee-directory`, der TYPO3-Extension-Key `employee_directory`.

**Für die lokale Entwicklungsfassung** kann das Verzeichnis als Composer-Path-Repository in der `composer.json` des **TYPO3-Hauptprojekts** eingetragen werden. Den Pfad bitte an die eigene Verzeichnisstruktur anpassen:

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

Anschließend im Hauptverzeichnis des TYPO3-Projekts ausführen:

```bash
composer require dirk-lehmann/employee-directory:@dev
```

`@dev` ist **nur ein Beispiel für unseren lokalen Entwicklungsstand**, keine Empfehlung für eine produktive Veröffentlichung. Sobald eine Version über ein Composer-Repository veröffentlicht wurde, sollte die veröffentlichte Versionsnummer verwendet werden. **Eine Veröffentlichung und Verfügbarkeit über Packagist sind derzeit nicht bestätigt.**

Nach der Installation den Datenbank-/Schema-Abgleich über die vorgesehenen TYPO3-Werkzeuge durchführen. Die Installation des Pakets allein garantiert nicht, dass alle benötigten Tabellen bereits eingerichtet sind.

### Installation ohne Composer (Classic Mode) – ZIP-Upload erfolgreich getestet

**Getestete Umgebung:** TYPO3 14.3.7, klassische Installation ohne Composer auf ALL-INKL, Extension `employee_directory` Version 1.0.0 (14.10.2026).

1. Eine ZIP-Datei erstellen, in der `composer.json`, `Classes/`, `Configuration/` und `Resources/` **direkt auf der obersten Archivebene** liegen – nicht innerhalb eines zusätzlichen Ordners `employee_directory/`.
2. Im TYPO3-Backend unter **System → Einstellungen → Extension Configuration → extensionmanager** die Option **„Install extensions automatically after download from TER or file upload“** (`automaticInstallation`) bei Bedarf deaktivieren und die Einstellung speichern.
3. Im Modul **System → Extension** über **„Erweiterung hochladen“** die Datei `employee_directory.zip` auswählen und hochladen.
4. Die Erfolgsmeldung und den Eintrag **Employee Directory** (`employee_directory`, Version 1.0.0) in der Extension-Liste prüfen.
5. Die Extension über die Spalte **A/D** manuell aktivieren. Anschließend die Einrichtung und gegebenenfalls den Datenbank-/Schema-Abgleich prüfen.

**Beobachtung in dieser Testumgebung:** Mit `automaticInstallation = 1` scheiterte der ZIP-Upload sowohl bei `employee_directory` als auch bei der offiziellen Extension `container` mit der Meldung `Extension … is not available`; anschließend war `typo3conf/ext/` wieder leer. Nach Deaktivierung der automatischen Installation wurden beide ZIP-Dateien erfolgreich hochgeladen und in der Extension-Liste angezeigt. Die manuell aktivierte `employee_directory` lieferte wieder zwei bestehende Mitarbeiter-Cards im Frontend.


Auch die manuelle Installation per FTP wurde erfolgreich getestet. Der ZIP-Upload ist damit praktisch getestet; eine Installation aus dem **TYPO3 Extension Repository (TER)** wurde noch nicht getestet. Eine TER-Veröffentlichung ist nicht bestätigt.

## Einrichtung in TYPO3

1. Extension installieren und aktivieren.
2. Das Site Set der Extension (`dirk-lehmann/employee-directory`) in die Set-Abhängigkeiten der betreffenden Website aufnehmen. Das Set bindet auch das CSS der Extension ein.
3. Eine Seite oder einen Sysfolder als Ablage für Mitarbeiter-, Abteilungs- und Funktionsdatensätze anlegen.
4. Zuerst Abteilungen und Funktionen erstellen, anschließend Mitarbeiterdatensätze anlegen und die Zuordnungen vornehmen.
5. Auf einer Frontend-Seite das kombinierte Plugin **Mitarbeiterverzeichnis** einfügen oder die eigenständigen Plugins **Mitarbeiterliste** und **Mitarbeiterdetail** auf getrennten Seiten verwenden.
6. In den Plugin-Einstellungen die Datensatzablage auswählen. Auch die zugeordneten Abteilungen und Funktionen müssen für die Repository-Abfragen erreichbar sein.
7. Bei getrennten LIST-/SHOW-Plugins in den **Site-Set-Einstellungen** unter der Kategorie für Seitenverknüpfungen **detailPageUid** (Seite mit dem eigenständigen Detail-Plugin) und **listPageUid** (Seite mit dem eigenständigen Listen-Plugin) konfigurieren. Beide Werte stehen standardmäßig auf `0` und müssen für die Navigation zwischen getrennten Seiten auf die jeweiligen Seiten-IDs gesetzt werden. Die Einstellungen befinden sich nicht in der FlexForm des Listen-Plugins.
8. Bei Bedarf Caches leeren und die Frontend-Ausgabe kontrollieren.

Das Site Set importiert `Configuration/TypoScript/setup.typoscript`. Im Hauptverzeichnis der Extension liegt keine Demo-`setup.typoscript` mehr.

## Sprechende URLs (Route Enhancer)

TYPO3 erzeugt ohne passende Routing-Konfiguration für Detailansichten gegebenenfalls URLs mit Extbase-Query-Parametern. Für lesbare Mitarbeiter-URLs kann in der **Site-Konfiguration der jeweiligen Website** (`config/sites/<site-identifier>/config.yaml`, je nach Projektstruktur) ein Route Enhancer eingerichtet werden. **Die Extension installiert diese Konfiguration nicht automatisch.**

Das folgende vollständige Beispiel enthält zwei Varianten: einen Route Enhancer für das kombinierte Plugin auf Seite **3** und einen zweiten für das eigenständige Detail-Plugin auf Seite **5**. **Diese Seiten-IDs sind Beispiele und müssen an die eigene Installation angepasst werden.** Wer nur das kombinierte Plugin verwendet, benötigt nur den ersten Enhancer.

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

**Wichtige Hinweise:**

- `limitToPages` begrenzt jeden Enhancer auf die tatsächlich zugehörige Plugin-Seite. Ohne diese Begrenzung können sich die beiden Enhancer gegenseitig beeinflussen; im Praxistest führte das bei der getrennten Detailseite zu einer fehlenden `employee`-Action-Argument-Zuordnung.
- `routeFieldName: slug` verweist auf das Slug-Feld des Mitarbeiterdatensatzes. Das Feld muss für den jeweiligen Datensatz korrekt befüllt sein.
- Für getrennte LIST-/SHOW-Plugins müssen zusätzlich `detailPageUid` und `listPageUid` in den **Site-Set-Einstellungen** auf die jeweiligen Seiten zeigen.
- **Mehrere TYPO3-Sites:** In unserem Test konnten Mitarbeiter aus einer Datensatzablage unterhalb einer anderen Site über den konfigurierten Extbase-Ausgangspunkt gelistet werden, während die Slug-Auflösung des `PersistedAliasMapper` zu 404 führte. Ein Mitarbeiter in einer Datensatzablage innerhalb des Demo-Site-Baums ließ sich dagegen per Slug aufrufen. Dies ist eine Beobachtung aus unserer Installation, kein allgemeiner Nachweis über sämtliche TYPO3-Konfigurationen. Prüfe bei 404 daher auch die Site-Zugehörigkeit und den Speicherort der Datensätze.
- Jede TYPO3-Site benötigt ihre eigene passende Site-Konfiguration und die richtigen `limitToPages`-Werte. Nach Änderungen gegebenenfalls TYPO3-Caches leeren.

## Bedienung

Besucher können Mitarbeiter nach Nachnamen suchen sowie nach Funktion, Abteilung und Anfangsbuchstaben des Nachnamens filtern. Über eine Profilkarte gelangt man zur Detailansicht. Der aktuelle Link **„Zurück zur Übersicht“** führt zur ungefilterten Liste. Die Rückkehr unter Beibehaltung der Filter ist für eine spätere Version vorgesehen.

Mit dem Schalter **„Datensatz verbergen“** lässt sich die Anzeige eines Mitarbeiters im Frontend unterbinden. Getrennte LIST- und SHOW-Plugins sind in Version 1.0.0 implementiert und wurden im bisherigen Praxisbetrieb ohne festgestellte Probleme verwendet; Grenzfälle und vollständige Neuinstallationstests stehen noch aus.

Der **„Mehr“**-Button erscheint in der Liste nur bei Mitarbeitern mit einer Beschreibung. Im eigenständigen Listen-Plugin führt er zur konfigurierten Detailseite; der **„Zurück zur Übersicht“**-Button der eigenständigen Detailansicht führt zur konfigurierten Listenseite.

## Sprachen

Die Oberflächenbeschriftungen liegen auf Deutsch und Englisch vor; zusätzlich gibt es eine plattdeutsche Frontend-Übersetzung. **Die Fachdatensätze selbst sind bislang nicht für den TYPO3-Übersetzungsworkflow eingerichtet.** Eine übersetzte Bedienoberfläche bedeutet also nicht automatisch übersetzte Mitarbeiter-, Abteilungs- oder Funktionsdatensätze.

## Bekannte Einschränkungen

- Der A–Z-Filter bezieht sich auf Nachnamen. Die Suche nach Umlauten kann von der Datenbank-Kollation abhängen.
- Eine Seitennavigation (Pagination) für umfangreiche Verzeichnisse ist noch nicht vorhanden.
- Mehrere unabhängig filterbare Plugin-Instanzen auf derselben Seite sind noch nicht getestet.
- Ein Route Enhancer für sprechende URLs wird nicht automatisch mitgeliefert; ein vollständiges Konfigurationsbeispiel steht oben.
- Die Rücknavigation zur Liste erhält gesetzte Filter noch nicht.
- Die getrennten LIST-/SHOW-Plugins wurden bereits praktisch verwendet; Direktlinks auf verborgene/gelöschte Datensätze, fehlende Zielseiten-IDs, mehrere Instanzen und Cache-Grenzfälle sind noch gesondert zu prüfen.
- Der ZIP-Upload und die manuelle Aktivierung im Classic Mode wurden in einer separaten TYPO3-14.3.7-Installation erfolgreich getestet; eine vollständige Erstinstallation mit neu angelegten Datensätzen und alle Funktionstests stehen noch aus.

## Fehlerbehebung

| Problem | Prüfen |
| --- | --- |
| ZIP-Upload meldet `Extension employee_directory is not available` | In der getesteten TYPO3-14.3.7-Classic-Installation half es, unter Extension Configuration → extensionmanager `automaticInstallation` zu deaktivieren, die ZIP-Datei erneut hochzuladen und die Extension anschließend manuell zu aktivieren. Kein allgemeiner Nachweis für andere Installationen. |
| Slug-URL führt zu 404 | `limitToPages`, Slug-Feld, Site-Konfiguration und Site-Zugehörigkeit der Datensätze kontrollieren. |
| Keine Mitarbeiter sichtbar | Datensatzablage im Plugin, Sichtbarkeit der Datensätze und Speicherort. |
| Abteilung oder Funktion fehlt im Filter | Existenz, Erreichbarkeit und Zuordnung zu sichtbaren Mitarbeitern. |
| Darstellung ohne CSS | Ist das Site Set in der Website-Konfiguration eingebunden? |
| Bilder fehlen | Dateireferenzen, Zugriffsrechte und TYPO3-Bildverarbeitung. |
| Richtext wird unerwartet dargestellt | Rich-Text-Editor und wirksame TypoScript-Konfiguration. |
| Filter gehen beim Wechsel zurück zur Übersicht verloren | Bekannte Einschränkung; Verbesserung für eine spätere Version geplant. |

## Checkliste vor der Veröffentlichung

- [ ] Installation in einem **unabhängigen TYPO3-14.3+-Composer-Projekt** durchführen.
- [ ] Composer-Abhängigkeiten und Datenbankschema prüfen.
- [ ] Site Set und CSS ohne Demo-TypoScript testen.
- [ ] Neue Abteilungen, Funktionen und Mitarbeiter in einer eigenen Datensatzablage anlegen.
- [ ] Liste, Detailansicht, Bilder, Richtext und sämtliche Filter bei aktiviertem Seiten-Cache prüfen.
- [x] Getrennte LIST- und SHOW-Plugins im bisherigen Praxisbetrieb ohne festgestellte Probleme verwendet (kein vollständiger Abnahmetest).
- [ ] Hin- und Rückverlinkung getrennter Plugins, Direktaufrufe, fehlende Seiten-IDs, Zugriff auf verborgene/gelöschte Mitarbeiter, mehrere Instanzen und Cache-Grenzfälle testen.
- [ ] Sichtbarkeit von Datensätzen und deutsche/englische Bedienoberfläche prüfen.
- [x] ZIP-Upload und manuelle Aktivierung im Classic Mode unter TYPO3 14.3.7 erfolgreich testen (14.10.2026).
- [ ] Vollständige Erstinstallation im Classic Mode einschließlich Schema-Abgleich, neuer Datensätze und aller Funktionen testen.
- [ ] Geprüfte Screenshots und Veröffentlichungsangaben ergänzen.

## Screenshots (werden ergänzt)

Sinnvolle Abbildungen: Datensatzablage mit Datensatztypen; Bearbeitungsformular eines Mitarbeiters; Plugin-Einstellungen mit Datensatzablage; Frontend-Liste mit Filtern; Mitarbeiter-Detailansicht.

## Lizenz

GPL-2.0-or-later (laut `composer.json`).
