<label for="name">Name</label>
<input type="text" id="name" name="name" value="{{ product['name'] }}">

{% if (isset($errors['name'])): %}
    <p style="color: red;">{{ errors['name'] }}</p>
{% endif; %}

<label for="description">Destription</label>
<textarea name="description" id="description"  cols="30" rows="10">{{ product['description'] }}</textarea>

<button type="submit">Save</button>