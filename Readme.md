## CRUD Notes

# Technologies utilisées

- PHP
- CSS
- Javascript
- Html 5

# Liste des utilisateur de l'application

|  email  | password |  firstName  | lastname  |
|----------------|-------------------------------|-----------------------------|-----------------------------|
|  marwa.wais@he-arc.ch  | 123 |  marwa  | wais  |
|  mael.brandt@he-arc.ch  | 123 |  mael  | brandt  |
|  houssem.themlaoui@he-arc.ch  | 123 |  houssem  | themlaoui  |


# choix username or email

# Pseudonyme :
# Avantages :

- Anonymat partiel : Les utilisateurs peuvent conserver un certain niveau d'anonymat en utilisant un pseudonyme, ce qui peut être important pour certaines applications où la confidentialité est essentielle.
- Facilité de mémorisation : Les pseudonymes peuvent être plus faciles à mémoriser pour les utilisateurs par rapport à une adresse e-mail complexe.
- Personnalisation : Les utilisateurs ont souvent la possibilité de choisir un pseudonyme qui reflète leur personnalité, ce qui peut améliorer l'expérience utilisateur.
# Inconvénients :

- Difficulté de retrouver l'utilisateur : En cas d'oubli du pseudonyme, il peut être difficile pour l'utilisateur de récupérer son compte, car il n'y a pas d'information de contact directe.
- Manque de validation : Les pseudonymes ne sont généralement pas vérifiés, ce qui peut permettre à des utilisateurs de choisir des identifiants inappropriés ou trompeurs.
## Adresse e-mail :
# Avantages :

- Identité vérifiable : Les adresses e-mail sont généralement associées à une identité vérifiable, ce qui peut renforcer la sécurité et aider à prévenir les fraudes.
- Récupération de compte facilitée : En cas d'oubli du mot de passe ou de problème d'accès au compte, la récupération peut être facilitée en utilisant une adresse e-mail pour envoyer des instructions de réinitialisation.
- Communication directe : Les entreprises peuvent communiquer directement avec les utilisateurs via l'adresse e-mail, par exemple pour les notifications de compte, les mises à jour de sécurité, etc.
# Inconvénients :

- Confidentialité limitée : L'utilisation de l'adresse e-mail peut soulever des préoccupations en matière de confidentialité, car elle est souvent considérée comme une information personnelle sensible.
- Complexité de mémorisation : Certaines adresses e-mail peuvent être longues et complexes, ce qui peut rendre leur saisie et mémorisation plus difficile pour les utilisateurs.






[[_TOC_]]

## Objectifs pédagogiques

AW

- démontrer une maîtrise du développement PHP en orienté objet MVC,
  notamment des notions d'inclusion, classe, instanciation, objet,
  héritage, exceptions et d'aptitude à génériciser le
  mini-framework (D.R.Y.), notamment l'ORM simplifié et l'interface
  PDO en binding/objet.

- démontrer une maîtrise du développement web en général, comme par
  exemple: HTML5 (y compris nouveaux éléments sémantiques et
  contraintes côté client dans les formulaires), cookies et
  sessions, formulaires (traitement et validation), flot de
  validation et d'échappement, présentation et interactivité (base
  des CSS et du Javascript), contrôle d'accès le plus centralisé
  possible, redirections sémantiques, sécurité de base, journaux

- vu qu'une maîtrise concrète des concepts vus en cours est nécessaire,
  ne pas utiliser de framework CSS ni JS (mais notre mini-framework
  PHP est obligatoire comme base)

- démontrer un usage de base de Git (commits réguliers avec messages
  utiles)

- remettre l'ensemble du code dans un Git (voir Deliverables)

- doit être rendu de manière à pouvoir émettre un premier feedback
  utile pour l'examen semaine 6 (voir Délai ci-dessous)

- concrètement (voir aussi la Spécification ci-dessous)
  - interface web de gestion d'éléments quelconques
    liés à un propriétaire (appliquer CRUD)
  - implémentation la plus générique possible
  - mise en place de session et de contrôle d'accès simple (le plus
    centralisé possible)
  - notification de succès ou d'erreur via la session, le plus
    générique possible
  - redirections sémantiques
  - login générique et mots de passe stockés hachés
  - administration des utilisateurs en ligne de commande mysql ou
    web Adminer (K.I.S.S.)

BD

- démontrer la maîtrise d'une modélisation de BD relationnelle, au
  niveau conceptuel (E-A), puis relationnel, puis implémenter le
  code SQL correspondant

- configurer le bon jeu de caractère, le bon ordre de tri (COLLATE),
  les bons types de données, valeur par défaut et contraintes
  et le bon backend de base de données MySQL (comme vu au cours AW)

- sauf cas particulier, on utilisera des clés artificielles
  (surrogate key), implémentées comme des types MySQL AUTO_INCREMENT
  et nommés id pour identifier les tuples et lier les tables

- pour les attributs, assurez que l’unicité (UNIQUE) est garantie
  pour les attributs devant être uniques, et appliquez une
  validation (CHECK) lorsque les attributs ont une règle de
  formation bien définie

- remettre la structure et les données de la base de données sous forme
  d'un dump MySQL dans le Git (voir Deliverables)

- appliquer les procédures stockées et triggers

- concrètement:
  - utilisateurs reconnus par le système
  - liens entre tables et intégrité référentielle

Nous recommandons une distance critique en cas d'utilisation de
technologies AI.

## Organisation

### Délai

Dimanche 28 janvier à 23:59, sera évalué et comptera dans la moyenne.
Un feedback rapide AW vous sera donné pour bien préparer l'examen.

### Groupes

Par groupe de 2, éventuellement 1 groupe de 3 si la classe a un nombre
d'étudiants impair.

### Travail

Vous devez travailler dans le Git et faire souvent des commit/push
avec des messages de commit utiles.

Vous pouvez créer un répertoire dans votre Git Applications Web
existant, ou créer un nouveau projet Gitlab (mettez les enseignants
correspondant AW/BD comme Manager du projet Gitlab) et informez par
e-mail au moment du rendu les enseignants d'où se trouvent les
fichiers qui les concernent.

Pour le mini-framework MVC, vous pouvez repartir du [dernier
corrigé](06_CRUD/corriges/crud/pdo-controleur-leger-update/).

## Spécification de l'application

### Fonctionnalités de base

L'application doit:

- permettre à un utilisateur identifié de gérer ses propres notes
  (visualiser, créer, modifier, supprimer), notes qui possèdent une
  pondération (coefficient, similairement à IS-A) et qui sont aussi
  associées à un cours parmi une liste de cours pré-existante dans la
  BD (pas d'opérations CRUD à implémenter ici)

- rediriger un utilisateur non identifié (session) à une une page de
  login: faire ce test de la manière la plus générique possible et à
  un seul endroit si possible

- empêcher les utilisateurs qui ne les ont pas créées d'accéder aux
  notes des autres utilisateurs avec un message d'erreur utile; par
  contre les listes de cours sont globales, et tous peuvent voir la
  moyenne globale des notes de chaque cours
- gérer une historisation automatique des précédentes moyennes de
  cours (faite sous forme de trigger de la BD); leur visualisation
  est optionnelle (voir Base de données ci-dessous)

- implémenter une section Impressum (par exemple dans le contrôleur
  About), voir slide 1.4, Aspects légaux, en page 15.

L'implémentation doit être la plus générique possible (voir ci-dessous
sous Généricité) (D.R.Y.).

Le mot de passe de l'utilisateur doit être haché (avec ou sans sel/salt).

L'administration des utilisateurs et de la liste des cours peut se
faire en ligne de commande mysql ou via Adminer et n'est donc pas
demandée (K.I.S.S.).

Du point de vue de l'application web, on distinguera l'identifiant et
le mot de passe nécessaires au processus d'authentification (login) de
l'identifiant de l'utilisateur durant l'accès à l'application (concept
d'authentification: prouver qui on est; concept d'identification:
savoir qui est l'utilisateur qui agit). Attention: le concept de base
de données d'identifiant / clé ne correspond en général pas à
l'identifiant d'authentification, qui est souvent un simple attribut
UNIQUE. Par contre, l'identifiant servant à l'identification durant la
session utilisateur correspondra à l'identifiant / la clé de la table
correspondante de la base de données.

L'identifiant du point de vue de l'application web lors du login peut être par
exemple un pseudonyme ou une adresse e-mail. Réfléchissez bien aux
avantages et aux inconvénients de votre choix d'identifiant (à
documenter dans le README, voir Deliverables).

### Base de données

Concevoir une base de données relationnelle comme vu au cours BD (modèle
entité-association, modèle relationnel, code SQL) qui puisse stocker les
données suivantes:

- notes
- liste des cours
- utilisateurs reconnus par le système

L'intégrité référentielle sera implémentée (une note appartient à
un seul utilisateur et est liée à un cours).

En plus, on demande de créer une table d'audit/historisation qui
mémorise les moyennes de cours dans le temps: cette table doit être mise à jour _automatiquement_ lors de chaque
opération correspondante de la base de données (== utilisation de
procédures stockées et de déclencheurs).

Comme le cours de BDII a été fait sous PostgreSQL et ce projet sous
MySQL, n'hésitez pas à contacter les enseignants AW concernant des
problématiques spécifiques à MySQL. Toutefois, les enseignants de DB
nous ont signalé vouloir ajouter quelques informations sur les
différences principales.

### Généricité

On demande d'adapter l'interfaçage à la base de données pour qu'il
soit générique. En bref, quel que soit la table accédée le code CRUD
d'accès à la base de données devrait être le même et ne pas être
dupliqué (D.R.Y.).

L'idée est de repartir p.ex. du corrigé du contrôleur léger, les
différentes classes de type Model utilisées (p.ex. ici Note, Cours et
Login par exemple) hériteront d'une classe Model (dans core/database)
qui implémentera, le plus génériquement possible, les fonctions CRUD,
via les fonctions vaguement ORM de PDO (FETCH_CLASS) pour simplifier
le code. Rappelons que PHP a des fonctions pour énumérer les attributs
(propriétés) d'un objet et obtenir le nom de la classe à l'exécution
(voir slide 4.3 page 72).

Dans le cas le plus idéal, ajouter un nouveau modèle de table Truc à
votre application signifierait créer un fichier app/models/Truc.php,
implémentant une classe fille de Model, et ayant ses attributs les
colonnes de Truc. Les méthodes de base de Model faisant le reste
(instanciation d'objet basé sur un SELECT, avec clause WHERE; création
d'objet; mise à jour d'objet: y.c. BD).

### Journalisation (logging)

On demande de créer un objet le plus générique possible (dans core/)
qui permette de faire du logging dans un fichier texte. Exemple
d'informations à logguer au minimum: qui, quand, quoi; par exemple
pour un CREATE, on peut utiliser les ID de base de données (voir
p.ex. last_insert_id() ou PDO::lastInsertId) de l'objet inséré et
indiquer qui l'a inséré et quand.

### Présentation (CSS/JS)

Simplifier le code HTML et ajouter un fichier CSS séparé qui permette de:

- ne plus afficher les messages d'erreur et notification avec le style en
  attribut d'élément, mais utiliser les classes ou l'id, et passer
  par la session de manière générique pour les notifications et les
  erreurs

- afficher les notes non pas sous forme de tableau, mais sous forme de
  flexbox ou de grid, à choix, en groupant par cours

- améliorer l'expérience utilisateur pour proposer l'édition d'une
  note sous forme d'un formulaire tout d'abord caché qui est révélé
  avec le focus (très peu de code Javascript est nécessaire)

- en bonus, améliorer la présentation avec des CSS, p.ex. dans la direction du
  responsive

Attention: les CSS et le Javascript doivent être faits manuellement
(sans framework).

## Deliverables

Votre projet Gitlab devra contenir:

- le code de votre framework et de votre application, sous forme de
  contrôleurs, modèles, views et classes de base et fonctions de
  support

- sous schemas/ à la racine de votre projet: les scans de schéma
  papier sont autorisés; utilisez des formats ouverts et non pas des
  formats de fichiers propriétaires -- un simple navigateur sous
  n'importe quelle plateforme doit pouvoir les afficher (il est
  possible d'également stocker des formats propriétaires à côté des
  formats ouverts) -- ci-dessous les extensions de noms de fichiers
  indiquées sont des recommandations:

  - `classes.png`: un schéma de classe général sous forme PDF, PNG ou SVG

  - `navig.png`: un schéma de navigation expliquant quelles URLs
    permettent d'atteindre quelles URLs, avec l'indication de quelles
    URLs sont éventuellement protégées (nécessitent
    authentification), navigation du point de vue utilisateur
  - `interaction.png`: un schéma d'interaction expliquant quelles
    routes aboutissent à quelles opérations CRUD et quels redirects
    HTTP éventuels
  - `ea.png`: modèle DB entité-association

  - `relationnel.png`: modèle DB relationnel

  - (on renonce au schéma d'implantation SQL, dans `dump.sql` ci-dessous)

  - (on renonce au schéma `routage.png`: un schéma de routage liant les URL
    aux méthodes des contrôleurs utilisées car c'est le contenu du fichier
    `app/routes.php`)

- un dump `dump.sql` de votre BDD à la racine de votre projet (p.ex. avec
  Adminer ou mysqldump) -- vérifiez bien que les procédures stockées s'y trouvent

- un README.md à la racine de votre projet décrivant celui-ci et quelques
  éléments justificatifs des choix de conception effectués



# Pseudonyme :
# Avantages :

- Anonymat partiel : Les utilisateurs peuvent conserver un certain niveau d'anonymat en utilisant un pseudonyme, ce qui peut être important pour certaines applications où la confidentialité est essentielle.
- Facilité de mémorisation : Les pseudonymes peuvent être plus faciles à mémoriser pour les utilisateurs par rapport à une adresse e-mail complexe.
- Personnalisation : Les utilisateurs ont souvent la possibilité de choisir un pseudonyme qui reflète leur personnalité, ce qui peut améliorer l'expérience utilisateur.
# Inconvénients :

- Difficulté de retrouver l'utilisateur : En cas d'oubli du pseudonyme, il peut être difficile pour l'utilisateur de récupérer son compte, car il n'y a pas d'information de contact directe.
- Manque de validation : Les pseudonymes ne sont généralement pas vérifiés, ce qui peut permettre à des utilisateurs de choisir des identifiants inappropriés ou trompeurs.
## Adresse e-mail :
# Avantages :

- Identité vérifiable : Les adresses e-mail sont généralement associées à une identité vérifiable, ce qui peut renforcer la sécurité et aider à prévenir les fraudes.
- Récupération de compte facilitée : En cas d'oubli du mot de passe ou de problème d'accès au compte, la récupération peut être facilitée en utilisant une adresse e-mail pour envoyer des instructions de réinitialisation.
- Communication directe : Les entreprises peuvent communiquer directement avec les utilisateurs via l'adresse e-mail, par exemple pour les notifications de compte, les mises à jour de sécurité, etc.
# Inconvénients :

- Confidentialité limitée : L'utilisation de l'adresse e-mail peut soulever des préoccupations en matière de confidentialité, car elle est souvent considérée comme une information personnelle sensible.
- Complexité de mémorisation : Certaines adresses e-mail peuvent être longues et complexes, ce qui peut rendre leur saisie et mémorisation plus difficile pour les utilisateurs.
