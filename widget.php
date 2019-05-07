<!-- This php code isn't wp plugin. -->


<?php
$shinchoku_cnt=(int)0;
$previous_date=strtotime(date('Y-m-d'));
$paged = (int) get_query_var('paged');
$args = array(
    'posts_per_page' => -1,
    'category_name' => '毎日新捗',
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => 'post',
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
	<!-- # 最新記事情報を取得 -->
	<?php
	if($shinchoku_cnt==0){
		$last_post_title=get_the_title();
		$last_post_link=get_the_permalink(get_the_ID());
	}
	?>
	<!-- # カウント -->
	<?php
	$mypost_date=strtotime(get_the_date('Y-n-j').'+1 day');
	if($mypost_date < $previous_date){
		break;
	}else{
		++$shinchoku_cnt;
	}
	$previous_date=$mypost_date
	?>
<?php endwhile; endif; ?>
<h3>毎日新捗</h3>
<h1><?php echo $shinchoku_cnt; ?>日間継続中</h1><hr /><br />
<p>最新記事：</p>
<h4 class="title">
<a href='<?php echo $last_post_link; ?>'><?php echo $last_post_title; ?></a>
</h4>

<?php wp_reset_postdata(); ?>
