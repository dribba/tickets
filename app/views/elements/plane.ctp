<img src="/talleres/img/plano_boutique.jpg" width="600" height="419" border="0" usemap="#map" />

<map name="map">
<!-- #$-:Image map file created by GIMP Image Map plug-in -->
<!-- #$-:GIMP Image Map plug-in by Maurits Rijk -->
<!-- #$-:Please do not edit lines starting with "#$" -->
<!-- #$VERSION:2.3 -->
<!-- #$AUTHOR:mradosta  -->
<area shape="rect" coords="231,94,371,130" title="Platea Central" href="2" />
<area shape="poly" coords="274,136,329,136,329,157,275,157,274,157,274,137" title="Palco Central" href="5" />
<area shape="poly" coords="329,136,366,139,366,160,329,156" title="Palco Lateral Derecho" href="6" />

<area shape="poly" coords="366,139,422,148,424,153,429,154,433,164,366,159,366,158" title="Discapacitados" href="7" />
<area shape="poly" coords="372,94,402,94,425,102,445,115,454,127,456,137,457,142,428,154,423,150,418,142,411,138,402,132,392,130,388,130,378,134,375,135,374,131,371,130" title="Platea Alta Lateral Derecha" href="3" />
<area shape="poly" coords="229,94,229,132,220,134,211,131,195,132,181,144,180,156,147,144,150,127,156,115,176,100,201,94,229,94" title="Platea Alta Lateral Izquierda" href="1" />
<area shape="poly" coords="273,137,274,157,168,163,171,155,180,157,180,149,212,142,246,138,273,137" title="Palco Lateral Izquierdo" href="4" />
<area shape="poly" coords="437,150,454,143,452,346,440,343" title="Popular Visitante" href="9" />
<area shape="rect" coords="144,164,160,345" title="Popular Local" href="8" />
<area shape="poly" coords="153,358,160,355,162,363,171,358,187,368,414,367,414,376,416,379,429,373,439,363,445,365,448,356,453,358,452,369,437,383,423,389,184,391,168,386,160,379,154,370,157,368,154,359" title="Tribuna Central" href="10" />
<area shape="poly" coords="188,346,191,351,411,350,411,346,229,348,208,346,189,346,190,346,189,347" title="Tribuna Central" href="10" />
</map>


<?php
echo $this->MyHtml->scriptBlock(
	'$(document).ready(

		function($) {
			$("#btnSubmit").hide();

			$("img[usemap]").maphilight({
				strokeColor: "eeeeee",
				strokeOpacity: 0.4,
				strokeWidth: 2
			});

			$("area").each(
				function() {
					$(this).attr("href", $.path("locations/view/" + $(this).attr("href")));
				}
			);
		}
	);'
);
?>