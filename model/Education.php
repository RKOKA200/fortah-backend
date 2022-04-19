<?php

class EducationModel extends  Model
{

    public function createEducation()
    {

        // $data2 = json_decode(file_get_contents("php://input"));
        $data = $_POST;
        $imageFolder = "./files/";

        $imageName = $_FILES["image"]['name'];
        $filetowrite = $imageFolder . $imageName;

        if (file_exists($filetowrite)) {
            $increment = 0;
            if (preg_match('/(^.*?)+(?:\((\d+)\))?(\.(?:\w){0,3}$)/si', $imageName, $regs)) {
                $filename = $regs[1];
                $fileext = $regs[3];
                $imageName = $filename . $fileext;
                while (file_exists($imageFolder . $imageName)) {
                    $increment++;
                    $imageName = $filename . $increment . $fileext;
                }
                $filetowrite = $imageFolder . $imageName;
            }
        }



        $create_education_query = "INSERT INTO `education` SET title=:title , image=:image";
        $create_education_stmt = $this->dbh->prepare($create_education_query);
        $create_education_stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
        if ($_FILES["image"]['name']) {
            $create_education_stmt->bindValue(":image", $imageName, PDO::PARAM_STR);
        }

        if ($create_education_stmt->execute()) {
            if ($_FILES) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $filetowrite);
            }
            return $msg = [
                "status" => 1,
                "message" => "Education created!!!"
            ];
        }
    }

    public function getAllEducation()
    {
        $get_alleducation_query = "SELECT * FROM `education`";
        $get_alleducation_stmt = $this->dbh->prepare($get_alleducation_query);
        if ($get_alleducation_stmt->execute()) {
            $results = $get_alleducation_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getSingleEducation()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $get_singleducation_query = "SELECT * FROM  `education_videos` WHERE education_id=:id";
        $get_singleducation_stmt = $this->dbh->prepare($get_singleducation_query);
        $get_singleducation_stmt->bindValue(":id", $data2->id, PDO::PARAM_INT);
        if ($get_singleducation_stmt->execute()) {
            $result = $get_singleducation_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getSinlgeProgram()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $get_singleprogram_query = "SELECT * FROM `education` WHERE id=:id";
        $get_singleprogram_stmt = $this->dbh->prepare($get_singleprogram_query);
        $get_singleprogram_stmt->bindValue(":id", $data2->id, PDO::PARAM_INT);
        if ($get_singleprogram_stmt->execute()) {
            $result = $get_singleprogram_stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function addLesson()
    {

        $data = $_POST;
        $imageFolder = "./files/";

        $imageName = $_FILES["image"]['name'];
        $filetowrite = $imageFolder . $imageName;

        $imageName2 = $_FILES["thumbnail"]['name'];
        $filetowrite2 = $imageFolder . $imageName2;

        print_r($_FILES);

        if (file_exists($filetowrite)) {
            $increment = 0;
            if (preg_match('/(^.*?)+(?:\((\d+)\))?(\.(?:\w){0,3}$)/si', $imageName, $regs)) {
                $filename = $regs[1];
                $fileext = $regs[3];
                $imageName = $filename . $fileext;
                while (file_exists($imageFolder . $imageName)) {
                    $increment++;
                    $imageName = $filename . $increment . $fileext;
                }
                $filetowrite = $imageFolder . $imageName;
            }
        }


        if (file_exists($filetowrite2)) {
            $increment = 0;
            if (preg_match('/(^.*?)+(?:\((\d+)\))?(\.(?:\w){0,3}$)/si', $imageName2, $regs)) {
                $filename2 = $regs[1];
                $fileext = $regs[3];
                $imageName2 = $filename2 . $fileext;
                while (file_exists($imageFolder . $imageName2)) {
                    $increment++;
                    $imageName2 = $filename2 . $increment . $fileext;
                }
                $filetowrite2 = $imageFolder . $imageName2;
            }
        }

        $add_lesson_query = "INSERT INTO `education_videos` SET title=:title,video_src=:video_src,education_id=:education_id ,thumbnail=:thumbnail";
        $add_lesson_stmt = $this->dbh->prepare($add_lesson_query);
        $add_lesson_stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);

        $add_lesson_stmt->bindValue(":education_id", $data["education_id"], PDO::PARAM_INT);

        if ($_FILES["image"]['name']) {
            $add_lesson_stmt->bindValue(":video_src", $imageName, PDO::PARAM_STR);
        }

        if ($_FILES["thumbnail"]['name']) {
            $add_lesson_stmt->bindValue(":thumbnail", $imageName2, PDO::PARAM_STR);
        }
        if ($add_lesson_stmt->execute()) {
            if ($_FILES) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $filetowrite);
            }
            if ($_FILES) {
                move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $filetowrite2);
            }
            return $msg = [
                "status" => 1,
                "message" => "Lesson created!!!"
            ];
        }
    }

    public function getSingleLesson()
    {
        $data2 = json_decode(file_get_contents("php://input"));
        $get_singlelesson_query = "SELECT * FROM `education_videos` WHERE id=:id";
        $get_singlelesson_stmt = $this->dbh->prepare($get_singlelesson_query);
        $get_singlelesson_stmt->bindValue(":id", $data2->id, PDO::PARAM_INT);
        if ($get_singlelesson_stmt->execute()) {
            $result = $get_singlelesson_stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createClientVideoComment()
    {
        $data2 = json_decode(file_get_contents("php://input"));
        $create_videocomment_query = "INSERT INTO `video_comments` SET title=:title ,type=:type,video_id=:video_id,user_type=:user_type";
        $create_videocomment_stmt = $this->dbh->prepare($create_videocomment_query);
        $create_videocomment_stmt->bindValue(":title", $data2->title, PDO::PARAM_STR);
        $create_videocomment_stmt->bindValue(":type", 1, PDO::PARAM_INT);
        $create_videocomment_stmt->bindValue(":video_id", $data2->video_id, PDO::PARAM_INT);
        $create_videocomment_stmt->bindValue(":user_type", 2, PDO::PARAM_INT);
        if ($create_videocomment_stmt->execute()) {
            return $msg = [
                "status" => 1,
                "message" => "Comment created!!!"
            ];
        }
    }

    public function getAllVideoComments()
    {
        $data2 = json_decode(file_get_contents("php://input"));
        $get_videocomments_query = "SELECT * FROM `video_comments` WHERE video_id=:video_id  ORDER BY `video_comments`.`id` DESC ";
        $get_videocomments_stmt = $this->dbh->prepare($get_videocomments_query);
        $get_videocomments_stmt->bindValue(":video_id", $data2->video_id, PDO::PARAM_INT);
        if ($get_videocomments_stmt->execute()) {
            $results = $get_videocomments_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getAllReplies()
    {
        $data2 = json_decode(file_get_contents("php://input"));
        $get_allreplies_query = "SELECT * FROM `replies`";
        $get_allreplies_stmt = $this->dbh->prepare($get_allreplies_query);
        if ($get_allreplies_stmt->execute()) {
            $results = $get_allreplies_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function replyText()
    {
        $data2 = json_decode(file_get_contents("php://input"));
        $create_reply_query = "INSERT INTO `replies` SET title=:title ,reply_tytpe=:reply_tytpe ,comment_id=:comment_id ,user_id=:user_id ";
        $create_reply_stmt = $this->dbh->prepare($create_reply_query);
        $create_reply_stmt->bindValue(":title", $data2->title, PDO::PARAM_STR);
        $create_reply_stmt->bindValue(":reply_tytpe", 1, PDO::PARAM_INT);
        $create_reply_stmt->bindValue(":comment_id", $data2->comment_id, PDO::PARAM_INT);
        $create_reply_stmt->bindValue(":user_id", 1, PDO::PARAM_INT);
        if ($create_reply_stmt->execute()) {
            return $msg = [
                "status" => 1,
                "message" => "Reply created!!!"
            ];
        }
    }

    public function createReplyAdmin()
    {
        $data = $_POST;

        $imageFolder = "./files/";

        $imageName = $_FILES["audio"]['name'];
        $filetowrite = $imageFolder . $imageName;
        if (file_exists($filetowrite)) {
            $increment = 0;

            while (file_exists($imageFolder . $imageName)) {
                $increment++;
                $imageName = $imageName . $increment . '.mp3';
            }
            $filetowrite = $imageFolder . $imageName;
        }

        $create_comment_query = "INSERT INTO `replies` SET title=:title ,reply_tytpe=:reply_tytpe ,comment_id=:comment_id ,user_id=:user_id ";
        $create_comment_stmt = $this->dbh->prepare($create_comment_query);
        if ($_FILES["audio"]['name']) {
            $create_comment_stmt->bindValue(":title", $imageName, PDO::PARAM_STR);
        }
        $create_comment_stmt->bindValue(":comment_id", $data["comment_id"], PDO::PARAM_INT);
        $create_comment_stmt->bindValue(":reply_tytpe", 2, PDO::PARAM_INT);
        $create_comment_stmt->bindValue(":user_id", 1, PDO::PARAM_INT);
        if ($create_comment_stmt->execute()) {
            if ($_FILES) {
                move_uploaded_file($_FILES["audio"]["tmp_name"], $filetowrite);
            }
            return $msg = [
                "status" => 1,
                "message" => "Comment created!"
            ];
        }
    }
}
