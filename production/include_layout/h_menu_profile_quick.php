<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->

<div class="profile clearfix" style="bottom: 36px;clear: both;padding: 5px 0 0 0;position: fixed;width: 270px;background: #364158;padding-bottom: 20px;z-index: 10;">
    <div class="profile_pic">
        <img src="../images/<?php echo $_SESSION['admin_avatar']; ?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Wilkommen</span> <i class="fa fa-circle" style="color: #00A000"></i>
        <h2><?php echo $_SESSION["admin"]; ?></h2>
    </div>
</div>