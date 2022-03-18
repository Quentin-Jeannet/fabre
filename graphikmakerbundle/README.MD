Dans votre projet, executre la commande : git clone https://gitlab.com/graphikchannel1/inhouse/bundle/graphikmakerbundle.git

Dans le composer.json, remplacer:

    "autoload": {
        "psr-4": {
            "App\\": "src/",
        }
    },

par:

        "autoload": {
        "psr-4": {
            "App\\": "src/",
            "Symfony\\Bundle\\MakerBundle\\" : "graphikmakerbundle"
        }
    },


Lancer la commande `composer dump-autoload`.

Fermer et re-ouvir l'invite de commande

Lancer la commande php bin/console make:crud.

Ajouter les cdn de bootstrap et fontawesome.

Ajouter le form theme bootstrap dans twug.yaml

twig:
    form_themes: ['bootstrap_5_layout.html.twig']

Pour modifier les couleurs, ajouter au variable global de twig les lignes suivante en modifiant les données:

    globals :
        crudNew: 'info'
        crudBack: 'dark'
        crudDelete: 'danger'
        crudEdit: 'secondary'
        crudShow: 'dark'
        crudSuccess: 'success'
