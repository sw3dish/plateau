<!DOCTYPE html>
<html>
    <head>
    	<!-- Meta Information -->
        <title>{{settings.site_title}} - {% block page_title %} {% endblock %}</title>
        <meta charset=&quot;utf8&quot; />
        <meta name="description" content="{{settings.meta_description}}">

        <!-- Favicon-->
        <link rel="icon" href="">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="/application/library/css/font-awesome-4.2.0/css/font-awesome.css">
        <link rel="stylesheet" href="/application/library/css/bootstrap.css">
        <link href='http://fonts.googleapis.com/css?family=Andada' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Noto+Serif:400,700,400italic,700italic|Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="/application/library/css/global_styles.css">

    	{% block stylesheets %} {% endblock %}

    </head>
    <body class="{% block body_type %}{% endblock %}">
        {% block content %}{% endblock %}
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Powered by Plateau</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="/application/library/js/jquery-2.1.1.js"></script>
        <script src="/application/library/js/modernizr.js"></script>
        <script src="/application/library/js/bootstrap.js"></script>
        {% block javascripts %}{% endblock %}
    </body>
</html>
