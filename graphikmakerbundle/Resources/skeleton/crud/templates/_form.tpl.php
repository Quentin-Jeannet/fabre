{{ form_start(form) }}
    {{ form_widget(form) }}
    <div class="text-end mt-3">
        <button class="btn btn-{{crudSuccess is defined ? crudSuccess : 'success'}}">{{ button_label|default('Sauvegarder') }}</button>
    </div>
{{ form_end(form) }}
