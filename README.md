# Recettes
Petit exercice : un thème WordPress qui présente des recettes de cuisine
## Comment installer le projet
1. Cloner ce repo en local dans htdocs :
``git clone https://github.com/smeric/Recettes``
2. Créer un virtual host dans ``xamp\apache\conf\extra\httpd-vhosts.conf`` (si vous utilisez xampp) :
```
<VirtualHost *:80>
    DocumentRoot "chemin/vers/xampp/htdocs/Recettes/"
    ServerName recettes.local
</VirtualHost>
```
Redémarrer apache.

3. Modifier le fichier ``hosts`` (pour Windows il se trouve dans ``C:\Windows\System32\drivers\etc``) en ajoutant la correspondance entre le domaine et l'IP locale : ``127.0.0.1 recettes.local``
4. Importer la base de données (non incluse dans ce repo) depuis phpMyAdmin. Le fichier créera la base ``recettes`` et y placera toutes les tables avec leur contenu.
5. Modifier ``wp-config.php`` avec les bonnes infos si votre config n'est pas la même que la mienne ;) :
```
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'recettes' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );
```

6. Lancez WordPress : ``http://recettes.local/wp-admin`` (utilisateur : admin, mdp : wordpress)

8. Activez le thème Marmiton

Et voilà :)
## Éléments utilisés
J'ai utilisé **ACF Pro** pour les custom fields, notamment pour les répéteurs qui ne sont pas dans la version gratuite, et j’ai également créé un bloc pour Gutenberg, fonctionnalité qui ne doit pas non plus se trouver dans la version gratuite, si ma mémoire est bonne… Le bloc est initialisé ici ``/wp-content/themes/marmiton/includes/acf.php`` et son template est là : ``/wp-content/themes/marmiton/bloc-templates/liste-recettes.php``

J’ai utilisé **Loco Translate** pour traduire les thèmes, mais je ne l’ai pas joint car il n’est pas nécessaire.

J’ai aussi utiliser **Custom Post Type UI** pour générer le code du CPT et des CT, mais idem, il n’est pas joint car le code se retrouve dans le thème : ``/wp-content/themes/marmiton/includes/cpt.php``. 

J’ai fait un thème parent et un thème enfant. Le premier est très générique et peut être une bonne base pour n’importe quel petit projet.
## Remarques
Les ingrédients sont sous forme d’une CT à laquelle j’ai ajouté un champ images avec ACF. C’était plus pratique que de les réécrire pour chaque recette. Il y a aussi une CT ‘Type’ pour indiquer plat, dessert, soupe… mais je ne m’en suis pas servi et elle n'apparaît pas en front.

J’ai imaginé un design, mais j’avoue que ce n’est pas ma spécialité :) J’espère qu’il vous plaira.
## Evolutions possibles
Le site est super simple. On peut tout envisager ! Peut-être dans un 1er temps, utiliser la CT ‘Type’ et le faire figurer sur la recette. Réaliser des filtres par type et par ingrédients, par exemple. Ajouter les commentaires pour que les internautes puissent donner leur avis sur les recettes. La fonctionnalité est déjà prévue dans le thème parent mais il faudrait styler tout ça. Ajouter les pages statiques classiques (contact, qui sommes-nous, politique de confidentialité…), et mettre en place un menu (qui n’existe pas pour le moment). Il faudrait également rendre le site conforme RGPD. Associer un compte Google, mettre en place l’inscription à la newsletter… Bref, il y aurait toutes sortes de choses à ajouter !
