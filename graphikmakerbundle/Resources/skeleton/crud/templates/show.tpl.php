<?= $helper->getHeadPrintCode($entity_class_name) ?>

{% block body %}
    <h1><?= $entity_class_name ?></h1>

    <table class="table">
        <thead>
            <tr>
<?php foreach ($entity_fields as $field): ?>
                <th><?= ucfirst($field['fieldName']) ?></th>
<?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
<?php foreach ($entity_fields as $field): ?>
                <td class="align-middle">{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
<?php endforeach; ?>
            </tr>
        </tbody>
    </table>

    <div class="d-flex mt-3 justify-content-between">
    <a href="{{ path('<?= $route_name ?>_index') }}" class="btn  btn-{{crudBack is defined ? crudBack : 'dark'}}">Retour à la liste</a>
    <div class="d-flex">
        <a href="{{ path('<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}" class="btn btn-{{crudEdit is defined ? crudEdit : 'dark'}} me-2"><i
                class="fa fa-pencil" aria-hidden="true"></i></a>
        {{ include('<?= $templates_path ?>/_delete_form.html.twig') }}
    </div>
</div>

{% endblock %}
