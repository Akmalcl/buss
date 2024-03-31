<?php
include('config/koneksi.php');
    
    $keyword = $_POST['keyword'];
    $output = "";
    
    $sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
    $s0 = mysqli_fetch_array($sql_0);
    $urlweb = $s0['urlweb'];
    
    $sql_query = "SELECT * FROM `tb_kategori` WHERE kategori LIKE '%$keyword%'";
    $result = mysqli_query($conn, $sql_query);
    
    
    if($keyword != ''){
        if(mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
                $parent = $row['parent'];
                if($parent == 0 || $parent == 1 || $parent == 2 || $parent == 6){
                    $gamenya = 'game';
                }
                else if($parent == 3){
                    $gamenya = 'pulsa';
                }
                else if($parent == 4){
                    $gamenya = 'emoney';
                }
                else if($parent == 5){
                    $gamenya = 'social';
                }
			  
            //$output .= '<option value="' . $row['toko'] . '">';
            $output .='<li class="list-group-item link-class">
                            <div class="media">
							  <img src="'.$urlweb.'/upload/'.$row['image'].'" class="align-self-center mr-3" width="40" height="40" alt="...">
							  <div class="media-body">
								<h5 class="mt-3" style="font-size: 14px; line-height: 12px; color: #000;"><a href=" '.$urlweb.'/'.$gamenya.'/'.$row['slug'].'/" style="color: #000;><span class="keyword">'.$row['kategori'].'</span></a></h5>
							  </div>
							</div>
                        </li>';
          }
        } else {
          $output .= '<li class="list-group-item link-class">
                            Produk tidak ditemukan
                        </li>';
        }
    }else{
        $output .='';
    }
    echo $output;
?>