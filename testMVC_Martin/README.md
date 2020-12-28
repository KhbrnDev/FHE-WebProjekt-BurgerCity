# Der Notenspiegel

Es ist an der Zeit, das erlernte Wissen korrekt anzuwenden. In dieser Aufgabe sollen Sie ihren Notenspiegel erweitern. Aktuell ist Ihr Notenspiegel noch sehr einfach. Zwar macht dieser alles, was man grundlegend benötigt, jedoch fehlt die Sicherheit für die Einsicht (alles ist öffentlich), darüber hinaus kann nur ein Nutzer seine Noten hinterlegen. Vor allem auch die Speicherform als CSV ist nicht unbedingt die Beste.

Es wird Ihnen ein Projekt bereitgestellt, welches eine einfache MVC Struktur mitbringt. Im Ordner `models` befinden sich alle Klassen, die die Datenbankobjekte repräsentieren. Im Ordner `views` sind alle Ansichten zu speichern, die durch die Controller im Ordner `controllers` geladen werden.

## Umgang mit dem MVC

In der `index.php` sehen Sie den Aufbau für ein einfaches MVC. Sie sehen den Umgang mit den Controllern und der möglichen Navigation über Query-Parameter im Projekt. Der Query-Parameter `c` repräsentiert den Controller, welcher genutzt werden soll. Und `a` repräsentiert die Aktion, also die Seite, die aufgerufen wird. Durch die Angabe des Controllers und der Aktion, erfolgt automatisch einladen der dazugehörigen Sichten. Der `views` Ordner unterteilt sich somit in Unterordner (diese entsprechen den Namen der Controller) und innerhalb dieser befinden sich die Dateien der Sichten (die Namen der Aktion).

Sie können beliebig viele Controller sowie Views anlegen. Jede View muss im Controller immer mit dem Wort `action` beginnen. Außerdem müssen alle Controller im Dateinamen dem Schema `<name>Controller.php` folgen. Und die Klasse muss sich im Namespace `dwp\controller` befinden und nach folgendem Schema aufgebaut sein `<name>Controller`. Achten Sie außerdem darauf, dass jeder Controller von Ihnen vom Haupt-Controller `\dwp\core\Controller` erbt. Dieser stellt mehrere Funktionen für den Renderprozess (Ausgabe der View) bereit. Eine dieser Funktion ist `$this->setParam('key','value')` mithilfe dieser Funktion können Sie innerhalb der Methode der Action die Variablen an die View-Datei übermitteln.

### Beispiel für das Anlegen einer neuen Seite

Um eine neue Seite anzulegen, benötigen wir zunächst einen Controller, wir können hier auf den bestehenden Controller `pages` zurückgreifen oder einen neuen Controller anlegen. Jeder Controller kann mehrere Seiten (action's) verwalten. Es ist geschickt nicht alles in einem Controller zu hinterlegen, da dieser sonst zu groß wird und die Wartbarkeit des Projektes sinkt.

In unserem Beispiel wollen wir für die Module einen eigenen Controller schaffen, damit wir diese dort Anzeigen können. Hierfür müssen wir mehrere Dinge anlegen, zunächst natürlich den Controller `modules`. Diesen legen wir im Order `controllers` an und nennen die PHP-Datei `modulesController.php`. Der Code denn wir in dieser PHP-Datei benötigen ist eine einfache Klasse `ModulesController` die vom Core-Controller erben muss.

```
// controllers/modulesController.php
namespace dwp\controller;

class ModulesController extends \dwp\core\Controller
{
}

```

Damit wir letztendlich eine Seite bekommen, die zum Beispiel alle unsere Module anzeigt, brauchen wir eine `action`. Diese nenne wir, einfach mal `showAll`. Das heißt, wir legen nun in unserem Controller eine öffentliche Methode mit dem Namen `actionShowAll()` an. Mittels der Controller-Methode `$this->setParam('key', 'value')` können wir dem Renderprozess sagen, welche Variablen später in unserer View vorhanden sein sollen. Für das Beispiel hier, wollen wir eine Variable `$helloWorld` mit dem Inhalt `Hello World!` in die View übergeben.

```
// controllers/modulesController.php
namespace dwp\controller;

class ModulesController extends \dwp\core\Controller
{
	public function actionShowAll()
	{
		$this->setParam('hello', 'Hello World!');
	}
}

```

Nun benötigen wir neben dem Controller, wo sich unsere Geschäftslogik befindet, natürlich auch noch die Anzeige. Dies nennen wir View, daher befindet sich, wie oben bereits beschrieben, diese Datei im Ordner `views`. Dort legen wir zunächst, wenn nicht bereits vorhanden, den Ordner `modules` für den Controller an. Anschließend generieren wir dort unsere View-Datei `showAll.php` die genau wie die Action heißt. Dort geben wir unsere übergebene Variable einfach als H1-Überschrift aus.

```
<!-- controllers/modulesController.php -->
<div class="modules-show-all">
	<h1><?=$hello?>
</div>
```

Um diese Seite nun im Browser sichtbar zu machen, navigieren wir mittels der Query-Parameter auf den Controller mit der Action `showAll`.

```
http://localhost/index.php?c=modules&a=showAll
```

Mit diesem Prinzip, haben wir eine saubere Trennung zwischen Geschäftslogik und Anzeigelogik und können beliebig viele Views und Controller implementieren.

## Umgang mit Nutzerpasswörtern

Nutzer die sich an Ihrer Plattform anmelden, benötigen für den Zugang einen Nutzername und ein Passwort. Dies sind extrem sensible Daten und daher ist es geschickt, das Passwort nicht im Klartext in der Datenbank abzulegen. Mittels der PHP Funktion `password_hash('geheimespasswort', PASSWORD_DEFAULT);` wird aus dem Passwort ein Hash generiert, welches Sie ohne Bedenken in der Datenbank speichern können. Um später Passwörter beim Login mit dem aus der Datenbank vergleichen zu können, benötigen Sie die Funktion `password_verify('geheimespasswort', 'passworthash')`.

## Datenbank

Das Datenbankmodel und die dazugehörigen Dumps befinden sich im Ordner `src/database`. Nutzen Sie diese Datenbank für Ihr Projekt. Der Demo-Nutzer `student` hat das Passwort `12345678`.

## Aufgabe

Entwickeln Sie alle Klassenmodelle für die vorgegebene Datenbank, welche sich im Ordner `src/database` befindet. Achten Sie genau auf die Datenfelder, jedes der einzelnen Datenfelder muss vorhanden sein. Nutzen Sie eine Superklasse die für jede Subklasse, die SQL-Statements Insert, Select, Update und Delete generiert, nutzen Sie dafür ein dynamisches Konzept (Submodels definieren nur das Schema und ggf. Validierungsfunktionen).

Binden Sie das Login und die Registrierung an die Datenbank an und sorgen Sie dafür, dass mittels Sessions der Login für Laufzeit des Browsers gewährt wird. Vergessen Sie aber nicht, einen “Logout” zu ermöglichen. Ermöglichen Sie, mittels Registrierung allen Nutzern das Anlegen eines eigenen Accounts.

Angemeldete Nutzer können aus den hinterlegten Modulen auswählen und neue Noten für definierte Prüfungen hinterlegen. Diese werden wie gewohnt in einer Liste ausgegeben und können gefiltert und sortiert werden.

**Hinweis:**

Durchsuchen Sie das Projekt nach `TODO:` diese geben Anmerkungen zu mögliche Entwicklungsschritten/notwendigen Erweiterungen.

### Zusatzaufgabe 1

Legen Sie einen `ErrorsController` an, welcher die Seiten für 404 bereitstellt. Es soll immer auf diesen Controller und dessen Aktion verwiesen werden, wenn eine Seite versucht wird aufzurufen, die nicht vorhanden ist.

### Zusatzaufgabe 2

Erweitern Sie die Seite so, dass es möglich ist, für alle Nutzer neue Module anzulegen. Jeder Nutzer sieht alle Module und kann diese ändern und (de-)aktivieren. Wichtig ist, einmal angelegte Module, die schon mit Prüfungen verknüpft sind, können nicht mehr gelöscht werden. Es soll möglich sein, nach aktiven sowie inaktiven Modulen filtern zu können.

### Zusatzaufgabe 3

Erweitern Sie das System so, dass neben den Modulen auch die Fakultät und der Studiengang erfasst werden kann. Erweitern Sie hierfür logisch die Datenbank und setzen Sie die entsprechenden Masken zum Verwalten um.

### Zusatzaufgabe 4

Erweitern Sie die Nutzer um eine Berechtigungsbitmaske, über die Sie entscheiden können, welche Nutzer zur Verwaltung von Modulen, Studiengängen und Fakultäten berechtigt sind.
