<?= $helper->getHeadPrintCode('Edit '.$entity_class_name) ?>

{% block body %}
    <h1>Edition <?= $entity_class_name ?></h1>

    {{ include('<?= $templates_path ?>/_form.html.twig', {'button_label': 'Modifier'}) }}

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ path('<?= $route_name ?>_index') }} " class="btn  btn-{{crudBack is defined ? crudBack : 'dark'}}">Retour à la liste</a>
        {{ include('<?= $templates_path ?>/_delete_form.html.twig') }}
    </div>
{% endblock %}
