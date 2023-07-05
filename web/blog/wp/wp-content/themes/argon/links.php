<?php 
/**

 * Template Name: 友情链接
 */
get_header(); 

function httpcode($url){
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_exec($ch);
    return $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
}

function link_status($link)
{
    //ini_set('max_execution_time',15);
    $status=httpcode($link);
    if($status == 200 ) 
        return "<font color = \"#5ae766\"><p><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 博客可以访问的哦~</p></font>";
    else
        return "<font color=\"#CCA700\"><p><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> 这个博客似乎没法访问呢~</p></font>";
}

//列出指定链接
function the_link_items($id = null)
{
    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
    $output = '';
    if (!empty($bookmarks)) {
        $output .= '<ul class="link-items fontSmooth">';
        foreach ($bookmarks as $bookmark) {
            if (empty($bookmark->link_description)) {
                $bookmark->link_description = 'This guy is so lazy ╮(╯▽╰)╭';
            }

            if (empty($bookmark->link_image)) {
                $bookmark->link_image = 'https://view.moezx.cc/images/2017/12/30/Transparent_Akkarin.th.jpg';
            }
            $output .= '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" rel="friend"><img src="' . $bookmark->link_image . '" src="/load/inload.svg"><span class="sitename">' . $bookmark->link_name . '</span><span>' . link_status($bookmark->link_url). '</span><div class="linkdes">' . $bookmark->link_description . '</div></a></li>';
        }
        $output .= '</ul>';
    }
    return $output;
}

//列出所有链接
function link_items()
{
$linkcats = get_terms('link_category');
$result = '';
if (!empty($linkcats)) {
    foreach ($linkcats as $linkcat) {
        $result .= '<h3 class="link-title"><span class="link-fix">' . $linkcat->name . '</span></h3>';
        if ($linkcat->description) {
            $result .= '<div class="link-description">' . $linkcat->description . '</div>';
        }

        $result .= the_link_items($linkcat->term_id);
    }
} else {
    $result = the_link_items();
}
return $result;
}

?>


<div class="page-information-card-container"></div>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
			// echo link_items();//列出所有友情链接，若列出分组id为49的则改为the_link_items('49') 
            echo "<div class='links'>" . link_items() . "</div>";

			if (get_option("argon_show_sharebtn") != 'false') {
				get_template_part( 'template-parts/share' );
			}
			
			if (comments_open() || get_comments_number()) {
				comments_template();
			}

		endwhile;
		?>
    </main>
</div>

<?php get_footer(); ?>
