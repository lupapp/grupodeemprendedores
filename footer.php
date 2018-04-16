<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<script src="js/cart.js"></script>
<script src="http://code.google.com/apis/gears/gears_init.js" type="text/javascript" charset="utf-8"></script>
<script src="geo.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
    function detectar(){
        if(geo_position_js.init())
        {
            document.getElementById('mapa').innerHTML="Leyendo...";
            geo_position_js.getCurrentPosition(mostra_ubicacion,function(){document.getElementById('mapa').innerHTML="No se puedo detectar la ubicación"},{enableHighAccuracy:true});
        }	else	{
            document.getElementById('mapa').innerHTML="La geolocalización no funciona en este navegador.";
        }
    }
    function mostra_ubicacion(p){
        var coords = p.coords.latitude + "," + p.coords.longitude;
        document.getElementById('mapa').innerHTML="<p>latitud="+p.coords.latitude.toFixed(2)+" longitud="+p.coords.longitude.toFixed(2) + "</p>"
            +"<a href=\"http://maps.google.com/?q="+coords+"\"><img src=\"http://maps.google.com/maps/api/staticmap?center="+coords+"&maptype=hybrid&size=400x400&zoom=12&markers=size:mid|"+coords+"&sensor=false\" alt=\"mapa\"/>aqui</a>";
    }
</script>