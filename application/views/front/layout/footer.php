<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/bootstrap.min.js"></script>
<script src="<?= base_url()?>public/asset/front/js/datepicker.js"></script>
<script src="<?= base_url()?>public/asset/front/js/plugins.js"></script>
<script src="<?= base_url()?>public/asset/front/js/main.js"></script>
<script src="<?= base_url()?>public/asset/front/js/common.js"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/toastr.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/inspinia.js" type="text/javascript"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/comman_function.js" type="text/javascript"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/ajaxfileupload.js" type="text/javascript"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/jquery.form.min.js" type="text/javascript"></script>
<?php
if (!empty($js)){ 
 foreach ($js as $value){ ?>
<script src="<?= base_url()?>public/asset/front/js/<?php echo $value; ?>" type="text/javascript"></script>

<?php } } ?>
<script>
    jQuery(document).ready(function() {
        <?php
        if (!empty($init)) {
            foreach ($init as $value) {
                echo $value . ';';
            }
        }
        ?>
    });
</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>