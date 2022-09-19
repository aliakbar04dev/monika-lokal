<!--CUSTOM MODAL -->
<div class="modal fade modalvideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: rgba(38, 38, 38, 0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background-color: #FFD73A; border-radius: 20px;">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body py-0">
              <!--  <video class="video" width="100%" poster="<?= base_url(); ?>/public/assets/img/thumbnail2.png" controls>
                    <source src="<?= base_url(); ?>/public/assets/img/video/felix.mp4" type="video/mp4"> 
				   
                    Your browser does not support HTML video.
                </video> -->
				
			    <iframe id="vid_video" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
				<!-- <iframe src="https://iframe.videodelivery.net/df362e31706e64525ec5ebe0e7958eb9" width="100%" height="400" frameborder="0" allowfullscreen></iframe> -->
            </div>
            <div>
                <p class="title-img-galeri" style="text-align:center; color:#402615;"><span id="vid_judul" style="text-align:center; color:#402615;"></span> <br> <span id="vid_subjudul" style="text-align:center; color:#402615;"></span></p>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->