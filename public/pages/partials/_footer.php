<div class="row text-white justify-content-center" style="background-color:#838383;">
    <div class="container-fluid top-footer py-2 text-white" style="margin-bottom:0;background:#222222;">
        <div class="row">
            <div class="col-sm-3 footer-text">
                <h6 class="text-uppercase">Location</h6>
                <div id="googleMap" style="width:100%;height:200px;"></div>
            </div>
            <div class="col-sm-3 footer-text">
                <h6 class="text-uppercase">About us</h6>
            </div>
            <div class="col-sm-3 footer-text">
                <h6 class="text-uppercase">Latest Testimonials</h6>
                <ul>
                    <li>
                        <a href="">
                            <img src="../img/background/background.jpg" alt="" style="width:30px;height:30px;border-radius:50%;margin-right:8px;float:left;">
                            <p class="text-lowercase" style="font-size:14px;line-height:12px;"> Lorem ipsum dolor sit amet consectetur adipisicing elit....</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="../img/background/background.jpg" alt="" style="width:30px;height:30px;border-radius:50%;margin-right:8px;float:left;">
                            <p class="text-lowercase" style="font-size:14px;line-height:12px;"> Lorem ipsum dolor sit amet consectetur adipisicing elit....</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="../img/background/background.jpg" alt="" style="width:30px;height:30px;border-radius:50%;margin-right:8px;float:left;">
                            <p class="text-lowercase" style="font-size:14px;line-height:12px;"> Lorem ipsum dolor sit amet consectetur adipisicing elit....</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="../img/background/background.jpg" alt="" style="width:30px;height:30px;border-radius:50%;margin-right:8px;float:left;">
                            <p class="text-lowercase" style="font-size:14px;line-height:12px;"> Lorem ipsum dolor sit amet consectetur adipisicing elit....</p>
                        </a>
                    </li>



                </ul>
            </div>
            <div class="top-social-links footer-text col-sm-3">
                <h6 class="text-uppercase">Follow us on social sites</h6>
                <div class="d-flex justify-content-between mb-4 footer-area">
                    <?php
                    $socialMediaData = $frontEnd->socialMediaDataView($tableSocialMedia);
                    if (!empty($socialMediaData)) {
                        foreach ($socialMediaData as $mediaData) { ?>
                            <a href="<?= $mediaData->site_name; ?>" target="blank">
                        <?php
                                if ($mediaData->site_name == 'http://www.facebook.com') {
                                    echo '<i class="fab fa-facebook-square"></i>';
                                } elseif ($mediaData->site_name == 'https://www.twitter.com') {
                                    echo '<i class="fab fa-twitter"></i>';
                                } elseif ($mediaData->site_name == 'http://www.linkedin.com') {
                                    echo '<i class="fab fa-linkedin"></i>';
                                } elseif ($mediaData->site_name == 'https://www.github.com') {
                                    echo '<i class="fab fa-github"></i>';
                                } elseif ($mediaData->site_name == 'https://www.plus.google.com') {
                                    echo '<i class="fab fa-google-plus"></i>';
                                } elseif ($mediaData->site_name == 'https://www.youtube.com') {
                                    echo '<i class="fab fa-youtube"></i>';
                                } else { }
                            }
                        }
                        ?>
                            </a>
                </div>
                <div class="facebook justify-content-around">
                    <a href="http://www.facebook.com" target="blank"><img src="../img/logo/facebookProfile.jpg" class="img-fluid img-thumbnail" alt="Facebook"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom footer bar -->
    <div class="container-fluid d-flex flex-column justify-content-center" style="background-color:#111111;">
        <div class="bottom-footer-bar d-flex justify-content-center py-2">
            <span><?php echo date('Y'); ?> All rights reserved</span>
        </div>
    </div>
    <!-- Bottom footer bar -->
</div>
