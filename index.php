<?php
                $title = "My JS/PHP Mentors Feed";
 
                /*define YQLs for Multi Requests*/
                $query  = 'select title,link from rss where url="http://feeds.feedburner.com/chrisheilmann" limit 7;';
                $query .= 'select title,link from rss where url="http://feeds.feedburner.com/JohnResig" limit 7;';
                $query .= 'select title,link from rss where url="http://feeds.feedburner.com/WSwI" limit 7;';
                $query .= 'select title,link from rss where url="http://www.phpied.com/feed/" limit 7;';
                $query .= 'select title,link from rss where url="http://feeds.feedburner.com/nczonline" limit 7;';
                $query .= 'select title,link from rss where url="http://dmitrysoshnikov.com/feed/" limit 7;';
                $query .= 'select title,link from rss where url="http://feeds.feedburner.com/addyosmani" limit 7;';
                $query .= 'select title,link from rss where url="http://davidwalsh.name/feed" limit 7;';

                $root = 'http://query.yahooapis.com/v1/public/yql?q=';
                $yql = "select * from query.multi where queries='".$query."'";
                $url = $root . urlencode($yql) . '&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&diagnostics=false';  

                /*
                //access forbbiden robots.txt redirect
                $davidxpath = " xpath=\"//div[@id=\'bigShow\']\"";
                $davidquery = "select * from html where url=\"http://davidwalsh.name\"  and $davidxpath";
                $bigShow = getBigShow($davidquery);
                */

                $content = get($url);
                $data = json_decode($content);
#for debug
//echo"<pre>";
//print_r($data);
//echo"</pre>";

                $results = $data->query->results->results;

                $heilmann = '<h2>christianheilmann.com</h2><ul>';
 
                        foreach($results[0]->item as $r) {

                              $heilmann .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $heilmann .= '</ul>';

                $dustin = '<h2>johnresig.com</h2><ul>';
 
                        foreach($results[1]->item as $r) {

                              $dustin .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $dustin .= '</ul>';


                $john = '<h2>dustindiaz.com</h2><ul>';
 
                        foreach($results[2]->item as $r) {

                              $john .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $john .= '</ul>';


                $phpied = '<h2>phpied.com</h2><ul>';
 
                        foreach($results[3]->item as $r) {

                              $phpied .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $phpied .= '</ul>';


                $ncz = '<h2>nczonline.com</h2><ul>';
 
                        foreach($results[4]->item as $r) {

                              $ncz .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $ncz .= '</ul>';


                $dmitry = '<h2>dmitrysoshnikov.com</h2><ul>';
 
                        foreach($results[5]->item as $r) {

                              $dmitry .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $dmitry .= '</ul>';

                $addy = '<h2>addyosmani.com</h2><ul>';
 
                        foreach($results[6]->item as $r) {

                              $addy .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $addy .= '</ul>';

                $david = '<h2>davidwalsh.name</h2><ul>';
 
                        foreach($results[7]->item as $r) {

                              $david .='<li><a href="'.$r->link.'">'.$r->title.'</a></li>';
                        }

                        $david .= '</ul>';

                       
                function get($url) {
                         $ch = curl_init();
                         curl_setopt($ch,CURLOPT_URL,$url);
                         curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                         curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
                         $data = curl_exec($ch);
                         curl_close($ch);  
                         if(empty($data)) {
                            return 'Error retrieve data, please try again.';
                         } else {return $data;}
                }//endfunction


                function getBigShow($yql) {
                         $url = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($yql) . '&format=xml'; 
                         $ch = curl_init();
                         curl_setopt($ch,CURLOPT_URL,$url);
                         curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                         curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
                         $data = curl_exec($ch);
                         $data = preg_replace('/<\?.*\?>/','',$data);
                         $data = preg_replace('/<\!--.*-->/','',$data);
                         $data = preg_replace("/.*<results>|<\/results>.*/",'',$data);
                         $data = preg_replace('/<\/results><\/query>/','',$data);
                         $data = preg_replace('/<results>/','',$data);
                         curl_close($ch);  
                         if(empty($data)) {
                            return 'Error retrieve data, please try again.';
                         } else {return $data;}   
                }//endfunction
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>My Mentors RSS Blogs</title>
   <style type="text/css">
    html,body{color:#fff;background:#222;font-family:calibri,verdana,arial,sans-serif;}
    h1{font-size:300%;margin:0;text-align:left;color:#3c3}
    h1 {
      font-weight:bold;
      font-size:70px;
      letter-spacing:-5px;
      margin-bottom:0;
      position:relative;  
    }
    h2{background:#369;padding:5px;color:#fff;font-weight:bold;-moz-box-shadow: 0px 4px 2px -2px #000;-moz-border-radius:5px;-webkit-border-radius:5px;text-shadow: #000 1px 1px}
    h3 a{color:#69c;text-decoration:none;}
    h3{margin:0 0 .2em 0}
    ul,ul li{margin:0;padding:0;list-style:none;}
    p span{display:block;text-align: left;margin-top:.5em;font-size:90%;color:#999;}
    #heilmann a{color:#c6c;}
    #heilmann h2{background:#c6c;}
    #dustin a{color:#72D215;}
    #dustin h2{background:#72D215;}
    #john a{color:#60FFE9;}
    #john h2{background:#60FFE9;}
    #phpied h2{background:#72D215;}
    #phpied a{color:#72D215;}
    #phpied h2{background:#72D215;}
    #ncz h2{background:#c6c;;}
    #ncz a{color:#c6c;;}
    #ncz h2{background:#c6c;}
    #dmitry h2{background:#60FFE9;}
    #dmitry a{color:#60FFE9;}
    #dmitry h2{background:#60FFE9;}
    #addy h2{background: #A83966;}
    #addy a{color:#A83966;}
    #addy h2{background: #A83966}
    #david h2{background:#ccc;;}
    #david a{color:#ccc;;}
    #david h2{background:#ccc;}
    #david #bigShow h1 a{font-size: 50px;text-decoration:none}    
    #ft p{color:#ccc;text-align: right;}
    #ft a{color:#3c3;}
    #timespent{color: #ccc;font-family: calibri;font-size: 200%}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1><?php echo$title; ?></h1></div>
   <div id="bd" role="main">
     <div class="yui-gb">
        <div class="yui-u first" id="heilmann">
        <?php echo$heilmann; ?>
        </div>
        <div class="yui-u" id="dustin">
        <?php echo$dustin; ?>
        </div>
        <div class="yui-u" id="john">
        <?php echo$john; ?>
        </div>
    </div>
    <div class="yui-gb">
        <div class="yui-u first" id="phpied">
        <?php echo$phpied; ?>
        </div>
        <div class="yui-u" id="ncz">
        <?php echo$ncz; ?>
        </div>
        <div class="yui-u" id="dmitry">
        <?php echo$dmitry; ?>
        </div>
        <div class="yui-u" id="addy">
        <?php echo$addy; ?>
        </div>
    </div>

    <div class="yui-gb">
        <div class="yui-u first" id="david">
        <?php echo$david; ?>
        </div>
    </div>

   </div>
   <div id="ft" role="contentinfo"><p>@<a href="http://thinkphp.ro/+">thinkphp</a> using YUI, YQL and query.multi</p></div>
</div>

</body>
</html>
