# ***Dashboard***

## **Introduction**
Bienvenue au projet dashboard. Ce projet de 3ème année à EPITECH consiste à créer un site internet
 permettant de regrouper différents widgets liés à des APIs. Ce projet a été réalisé par 
 Neil Cauët et Baptiste Daffiniet.
 
## **Sommaire**
 ### [**Le projet**](#le-projet-1)
 ### [**Lancement du projet**](#lancement-du-projet-1)
 ### [**Widgets et services**](#widgets-et-services-1)
 ### [**Dépannage**](#dépannage-1)
 ### [**Explication rapide du code**](#explication-rapide-du-code-1)
 ### [**Explication plus détaillée du code**](#explication-plus-détaillée-du-code-1)
 
 
## **Le projet**
Pour ce projet, nous avons décidé avec Baptiste d'utiliser le langage php ainsi que le framework
symfony en version 5. Nous avons utilisé ce framework car il offre une très grosse mobilité 
pour le code et permet aussi d'utiliser beaucoup d'outils intégrés par la communauté ou les 
développeurs pour les appels d'api par exemple ou pour utiliser le [système d'annotations](https://symfony.com/doc/current/routing.html)
 de symfony. Nous avons trouvé ce projet très enrichissant car il nous a permis d'approfondir
 nos connaissances en web et plus particulièrement dans le php qui est l'un des languages les
 plus utilisés aujourd'hui dans le domaine du développement web.
 
## **Lancement du projet**
 Pour lancer le projet veuillez suivre ces instructions :
 * clonez-le repository en question.
 * rendez-vous à la racine du projet. Vous devriez voir un dossier dashboard, docker et un fichier
 docker-compose.yaml.
 * vérifiez que vous possédez la dernière version de docker-compose et lancez la commande
  `docker-compose build && docker-compose up`
 * vous devriez voir les dockers se lancer un à un. Veuillez attendre quelques instants le temps
 que tous les dockers soient correctement installés.
 * Lorsque vous arrivez à la fin, vous devriez voir aucune activité du côté du terminal dans 
 lequel vous avez lancé les dockers.
 * Vous pouvez accéder au lien [localhost:8080](http://localhost:8080)
 * vous arriverez sur la page de connexion du site, il ne vous reste plus qu'à vous connecter
 ou à créer un compte. 
 * Pour arrêter le projet et les dockers, commencez par kill le processus dans le terminal, vous pouvez ensuite lancer la commande
 `sudo docker container rm (sudo docker container ls -a -q)` pour les utilisateurs fish ou `sudo docker container rm $(sudo docker container ls -a -q)`
 pour les utilisateurs bash
 * Pour vous connecter, il existe déjà 2 comptes pré-configurés. Le premier compte est : username -> farragut; password -> 123456. Le second compte possède
 les droits administrateurs, ses logins sont : username -> admin; password -> admin 
 
 ## **Widgets et services**
 Pour ce projet nous avons décidé d'implémenter 6 widgets de 3 services différents. Voici les différents services avec leurs widgets :
 * ##### *Service Weather*
    * *widget information* : ce widget permet d'avoir des informations sur la ville renseignée en paramètre. Il affichera notamment 
    le nom de la ville sélectionnée avec la température actuelle de l'endroit.
 
 * ##### *Service Steam*
    * *widget app news* : Ce widget permet d'avoir des informations sur les dernières nouveautés d'un jeu. Pour utiliser ce widget, entrez l'appid du jeu en question
    . On peut trouver cet appid sur la page steam du jeu par rapport au lien (exemple `https://store.steampowered.com/app/{APPID}/{nom du jeu}/`).
    
    * *widget profile* : Ce widget permet d'obtenir les informations publiques d'un compte steam. Pour utiliser ce widget. Il suffit de renseigner le 
    steam ID64 du compte en question. Cet id est trouvable sur la page steam d'un profile (exemple `https://steamcommunity.com/profiles/{STEAM64ID}/`).
    On peut notamment obtenir des informations sur le steam 64ID du compte, son nom et un lien permettant de rediriger l'utilisateur sur la page steam du compte.
    
    * *widget recent games* : Ce widget permet d'obtenir les informations sur le jeu joué par un utilisateur sur les 2 dernières semaines. 
    Ce widget va afficher le jeu et donner les informations sur le nom du jeu, l'ID du jeu et le temps passé les 2 dernières semaines sur ce jeu en minutes.
    Pour utiliser le widget il suffit d'entrer l'appid d'un jeu ainsi que le nombre de jeux que nous souhaitons voir.
 
 * #### *Service devise conversion*
    * *widget devise conversion* : Ce widget permet d'avoir la conversion entre 2 devises préalablement sélectionnées et de connaitre le résultat final de la conversion.
 
 * #### *Service Youtube vidéos*
    * *widget youtube vidéo* : Ce widget permet d'avoir des informations sur une vidéo youtube comme le titre, la description, le nombre de vues et le nombre de likes.
    Pour trouver un id de vidéo, il suffit de se rendre sur youtube, de cliquer sur un vidéo et l'id se trouve dans l'url (exemple : `https://www.youtube.com/watch?v={video_id}` ).
## **Dépannage**
Au cas où vous auriez des soucis au lancement du projet, veuillez vous référer à cette section pour voir si votre souci
peut être résolu.
* erreur au lancement des scripts avec des permissions non mises : tentez de lancer le projet avec les droits sudo `sudo docker-compose build && sudo docker-compose up`
* erreur lors du build du DockerFile sur composer. Cela veux dire que l'installation de composer ne s'est pas correctement faites.
Pour résoudre cette erreur suivez ces instructions.
    * vérifiez que vous possédez `composer` d'installé sur votre machine. Si ce n'est pas le cas, installez le.
    * quand vous avez installé `composer`, vérifiez que vous êtes bien sur une version supérieure à ^2.0.0. (`composer -v` pour la vérification de version)
    * rendez-vous dans le dossier dashboard du projet, dans ce dossier lancez la commande `composer install`. Cela aura
    pour but d'installer toutes les dépendances requises pour le bon fonctionnement du projet. (il se peut que vous ayez besoins de lancer avec les droits root `sudo composer install`)
    * attendez que toute l'installation soit terminée. Lorsque c'est le cas rendez-vous à la racine du projet. Vous devez avoir
    les dossiers dashboard, docker et un fichier docker-compose.yaml. Re-suivez le tutoriel de lancement de projet [ici](#lancement-du-projet-1)
* erreur au lancement de docker mais ne concernant pas les droits sudo : vérifiez que le service docker est bien lancé. Pour ce faire
exécutez la commande `sudo systemctl start docker` cela aura pour but de démarrer le service docker. Lancez ensuite `sudo systemctl enable docker`
. Cela permettra d'avoir docker qui s'execute au lancement de votre machine.
* erreur lors de l'installation de unzip et/ou libzip-dev : pour résoudre ce souci, ajoutez au fichier `/etc/resolv.conf` la ligne
`nameserver 8.8.8.8`. Relancez ensuite le service docker et retentez l'installation en ayant au préalable supprimé les anciens containers.

## **Explication rapide du code**
Pour les personnes souhaitant une explication plus détaillée du code et du fonctionnement du projet, 
veuillez vous rendre dans la section [Explication plus détaillée du projet](#explication-plus-détaillée-du-code-1).

Lors du lancement du projet, symfony va d'abord se référer à la page index.php dans le dossier public du projet. Cette page 
va appeler le Kernel du projet qui va ensuite s'occuper d'appeler les bonnes fonctions en fonction du lien qui est appelé, etc.
L'appel des fonctions par rapports au lien est géré grâce aux annotations. Ce bundle permet de gérer plus efficacement les liens de chaque page.
Avec les annotations il n'y a plus qu'à coder la fonction et à retourner une page internet de cette fonction pour qu'elle soit affichée.
Il faut aussi savoir que les fonctions sont organisées en Controller. Un Controller est un peu comme une armoire et chaque fonction
et donc page internet qui lui est reliée est un tiroir de cette armoire. Un Controller va regrouper des fonctions d'un ensemble de pages parlant de la même chose.
Par exemple nous allons créer un Controller pour l'administration et 1 autre Controller pour tout ce qui est en rapport avec les produits et les détails des produits.



## **Explication plus détaillée du code**
Pour ce projet je me suis très rapidement orienté sur le système de notations de symfony. Ce bundle
permet notamment d'utiliser des routes grâce à des annotations dans le code plutôt que de devoir
remplir le fichier route.yaml dans le dossier configuration. Voici un exemple d'annotation
```php
/**
* @Route("/login", name="login")
**/
public function foo()
{
/**
* some code
**/
}
```

Dans ce code, nous pouvons voir que grâce au système d'annotations, symfony va comprendre que si l'utilisateur cherche à accéder au
lien /login, ca sera la fonction foo qui sera lancée et qui gérera l'action par rapport à cette route. Le `name="login"` dans la seconde 
partie de l'annotation `@Route` permet dans le code de redirigé facilement vers une nouvelle page. Pour appeler par exemple cette page nous pourrions
avoir ce code
```php
/**
* @return \Symfony\Component\HttpFoundation\RedirectResponse
**/
public function bar()
{
return $this->redirectToRoute('login');
}
```

Ce code redirigera la personne vers la page /login et donc vers la fonction foo().

Un autre avantage d'utiliser symfony a été pour le rendu des pages html. Pour ça nous avons utilisés [twig](https://twig.symfony.com/).
Twig est un moteur de templates qui permet de faire du code au sein meme du code php. Cela permet notamment 
de faire des boucles, de créer des variables ou de faire beaucoup d'autres choses. Il permet aussi de faire
de l'héritage par rapport aux fichiers. C'est-à-dire que nous pouvons créer un fichier de base qui possédera des block.
Ces block pourrons ensuite être réutilisés dans les fichiers fils qui auront hérités du code du fichier père. Exemple :
```twig
{# base.html.twig #}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{% block title %}Title{% endblock %}</title>
    {% block stylesheets %}
    {% endblock %}
</head>
<body>
{% block body %}{% endblock %}
{% block javascripts %}{% endblock %}
</body>
</html>
```
Dans ce fichier nous pouvons voir que nous avons créés plusieurs block représentant chacun une partie de balise ou une balise html.
Pour modifier le contenu des balises dans un fichier fils il n'y a plus qu'à appeler la balise en question et écrire dedans de cette façon :
```twig
{# fils.html.twig #}
{% extends 'base.html.twig' %}
{% block body %}
bonjour je suis dans le body
{% endblock %}
```

Lorsque nous appellerons notre page fils.html.twig nous aurons affiché à l'écran le contenu du body sans avoir eu à réécrire tout le code html de la page.
Bien sûr de cette façon nous écrasons tout ce qui peut être écrit dans le fichier parent. Pour résoudre ce problème il
suffit d'ajouter la balise `{{ parent() }}` après avoir appelé le block en question.

Avec symfony, nous pouvons lier le code à une base de donnée qu'elle soit en locale ou en ligne. Pour chaque table existant
dans une base de données il faut créer une entity. Cette entity va permettre de faire le lien justement entre le code lorsque l'on va
créer des formulaires par exemple pour ajouter des données ou pour en supprimer. Ces entity sont accessible grâce à un
repository. Le repository est une classe étendue de ServiceEntityRepository et va permettre d'utiliser l'entity grâce à des 
`@methods` implémentées dans les annotations de la classe. Il existe des méthodes par default comme find, findby...

Exemple d'un Controller : 
```php
<?php

namespace App\Controller;

use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="landing")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('widgets');
         }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
```

Pour utiliser le framework symfony, il est conseillé d'utiliser `composer`. Cet outil est un gestionnaire de paquet un peu
spécialisé pour un projet php avec symfony. Lorsque l'on va utiliser un projet, il faut lancer la commande `composer install`
qui va aller chercher dans le fichier composer.json toutes les dépendances requises pour le projet.  