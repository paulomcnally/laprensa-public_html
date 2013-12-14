<?php
# Blogs de portada  - Columna derecha - wordpress LP
require_once "XML/RSS.php";

#$rss =& new XML_RSS("http://www.laprensa.com.ni/blog/feed");
#$rss =& new XML_RSS("htp://raizer2.guegue.com/blog/feed");
$rss = new XML_RSS(ROOTDIR . "/cache/misc/blogs.rss");
$rss->parse();
$i = 0;
foreach ($rss->getItems() as $item) {
  $i++;
  $der_blogs[] =  array('link'=>$item['link'], 'title'=>$item['title'], 'description'=>$item['description'], 'url'=>getImgs($item['content:encoded'],true),'autor'=>$item['dc:creator'],'fecha'=>$item['pubdate']);
  if ($i>=3) break;
}
$smarty->assign('der_blogs', $der_blogs);
# Fin Blogs
