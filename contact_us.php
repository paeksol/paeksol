<?php

$page = "index";
include("header.php");
$visible_select=true;
$title="Contact Us";
$description="Contact Us - Question - Suggestion - Feedback";
?>
<div class="inner-content">
<?php
include("right_popup_message.php");
?>
</div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script>
var myCenter=new google.maps.LatLng(34.170561,-118.837594);

function initialize()
{
	var mapProp = {
	  center:myCenter,
	  zoom:8,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  });

	marker.setMap(map);

	var infowindow = new google.maps.InfoWindow({
	  content:" 3055 E. Thousand Oaks Bl,Westlake Village, Ca 91362",
	  });

	infowindow.open(map,marker);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php

include("footer.php");
?>
