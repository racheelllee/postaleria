<?php
$this->Html->addCrumb(__('Carga Masiva de Imágenes'), ['controller' => 'Productos', 'action' => 'cargaMasivaImg','plugin' => false]);
?>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">
            <?php echo __('Carga Masiva de Imágenes'); ?>
        </span>
        <span class="panel-title-right">

        </span>
    </div>

    <div class="panel-body">
        <div class="row" style=" margin-top: 70px;">
            <div class="col-md-8 col-md-offset-2">

                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">

                            <form action="/productos/cargaMasivaImg" class="dropzone" id="uploadFile">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <a href="/productos/cargaMasivaImg" class="btn btn-submit" style="margin-top: 30px;">Finalizar</a>
                
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">



    $(function() { //maxFiles: 1,
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#uploadFile", {
            dictDefaultMessage: "Arrastra las fotos aquí para subirlas",
            acceptedFiles: "<?= IMG_PRODUCTO_ACCEPTEDFILES ?>",
            maxFilesize: <?= IMG_PRODUCTO_MAXFILESIZE ?>,
            accept: function(file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function() { done("Dimensión no válida."); };
              }
        });

        myDropzone.on("thumbnail", function(file) {
          // Do the dimension checks you want to do
          if (file.width != <?= IMG_PRODUCTO_WIDTH ?> || file.height != <?= IMG_PRODUCTO_HEIGHT ?>) {
            file.rejectDimensions()
          }
          else {
            file.acceptDimensions();
          }
        });

        myDropzone.on("error", function(file, response) {

            $.notify({
                icon: false,
                title: '',
                message: file.name + ' : ' + response
              },{
                type: 'danger',
                animate: {
                  enter: 'animated fadeInUp',
                  exit: 'animated fadeOutRight'
                },
                placement: {
                  from: "top",
                  align: "right"
                },
                offset: 20,
                spacing: 10
              });
        });

        myDropzone.on("success", function(file, serverFileName) {

        });

        myDropzone.on("queuecomplete", function(file) {

//            setTimeout(function(){
//                location.reload();
//            }, 2000);

            console.log("archivo completado");

        });

        $('div.dz-default.dz-message > span').show();
        $('div.dz-default.dz-message').css({'opacity':1, 'background-image': 'none', 'text-align': 'center'});

    });


</script>


