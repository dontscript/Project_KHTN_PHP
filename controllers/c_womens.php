<?php
include("models/m_womens.php");  
/**
* 
*/
class C_womens
{
	public function Hien_thi_san_pham_nu() {
		$sort = $limit = $min_price = $max_price = "";
		if (isset($_GET['sort'])) {
			$sort = $_GET['sort'];
			$hidden_sort = "<input type='hidden' name='sort' value='$sort'>"; 
		}
		if (isset($_GET['limit'])) {
			$limit = $_GET['limit'];
			$hidden_limit = "<input type='hidden' name='limit' value='$limit'>"; 
		}
		if (isset($_GET['min_price'])) {
			$min_price = $_GET['min_price'];
			$hidden_min_price = "<input type='hidden' name='min_price' value='$min_price'>";
		}
		if (isset($_GET['max_price'])) {
			$max_price = $_GET['max_price'];
			$hidden_max_price = "<input type='hidden' name='max_price' value='$max_price'>";
		}
		if (isset($_GET['page'])) {
			$current_page = $_GET['page'];
			$hidden_page = "<input type='hidden' name='page' value='$current_page'>";
		} else {
			$current_page = 1;
		}

		include_once("models/pagination.php");
		$m_womens = new M_womens();

		$san_phams = $m_womens->Doc_san_pham_nu("", "", "", "");

		$tong_san_pham_nam = count($san_phams);
		$config = array(
						'current_page'  => $current_page, // Trang hiện tại
						'total_record'  => $tong_san_pham_nam, // Tổng số record
						'limit'         => empty($limit) ? 9 : $limit,// limit
						'link_full'     => $_SERVER['PHP_SELF']."?page={page}&sort={sort}&limit={limit}&min_price={min_price}&max_price={max_price}",// Link full có dạng như sau: domain/com/page/{page}
						'link_first'    => $_SERVER['PHP_SELF'],// Link trang đầu tiên
						'range'         => 5, // Số button trang bạn muốn hiển thị
						'sort'			=> empty($sort) ? 0 : $sort,
						'min_price' 	=> empty($min_price) ? 0 : $min_price,
						'max_price' 	=> empty($max_price) ? 500000 : $max_price
						); 
		$pager = new Pagination();
		$pager->init($config);
		$vi_tri = $pager->_config['start'];
		$paging = $pager->show_paging();
		$san_phams = $m_womens->Doc_san_pham_nu($min_price, $max_price, $sort, $limit, $vi_tri);
		$banner = "Đồ Nữ";
		$title = "Đồ Nữ";   
		$views = ["banner.php", "views/womens/v_womens.php"];
		include("include/layout.php");
	}

}

?>