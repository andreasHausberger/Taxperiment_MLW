# Welcome, Researcher

Diese Seite fungiert als Blog für das Projekt Taxperiment_MLW. Hier schreibe ich Gedanken, Ankündigungen usw. hinein, die die Taxperiment-Projekte betreffen.    

*Disclaimer*: This blog will be predominately in German. If you are interested in this project, let me know: 

* [Mail](mailto:hausbergerandreas1@gmail.com)
* [Github](https://github.com/andreasHausberger)
* [Twitter](https://twitter.com/andreasHausb)

## Die Zukunft von Mouselab

Die Zukunft des Taxperiment-Projekts

In den kommenden Tagen wird die dritte Erhebung mit der Taxperiment-Plattform durchgeführt werden. Für eine Software, die ursprünglich sehr speziell für ein Steuerverhaltens-Entscheidungsexperiment programmiert wurde, ist das eine sehr positive Bilanz. Ich möchte mich hier bei euch für euer Interesse bedanken - ich habe bei diesen Projekten sehr viel dazugelernt. Auch aus persönlicher Sicht war und ist es für mich spannend, meine beiden Studien Psychologie und Informatik auf so eine spannende Weise miteinander zu verknüpfen. 

Die Adaptierung und Durchführung in größerem Maßstab ist jedoch nicht ohne Probleme abgelaufen. Viele Lösungen, die ich ursprünglich als "gut genug" empfunden habe, stellten sich als problematisch heraus, sobald sie in größerem Maßstab eingesetzt wurden. Ich habe mir vorgenommen, aus Fehlern zu lernen, und grundlegende Teile der Applikation neu zu gestalten. 

Mit einigen Teilen bin ich schon sehr zufrieden, jedoch gibt es noch genug Teile der Applikation, wo die oben erwähnten fehleranfälligen Lösungen noch merkbar sind. 

In diesem Artikel möchte ich einige Gedanken niederschreiben, wie es mit dem Projekt weitergehen könnte. 



**Mouselab und Mouse Tracking**

Jeder, der mich gefragt hat, weiß, dass ich kein Fan von Mouselab bin. Das Framework ist enorm konfus geschrieben, sehr schwieirg zu editieren, und eine generelle Quelle der Unsicherheit in der Applikation. Insbesondere die datalyzer.php-Datei ist ein Paradebeispiel für Spaghetti-Code (Code, der so unübersichtlich ist wie eine Schüssel Spaghetti). 

Ich möchte daher in den Raum stellen, dass langfristig eine bessere Alternative zu finden ist. Die Funktionialität, Boxen aufzudecken und deren Mouseover-Zeit zu speichern, ist nicht so komplex. Eine schwierigere Frage ist die der Daten-Aufbereitung. Hier würde ich mich über euren Input freuen: 

	⁃	Ist das Format der Mouselab-Daten für euch optimal? Gibt es hier weitere Abhängigkeiten in der Datenverarbeitung (zB fertige Skripte zur statistischen Analyse?)

	⁃	Wenn nein, was könnte man hier verbessern?

	⁃	Wären generelle Mousetracking-Daten für euch spannend (zB Heatmap, Scrollmap)?



**Daten editieren**

Die Experiment-Daten waren den Forschern bisher noch nicht offen zugänglich. Das ist insofern problematisch, da Änderungen aussschließlich über SQL-Anfragen in der Datenbank passieren mussten. Eine einfachere Art, Experiment-Daten zu ändern, Runden hinzuzufügen oder wegzunehmen ist somit wünschenswert. 



**Visuelles Redesign**

Taxperiment sieht, wenn man positive Formulierungen sucht, sehr zweckmäßig aus. Ich würde gerne die visuellen Aspekte neu überdenken. 

	⁃	 Weg mit der grauen Hintergrundfarbe? Farb-Akzente sind super, aber ich empfinde das Grau als geradezu "aggressiv langweilig". 

	⁃	 Einheitliche Design-Sprache: 

	⁃	 Font: Hier würde ich einen modernen Sans-Serif-Font vorschlagen

	⁃	Farben: Einheitliche Farben, die mit Bedeutung verbunden sind

	⁃	Icons: Einheitliche Icons, die Abläufe klarer kennzeichnen sollten. 

	⁃	Vereinheitlichung von Fehlermeldungen, Notifications, etc.

	⁃	Sinnvolle, dynamische Anpassungen an verschiedene Display-Größen: Implementierung des Bootstrap-Frameworks. 

	⁃	Researcher-Menü: Hier wäre eine sinnvolle Ordnung (zB mit einer Navigations-Leiste) der einzelnen Links sinnvoll. 

