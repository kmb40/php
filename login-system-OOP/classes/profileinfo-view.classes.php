<?php
# View Class

class ProfileInfoView extends ProfileInfo { // Pull about the title and the text from the database and dislpay it

    public function fetchAbout($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        echo $profileInfo[0]["profiles_about"];
    }
    public function fetchTitle($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        echo $profileInfo[0]["profiles_introtitle"];
    }
    public function fetchText($userId) {
        $profileInfo = $this->getProfileInfo($userId);

        echo $profileInfo[0]["profiles_introtext"];
    }        
}