<form method="post" action="{{ path('<?= $route_name ?>_delete', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}" onsubmit="return confirm('Etes vous sur de vouloir supprimer cette entrée ?');">
    <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>) }}">
    <button class="btn btn-{{crudDelete is defined ? crudDelete : 'danger'}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
</form>
