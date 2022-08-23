<li class="menu-title">Navigation</li>
<?php
    $userData = session()->has('userData') ? session()->get('userData'):null;
    if(isset($userData) && !is_null($userData)):
        if(($userData->user_type === "A" || $userData->user_type === "T") && isset($userData->merchant_type) && $userData->merchant_type==='MT')
            echo $this->include('themes/merchant_aside');
        if(($userData->user_type === "A" || $userData->user_type === "M") && isset($userData->merchant_type) && $userData->merchant_type==='MS')
            echo $this->include('themes/standard_aside');
    endif;
