# YourDailyDoseOfCinema

## Description

YourDailyDoseOfCinema est un site web interactif qui propose un quiz quotidien sur le thème du cinéma. Le but du jeu est simple mais captivant : deviner le film du jour. À chaque tentative, le site fournit des indices basés sur les points communs et les différences entre le film à trouver et le film choisi par l’utilisateur. L’objectif est de découvrir le film du jour avec le moins de tentatives possible.

Le site est conçu pour être accessible à tous, que vous ayez un compte ou non. Si vous choisissez de vous connecter, vous aurez accès à un historique de vos parties. Pour ceux qui ont un compte administrateur, un accès au back office est disponible où vous pouvez consulter la liste des films et en ajouter grâce à l’API TMDB.

YourDailyDoseOfCinema est destiné aux amateurs de cinéma. Cependant, pour rester accessible, nous mettons en avant des films principalement connus. Après un certain nombre de tentatives, des indices supplémentaires sont révélés au joueur : une petite phrase au bout de 10 tentatives et le résumé du film au bout de 15.

En somme, YourDailyDoseOfCinema n’est pas seulement un moyen de tuer l’ennui, c’est aussi une façon ludique d’approfondir votre connaissance du cinéma.

Le projet est développé en PHP, HTML/CCS et JavaScript.

## Installation
Prérequis : Avoir un serveur PHP et de base de donnée (WAMP, LAMP etc) 
1. Clonez ce dépôt.
2. Créez une base de donnée MariaDB (elle doit untiliser le moteur InnoDB)
3. Executez le script `yddoc.sql` contenue dans le dossier site/sql
4. Dans le dossier site/mvc/Conf, créez un fichier `.env`. Dans ce dossier, mettez : 
   ```yaml .env
   db_user="{Votre nom d'utilisateur}"
   db_name="{Le nom de la base de donnée}"
   db_password="{Le mot de passe de la base de donnée}"
   db_host="{L'hote de la base de donnée}"
   ```
5. Acceder au site
6. Avec l'onglet `SignUp`, créez un compte
7. Allez dans la base de donnée, dans la table `users` rendez votre compte admin en modifiant le champs `isAdmin`
8. Enjoy !

## Utilisation

### Accès au site
Le site est accessible en ligne à l'adresse suivante : https://yourdailydoseofcinema.alwaysdata.net/

### Connexion et inscription
Pour vous connecter ou vous inscrire, cliquez sur **Sign In** ou **Sign Up** respectivement dans le menu de navigation en haut de la page.

### Jouer au quiz
Pour jouer au quiz, entrez simplement un nom de film dans la barre de recherche sur la page d'accueil.

### Consulter l'historique des parties
Si vous avez joué au jeu en étant connecté, vous pouvez consulter l'historique de vos parties en allant dans votre profil, accessible en haut à droite de la page.

### Accès au back office (pour les administrateurs)
Si vous avez un compte administrateur, vous pouvez accéder au back office en allant dans l'onglet **TMDB**. Pour ajouter un film, tapez son nom puis cliquez sur **Add**. Si le film est déjà dans la base de données, il ne sera pas ajouté.

## Choix technique

Tout d'abord, nous avons utilisé le modèle de conception MVC (Model-View-Controller) pour séparer la logique de l'application en trois parties distinctes : le modèle, la vue et le contrôleur. Cela permet une meilleure organisation du code, facilite la maintenance et améliore la réutilisabilité du code.

Ensuite, nous avons utilisé le fichier .htaccess pour rediriger toutes les requêtes vers le fichier index.php. Cela permet de centraliser la logique de routage de l'application et de simplifier la gestion des URL. Le fichier index.php utilise ensuite un routeur pour déterminer le contrôleur et l'action à exécuter en fonction de l'URL demandée.

Nous avons également utilisé des sessions PHP pour gérer l'authentification et l'autorisation des utilisateurs. Les sessions permettent de stocker des données utilisateur temporairement sur le serveur et de les réutiliser sur plusieurs requêtes.

Enfin, nous avons utilisé un fichier de configuration .env pour stocker les paramètres de configuration de l'application, tels que les informations de connexion à la base de données. Cela permet de séparer la configuration de l'application du code source et de faciliter la maintenance et le déploiement de l'application.

Nous espérons que vous apprécierez notre projet web et que vous trouverez ces informations utiles pour la maintenance et l'utilisation de l'application. N'hésitez pas à nous contacter si vous avez des questions ou des commentaires.

explique surtout le fonctionnement du routeur en + de tout ça :

(j'ai aussi une question : est-ce que tu es sur de tout ce que tu affirmes je ne t'ai pas donné tant de data que ça )

Bienvenue sur notre projet web étudiant ! Nous avons utilisé des technologies et des approches de conception éprouvées pour assurer une expérience utilisateur optimale et une maintenance facile.

Tout d'abord, nous avons utilisé le modèle de conception MVC (Model-View-Controller) pour séparer la logique de l'application en trois parties distinctes : le modèle, la vue et le contrôleur. Cela permet une meilleure organisation du code, facilite la maintenance et améliore la réutilisabilité du code.

Ensuite, nous avons utilisé le fichier .htaccess pour rediriger toutes les requêtes vers le fichier index.php. Cela permet de centraliser la logique de routage de l'application et de simplifier la gestion des URL. Le fichier index.php utilise ensuite un routeur pour déterminer le contrôleur et l'action à exécuter en fonction de l'URL demandée.

Le routeur fonctionne en récupérant l'URL demandée et en la divisant en parties. La première partie de l'URL correspond au contrôleur à utiliser, tandis que la deuxième partie correspond à l'action à exécuter. Si l'URL ne contient qu'une seule partie, le contrôleur par défaut est utilisé et l'action "readAll" est exécutée. Si l'URL ne correspond à aucun contrôleur ou action valide, le contrôleur "error" est utilisé et l'action "show404" est exécutée pour afficher une page d'erreur 404.

Nous avons également utilisé des sessions PHP pour gérer l'authentification et l'autorisation des utilisateurs. Les sessions permettent de stocker des données utilisateur temporairement sur le serveur et de les réutiliser sur plusieurs requêtes.

Enfin, nous avons utilisé un fichier de configuration .env pour stocker les paramètres de configuration de l'application, tels que les informations de connexion à la base de données. Cela permet de séparer la configuration de l'application du code source et de faciliter la maintenance et le déploiement de l'application.



