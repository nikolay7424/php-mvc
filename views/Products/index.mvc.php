{% extends "base.mvc.php" %}

{% block title %}Products{% endblock %}

{% block body %}

<h1>PRODUCTS</h1>

<a href="/products/new">New product</a>

<p>total amount or products: {{ total }}</p>

{% foreach ($products as $product) : %}
    <a href="/products/{{ product["id"] }}/show">
        <h2>{{ product["name"] }}</h2>
    </a>
{% endforeach; %}

{% endblock %}

