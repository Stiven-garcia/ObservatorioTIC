<?php
include 'presentacion/home/menu.php';
?>
<script src="https://www.google.com/jsapi?key=XXXXXXXX"></script>
<script src="http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.js" type="text/javascript"></script>
<style type="text/css">
    @import url("http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.css");
    #feedControl {margin-top:20px;width:400px;font-size:16px;color:#9CADD0;padding:12px;}
  </style>
  <script type="text/javascript">
    function load() {
      var feed ="http://norfipc.com/rss.xml";
	    var options = {numResults : 8}
      new GFdynamicFeedControl(feed, "feedControl", options);
    }
    google.load("feeds", "1");
    google.setOnLoadCallback(load);
  </script>
  <div id="feedControl">Cargando...</div>
