<?php
	require_once 'simple_html_dom.php';
	
	
	if(isset($_GET['android_id'])){
		$html = file_get_html('https://play.google.com/store/apps/details?id='. $_GET['android_id']);
		$video_url =  explode('?', $html->find('span[class=preview-overlay-container]')[0]->getAttribute('data-video-url'))[0];
		//parsed_icon = link.css('.cover-image')[0]['src']
		$icon_url = $html->find('img[class=cover-image]')[0]->src;
		echo json_encode(['youtube_link' => (string)$video_url, 'icon_link' => (string)$icon_url]);
	}elseif(isset($_GET['ios_id'])){
		$html = file_get_html('https://itunes.apple.com/gb/app/'. $_GET['ios_id']);
		$icon_url = $html->find('img[class=artwork]')[0]->src;
		$image_url = $html->find('div[class=lockup]')[0]->find('img')[0]->src;
		echo json_encode(['image_link' => (string)$image_url, 'icon_link' => (string)$icon_url]);
	}else{
		echo "Use app package name /play.php?android_id=com.nianticproject.ingress or play.php?ios_id=id534130702";
	}
?>