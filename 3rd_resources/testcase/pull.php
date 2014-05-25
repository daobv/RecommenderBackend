<?php
/*
config tại các dòng:
50: Địa chỉ máy chủ MySQL
51: Tên CSDL
52: Tài khoản MySQL
53: Mật khẩu MySQL
162: Đường dẫn tới rss
163: Các danh mục cần lấy về
*/

if(isset($_GET['slug'])){
	Pull::connect();
	$slug = $_GET['slug'];
	$queryNews = mysql_query("SELECT * FROM `rs_news` WHERE `slug` = '$slug'");
	if(mysql_num_rows($queryNews) != 0){
		$rsNews = mysql_fetch_object($queryNews);
		$queryCategory = mysql_query("SELECT * FROM `rs_category` WHERE `id` = $rsNews->category");
		$rsCategory = mysql_fetch_object($queryCategory);
		$queryTags = mysql_query("SELECT * FROM `rs_tags` WHERE `id` IN (SELECT `tags` FROM `rs_tags_meta` WHERE `news` = $rsNews->id)");
		while($rsTags = mysql_fetch_object($queryTags)){
			$tags .= ', <a href="?tag='.Pull::get_slug($rsTags->tags).'">'.$rsTags->tags.'</a>';
		}
		echo '<table border="1" width="100%">';
		echo '<tr>';
		echo '<td width="30%"><b>Danh mục:</b></td>';
		echo '<td>'.$rsCategory->category.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><b>Thời gian:</b></td>';
		echo '<td>'.$rsNews->date.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><b>Tiêu đề:</b></td>';
		echo '<td>'.$rsNews->title.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><b>Tóm tắt:</b></td>';
		echo '<td>'.$rsNews->desc.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><b>Nội dung:</b></td>';
		echo '<td>'.$rsNews->content.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><b>Tags:</b></td>';
		echo '<td>'.substr($tags, 1).'</td>';
		echo '</tr>';
		echo '</table>';
	}
	else{
		echo 'Not match the content';
	}
}
elseif(isset($_GET['tag'])){

}
else{
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="http://st.f2.vnecdn.net/responsive/libs/jquery-1.7.1.min.js"></script>
<div id="myDiv"></div>
';
	Pull::read();
}
class Pull{
	public static function connect(){
		$dbhost = 'localhost';
		$dbname = 'recommender';
		$dbuser = 'root';
		$dbpass = 'saolaithe';
		$connect = mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to mysql server');
		mysql_select_db($dbname,$connect) or die('cannot access to database');
		mysql_query("SET NAMES 'UTF8'");
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}

	public function fix_specials($content){
		$content = str_replace("'", "\'", $content);
		//$content = str_replace("&", "&amp;", $content);
		return $content;
	}

	public function get_slug($title){
		$title = str_replace("'", "", $title);
		$title = str_replace("?", "", $title);
		$title = str_replace("!", "", $title);
		$title = str_replace(":", "", $title);
		$title = str_replace("‘", "", $title);
		$title = str_replace("’", "", $title);
		$title = str_replace("\\", "", $title);
		$title = str_replace(" ", "-", $title);
		$title = str_replace(",", "-", $title);
		$title = str_replace(".", "-", $title);
		$title = str_replace("&amp;", "-", $title);
		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'd'=>'đ|Đ',
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
		foreach($unicode as $nonUnicode=>$uni){
			$title = preg_replace("/($uni)/i", $nonUnicode, $title);
		}
		return strtolower($title);
	}

	public function is_existed($slug){
		Pull::connect();
		$query = mysql_query("SELECT * FROM `rs_news` WHERE `slug` = '$slug'") or die($slug);
		$check = mysql_num_rows($query);
		if($check == 0) return false;
		else return true;
	}

	public static function get_content_by_url($url){
		$content = file_get_contents($url);
		do{
			$content = str_replace("  "," ",$content);
		}while(strpos($content,"  ",0)!==false);
		return $content;
	}

    public static function get_content_by_tag($content, $tag_and_more,$include_tag = true){
        $p = stripos($content,$tag_and_more,0);
        
        if($p===false) return "";
        $content=substr($content,$p);
        $p = stripos($content," ",0);
        if(abs($p)==0) return "";
        $open_tag = substr($content,0,$p);
        $close_tag = substr($open_tag,0,1)."/".substr($open_tag,1).">";
        
        $count_inner_tag = 0;
        $p_open_inner_tag = 1; 
        $p_close_inner_tag = 0;
        $count=1;
        do{
            $p_open_inner_tag = stripos($content,$open_tag,$p_open_inner_tag);
            $p_close_inner_tag = stripos($content,$close_tag,$p_close_inner_tag);
            $count++;
            if($p_close_inner_tag!==false) $p = $p_close_inner_tag;
            if($p_open_inner_tag!==false){
                if(abs($p_open_inner_tag)<abs($p_close_inner_tag)){
                    $count_inner_tag++;
                    $p_open_inner_tag++;
                }else{
                    $count_inner_tag--;
                    $p_close_inner_tag++;
                }
            }else{
                $count_inner_tag--;
                if($p_close_inner_tag>0) $p_close_inner_tag++;
            }
        }while($count_inner_tag>0);
        if($include_tag)
            return substr($content,0,$p+strlen($close_tag));
        else{
            $content = substr($content,0,$p);
            $p = stripos($content,">",0);
            return substr($content,$p+1);
        }
    }

	public function get_tag_by_content($content){
		$xmlDoc = new DOMDocument();
		$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"); 
		libxml_use_internal_errors(true);
		$xmlDoc->loadHTML($content);
		libxml_use_internal_errors(false);
		$searchNodes = $xmlDoc->getElementsByTagName("a");
		$tag = array();
		foreach($searchNodes as $k => $v){
			array_push($tag, $xmlDoc->getElementsByTagName("a")->item($k)->nodeValue);//$searchNode->getAttribute('title'));
		}
		//return implode(",", $tag);
		return $tag;
	}
	
	public function is_existed_tag($tag){
		Pull::connect();
		$query = mysql_query("SELECT * FROM `rs_tags` WHERE `tags` = '$tag'") or die($tag);
		$check = mysql_num_rows($query);
		if($check == 0) return false;
		else return true;
	}

	public function get_existed_tag_id($tag){
		Pull::connect();
		$tag_id = mysql_result(mysql_query("SELECT `id` FROM `rs_tags` WHERE `tags` = '$tag'"),0,0);
		return $tag_id;
	}

	public function get_catid_by_slug($cate_slug){
		Pull::connect();
		$cat_id = mysql_result(mysql_query("SELECT `id` FROM `rs_category` WHERE `slug` = '$cate_slug'"),0,0);
		return $cat_id;
	}
	
	public static function read(){
		Pull::connect();
		$rss = new DOMDocument();
		$num = 1;
		$rss_url = 'http://vnexpress.net/rss/';
		$category = array(
			'thoi-su',
			'doi-song',
			'the-gioi',
			'kinh-doanh',
			'giai-tri',
			'the-thao',
			'phap-luat',
			'du-lich',
			'khoa-hoc',
			'so-hoa',
		);
		foreach($category as $rss_slug){
			$rss->load($rss_url.$rss_slug.'.rss');
			foreach ($rss->getElementsByTagName('item') as $node) {
				$item = array (
					'title' => Pull::fix_specials($node->getElementsByTagName('title')->item(0)->nodeValue),
					'desc' => Pull::fix_specials($node->getElementsByTagName('description')->item(0)->nodeValue),
					'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
					'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
					);
				$slug = Pull::get_slug($item['title']);
				if(!Pull::is_existed($slug)){
					$file = Pull::get_content_by_url($item['link']);
					$file = str_replace('<div class="txt_tag">Tags</div>', '', $file);
					$contents = Pull::fix_specials(Pull::get_content_by_tag($file, '<div class="fck_detail width_common">'));
					if($contents == ''){ 
						$contents = Pull::get_content_by_tag($file, '<div id="article_content">');
					}
					$cat_id = Pull::get_catid_by_slug($rss_slug);
					mysql_query("INSERT INTO `rs_news` (`title`, `category`, `slug`, `date`, `desc`, `content`) VALUES ('$item[title]', '$cat_id', '$slug', '$item[date]', '$item[desc]', '$contents')") or die($item['title']);
					$news_id = mysql_insert_id();
					$tag_content = Pull::get_content_by_tag($file, '<div class="block_tag width_common space_bottom_20">');
					$tags = Pull::get_tag_by_content($tag_content);
					foreach($tags as $tag){
						if(!Pull::is_existed_tag($tag)){
							mysql_query("INSERT INTO `rs_tags` (`tags`) VALUES ('$tag')");
							$tags_id = mysql_insert_id();
						}
						else{
							$tags_id = Pull::get_existed_tag_id($tag);
						}
						mysql_query("INSERT INTO `rs_tags_meta` (`news`, `tags`) VALUES ('$news_id', '$tags_id')");
					}
					echo '<script>$("#myDiv").append("<p>'.$num++.': <a href=\"?slug='.$slug.'\">'.$item['title'].'</a></p>");</script>';
				}
				else{
					echo '<script>$("#myDiv").append("<p>Existed: <a href=\"?slug='.$slug.'\">'.$item['title'].'</a></p>");</script>';
				}
			}
		}
	}
}
?>
