<?= $helper->getHeadPrintCode('New '.$entity_class_name) ?>

{% block body %}
    <h1>Nouveau <?= $entity_class_name ?></h1>

    {{ include('<?= $templates_path ?>/_form.html.twig') }}

    <a href="{{ path('<?= $route_name ?>_index') }}" class="btn  btn-{{crudBack is defined ? crudBack : 'dark'}}">Retour à la liste</a>
{% endblock %}
