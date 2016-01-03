{% extends 'default.php' %}

{% block page_title %}Blog{% endblock %}

{% block stylesheets %}
<style>

</style>
{% endblock %}

{% block content %}
    <div id="content" class="container">
        <div id="blog">
            <h1 class="title">Blog</h1>
            {% for post in posts %}
                {% if loop.first %}
                    <h3> {% set year = post.date %} {{year | date('Y')}}</h3>
                {% endif %}
                {% if year | date('Y') != post.date | date('Y')%}
                     <h3>{{post.date | date('Y')}}</h3>
                {% set year = post.date%}
                {% endif %}
                <div class="post">
                    <div class="date">{{ post.date | date('F j')}}</div>
                    <div class="title">
                        <a href="/blog/{{ post.link }}">{{ post.title }}</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            {% else %}
                <p>
                	There are currently no articles.
                </p>
            {% endfor %}
        </div>
    </div>
{% endblock %}
