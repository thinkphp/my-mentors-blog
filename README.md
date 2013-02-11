RSS Collector Mentors using query.multi
---------------------------------------


##How it works

      /*define YQLs for Multi Requests*/
      $query  = 'select title,link from rss where url="http://feeds.feedburner.com/chrisheilmann" limit 7;';
      $query .= 'select title,link from rss where url="http://feeds.feedburner.com/JohnResig" limit 7;';
      $query .= 'select title,link from rss where url="http://feeds.feedburner.com/WSwI" limit 7;';
      $query .= 'select title,link from rss where url="http://www.phpied.com/feed/" limit 7;';
      $query .= 'select title,link from rss where url="http://feeds.feedburner.com/nczonline" limit 7;';
      $query .= 'select title,link from rss where url="http://dmitrysoshnikov.com/feed/" limit 7;';
      $query .= 'select title,link from rss where url="http://feeds.feedburner.com/addyosmani" limit 7;';
      $query .= 'select title,link from rss where url="http://davidwalsh.name/feed" limit 7;';

      yql = "select * from query.multi where queries='".$query."'";
      $content = get($url);
      $data = json_decode($content);
      echo"<pre>";
      print_r($data);
      echo"</pre>"; 
