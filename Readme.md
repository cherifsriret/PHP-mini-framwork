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
# Adresse e-mail :
# Avantages :

- Identité vérifiable : Les adresses e-mail sont généralement associées à une identité vérifiable, ce qui peut renforcer la sécurité et aider à prévenir les fraudes.
- Récupération de compte facilitée : En cas d'oubli du mot de passe ou de problème d'accès au compte, la récupération peut être facilitée en utilisant une adresse e-mail pour envoyer des instructions de réinitialisation.
- Communication directe : Les entreprises peuvent communiquer directement avec les utilisateurs via l'adresse e-mail, par exemple pour les notifications de compte, les mises à jour de sécurité, etc.
# Inconvénients :

- Confidentialité limitée : L'utilisation de l'adresse e-mail peut soulever des préoccupations en matière de confidentialité, car elle est souvent considérée comme une information personnelle sensible.
- Complexité de mémorisation : Certaines adresses e-mail peuvent être longues et complexes, ce qui peut rendre leur saisie et mémorisation plus difficile pour les utilisateurs.


## Base de données

# procedure stockée
```sql

CREATE PROCEDURE `maj_audit_avg_course` (IN `p_id_course` INT)   BEGIN
    DECLARE v_avg DECIMAL(10, 2);
   
    -- Début de la transaction implicite
    BEGIN

    SELECT AVG(avrage_user) INTO v_avg 
    FROM 
      ( 
        SELECT user_id, SUM(note * coeficient) / SUM(coeficient) AS avrage_user 
        FROM notes 
        WHERE  course_id = p_id_course
        GROUP BY user_id 
      ) AS user_avg;
    -- Mettre à jour la table d'audit
    INSERT INTO `audits` (`course_id`, `average`, `updated_at`)
    VALUES ( p_id_course, v_avg, NOW());
    -- Mettre à jour la table course mettre a jour la moyenne du cours
    UPDATE `courses` SET `average` = v_avg WHERE  `id` = p_id_course ;
  END;  -- Fin de la transaction implicite
END;

```

Cette procedure stockée calcule la moyenne generale apres chaque insertion, modification ou suppression d'une note par un utilisateur

Notez que le bloc BEGIN et END crée une transaction implicite, où les opérations à l'intérieur seront automatiquement confirmées à la fin du bloc s'il n'y a pas eu d'erreurs. En cas d'erreur, la transaction sera automatiquement annulée. Cela devrait résoudre l'erreur liée aux transactions explicites dans les procédures stockées MySQL.

