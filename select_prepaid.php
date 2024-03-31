<?php
ob_start();
session_start();
include('config/koneksi.php');
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);

//error_reporting(0);
if($_GET['id']){
    $explode = explode('_',$_GET['id']);
    //$produkID = str_replace('-',' ',$explode[0]);
    $produkID = $explode[0];
    $brand = $explode[1];
    $kabupaten = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE kategori = '$produkID' AND brand = '$brand' AND status = 1 ORDER BY harga_jual ASC") or die(mysqli_error($conn));
    $no=0;
    while($kk = mysqli_fetch_array($kabupaten)){
        $no++;
        if(isset($_SESSION['user'])){
            $usernya = $_SESSION['user'];
            $cekUser = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$usernya'");
            $cu = mysqli_fetch_array($cekUser);
            if($cu['level'] == 'reseller'){
              $harga = $kk['harga_reseller'];
            }
            else {
              $harga = $kk['harga_jual'];
            }
        }  
        else {
            $harga = $kk['harga_jual'];
        }
                          
?>
                      <div class="col-sm-4 col-6">
                        <input required="" type="radio" id="layanan_<?php echo $no; ?>" class="radio-nominale" name="produkID" value="<?php echo $kk['id']; ?>">
                        <label for="layanan_<?php echo $no; ?>">
                          <?php echo $kk['title']; ?><br>
                          <small>Rp. <?php echo number_format($harga); ?></small>
                        </label>
                      </div>          
                  
<?php
}
}
?>
<script>
      $(document).ready(function() {
        $("input:radio[name=produkID]").change(function (){
            url = "<?php echo $urlweb; ?>/select_pulsa.php?id="+$('input:radio[name=produkID]:checked').val();
            $('#accordionExample').load(url);
            //console.log(url);
            return false;
        });
      });
  </script>