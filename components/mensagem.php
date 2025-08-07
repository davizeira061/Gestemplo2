<?php
if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
    ?>
    <div class="fundo-transp">...</div>
    <div class="mensagem">
        <h4><?php print $msg ?></h4>
    </div>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('.mensagem').fadeOut();
                $('.fundo-transp').fadeOut()
            }, 2000)
        });
    </script>
<?php } ?>