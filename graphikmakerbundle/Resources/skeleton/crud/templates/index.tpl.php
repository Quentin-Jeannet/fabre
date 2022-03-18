<?= $helper->getHeadPrintCode($entity_class_name.' index'); ?>

{% block body %}

{% for label, messages in app.flashes(['success', 'danger']) %}
{% for message in messages %}
<div class="alert alert-{{ label }} alert-dismissible fade show" role="alert">
    {{ message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
{% endfor %}
{% endfor %}

<div class="d-flex align-items-center justify-content-between">
    <h1><?= $entity_class_name ?></h1>
    <a href="{{ path('<?= $route_name ?>_new') }}" class="btn btn-{{crudNew is defined ? crudNew : 'info'}}">Nouveau</a>
</div>

    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
<?php foreach ($entity_fields as $field): ?>
                <th><?= ucfirst($field['fieldName']) ?></th>
<?php endforeach; ?>
                <th class="text-end">actions</th>
            </tr>
        </thead>
        <tbody>
        {% for <?= $entity_twig_var_singular ?> in <?= $entity_twig_var_plural ?> %}
            <tr>
<?php foreach ($entity_fields as $field): ?>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
<?php endforeach; ?>
                <td class="text-end">
                    <div class="d-flex justify-content-end">
                        <a href="{{ path('<?= $route_name ?>_show', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}" class="btn btn-{{crudShow is defined ? crudShow : 'secondary'}}  me-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="{{ path('<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}" class="btn btn-{{crudEdit is defined ? crudEdit : 'dark'}}  me-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        {{ include('<?= $templates_path ?>/_delete_form.html.twig') }}
                    </div>
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="<?= (count($entity_fields) + 1) ?>">no records found</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>

{% endblock %}
