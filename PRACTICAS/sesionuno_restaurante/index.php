<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="comida, bucaramanga, turismo">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Happy+Monkey' rel='stylesheet' type='text/css'>
        <title>Restaurante</title>
        <!-- Plugin de jquey
        <script> define un script de javascript
        a traves del atributo src-->
        <script src="js/jquery-1.7.2.min.js"></script>
        <!-- Plugin de jquey easing genera
        animaciones con funciones matematicas-->
        <script src="js/jquery.easing.1.3.js"></script>
        <!-- Plugin de jquey cycle genera
        animaciones con imagenes-->
        <script src="js/jquery.cycle.js"></script>
        <!-- Este script genera la animacion bonita..
        var crea una variable llamada j 
        jQuery trae un metodo noConflict
        para cuando se generan incompatibilidad
        osea ayuda a no generar conflictos..
        jQuery trabaja con selectores en este caso
        se asocia con el ID= fotos platillo es la
        seccion donde estan las fotos..
        j('#fotos_platillo').cycle({ quiere decir
        cuando encuentre fotos platillo integre el
        plugin de cycle y lo que contiene dentro son
        solo parametros, fx: dice que va hacer zoom, etc.
        easing:   delay:-4000 son 4 sg -->
        <script type="text/javascript">
            var j = jQuery.noConflict();
            (function($) {
                j(document).ready(function() {
                    j('#fotos_platillo').cycle({
                        fx: 'scrollDown',
                        easing: 'easeOutBounce',
                        delay: -4000
                    });
                });
            })(jQuery);

        </script>
    </head>
    <body>
        <header>
            <h1 class="h1_header">Tony<span> Restaurante</span></h1>
            <nav>
                <ul>
                    <li><a href="#">Menú</a></li>
                    <li><a href="#">Encuentranos</a></li>
                    <li><a href="#">Servicio a domicilio</a></li>
                    <li><a href="#">Reservaciones</a></li>
                </ul>

            </nav>
        </header>
        <!-- Comienza sesion platillo
            de temporada-->
        <section id="temporada">
            <h1>Platillo de temporada</h1>
            <div id="fotos_platillo" class="pics">
                <!-- La etiqueta alt aparece
                cuando no se cargue la imagen
                o este mal la ruta de la img-->
                <img width="250" 
                     height="188"
                     src="imagenes/platillo1.jpg"
                     alt="Imagen de platillo"
                     style="position:absolute;
                     top: 100px; 
                     left: 100px;
                     display:none;
                     z-index: 4;">
                <img width="250" 
                     height="188"
                     src="imagenes/platillo2.jpg"
                     alt="Imagen de platillo"
                     style="position:absolute;
                     top: 100px; 
                     left: 100px;
                     display:none;
                     z-index: 2;">
                <img width="250" 
                     height="188"
                     src="imagenes/platillo.jpg"
                     alt="Imagen de platillo"
                     style="position:absolute;
                     top: 100px; 
                     left: 100px;
                     display:none;
                     z-index: 1;">
            </div>

            <div id="texto_platillo">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Pellentesque ullamcorper libero et ligula dictum adipiscing. Maecenas dignissim eros et massa accumsan, non sodales elit mollis. Suspendisse vel lectus in turpis commodo congue iaculis vel nisi. Morbi at metus nisi.
                    Nam ornare mi in dolor condimentum, at volutpat elit volutpat. Proin faucibus lorem dui. Morbi venenatis porta dignissim. Donec fermentum dolor nunc, in fermentum est posuere eu. Proin sit amet magna id ligula tempor sollicitudin et vitae nisl. In et vestibulum lectus, at consequat magna. 
                    Vivamus lacus justo, pellentesque quis est ut, vehicula porta odio. Pellentesque nec condimentum lectus.
                </p>
            </div>
        </section>
        <!-- Finaliza sesion platillo
            de temporada-->
        <section id="sucursales">
            <h1>Sucursales</h1>
            <section class="sucursal">
                <iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=es-419&amp;geocode=&amp;q=club+campestre+Santander,+Bucaramanga,+Colombia&amp;aq=&amp;sll=7.067291,-73.110602&amp;sspn=0.012521,0.015149&amp;ie=UTF8&amp;hq=club+campestre&amp;hnear=Bucaramanga,+Santander,+Colombia&amp;t=m&amp;ll=7.066056,-73.111653&amp;spn=0.012777,0.012832&amp;z=15&amp;output=embed"></iframe>
                <br />
                <small>
                    <a href="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es-419&amp;geocode=&amp;q=club+campestre+Santander,+Bucaramanga,+Colombia&amp;aq=&amp;sll=7.067291,-73.110602&amp;sspn=0.012521,0.015149&amp;ie=UTF8&amp;hq=club+campestre&amp;hnear=Bucaramanga,+Santander,+Colombia&amp;t=m&amp;ll=7.066056,-73.111653&amp;spn=0.012777,0.012832&amp;z=15" style="color:#0000FF;text-align:left">
                        Ver mapa más grande</a>
                </small>
            </section>
            <section class="sucursal">
                <iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=es-419&amp;geocode=&amp;q=parque+recreacional+el+lago+Santander,+Bucaramanga,+Colombia&amp;aq=&amp;sll=7.07123,-73.104701&amp;sspn=0.01267,0.006781&amp;ie=UTF8&amp;hq=parque+recreacional+el+lago&amp;hnear=Bucaramanga,+Santander,+Colombia&amp;t=m&amp;ll=7.071294,-73.101225&amp;spn=0.012777,0.012832&amp;z=15&amp;iwloc=10639332083747612438&amp;output=embed"></iframe>
                <br />
                <small>
                    <a href="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es-419&amp;geocode=&amp;q=parque+recreacional+el+lago+Santander,+Bucaramanga,+Colombia&amp;aq=&amp;sll=7.07123,-73.104701&amp;sspn=0.01267,0.006781&amp;ie=UTF8&amp;hq=parque+recreacional+el+lago&amp;hnear=Bucaramanga,+Santander,+Colombia&amp;t=m&amp;ll=7.071294,-73.101225&amp;spn=0.012777,0.012832&amp;z=15&amp;iwloc=10639332083747612438" style="color:#0000FF;text-align:left">
                        Ver mapa más grande</a>
                </small>
            </section>
            <section class="sucursal">
                <iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=es-419&amp;geocode=&amp;q=restaurante+tony+Santander,+Bucaramanga,+Colombia&amp;aq=&amp;sll=7.070613,-73.097577&amp;sspn=0.012393,0.019741&amp;ie=UTF8&amp;hq=restaurante+tony&amp;hnear=Bucaramanga,+Santander,+Colombia&amp;t=m&amp;ll=7.125933,-73.112297&amp;spn=0.02555,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
                <br />
                <small>
                    <a href="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es-419&amp;geocode=&amp;q=restaurante+tony+Santander,+Bucaramanga,+Colombia&amp;aq=&amp;sll=7.070613,-73.097577&amp;sspn=0.012393,0.019741&amp;ie=UTF8&amp;hq=restaurante+tony&amp;hnear=Bucaramanga,+Santander,+Colombia&amp;t=m&amp;ll=7.125933,-73.112297&amp;spn=0.02555,0.025663&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">
                        Ver mapa más grande</a>
                </small>
            </section>
        </section>
        <footer>
            <p>
                Nam ornare mi in dolor condimentum, at volutpat elit volutpat. Proin faucibus lorem dui. Morbi venenatis porta dignissim. Donec fermentum dolor nunc, in fermentum est posuere eu. Proin sit amet magna id ligula tempor sollicitudin et vitae nisl. In et vestibulum lectus, at consequat magna. 
                Vivamus lacus justo, pellentesque quis est ut, vehicula porta odio. Pellentesque nec condimentum lectus. 
            </p>
        </footer>
    </body>
</html>
