<?php
# Model Class

class ProfileInfo extends Dbh { // Establishes database connection, queries profile, creates new profile

    // Queiries profiles
    protected function getProfileInfo($userId) {
        $stmt = $this->connect()->prepare('SELECT * FROM profiles WHERE users_id = ?;');

        if(!$stmt->execute(array($userId))) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailedgetProfileInfo");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../profile.php?error=profilenotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;

    }

    // Updates / Changes default profile data
    protected function setNewProfileInfo($profileAbout, $profileTitle, $profileText, $userId) {
        $stmt = $this->connect()->prepare('UPDATE profiles SET profiles_about = ?, profiles_introtext = ?, profiles_introtitle = ? WHERE users_id = ?;');

        if(!$stmt->execute(array($profileAbout, $profileTitle, $profileText,$userId))) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailedsetNewProfileInfo");
            exit();
        }

        $stmt = null;

    }    

    // Sets up default profile data    
    protected function setProfileInfo($profileAbout, $profileTitle, $profileText, $userId) {
        $stmt = $this->connect()->prepare('INSERT INTO profiles (profiles_about, profiles_introtext, profiles_introtitle, users_id) VALUES (?, ?, ?, ?);');

        if(!$stmt->execute(array($profileAbout, $profileTitle, $profileText, $userId))) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailedsetProfileInfo");
            exit();
        }    

        $stmt = null;
    }
}