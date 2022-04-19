<?php

class TopicModel extends Model
{

    public function createDiscussion()
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


        $create_discussion_query = "INSERT INTO `discussion` SET title=:title,cover=:cover";
        $create_discussion_stmt = $this->dbh->prepare($create_discussion_query);
        $create_discussion_stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
        if ($_FILES["image"]['name']) {
            $create_discussion_stmt->bindValue(":cover", $imageName, PDO::PARAM_STR);
        }
        if ($create_discussion_stmt->execute()) {
            if ($_FILES) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $filetowrite);
            }
            return $msg = [
                "status" => 1,
                "message" => "Discussion created!!!"
            ];
        }
    }

    public function getAllDiscussion()
    {
        $get_alldisc_query = "SELECT * FROM `discussion`";
        $get_alldisc_stmt = $this->dbh->prepare($get_alldisc_query);
        if ($get_alldisc_stmt->execute()) {
            $results = $get_alldisc_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }


    public function getSingleDiscussion()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $get_singledisc_query = "SELECT * FROM `discussion` WHERE id=:id";
        $get_singledisc_stmt = $this->dbh->prepare($get_singledisc_query);
        $get_singledisc_stmt->bindValue(":id", $data2->id, PDO::PARAM_INT);
        if ($get_singledisc_stmt->execute()) {
            $result = $get_singledisc_stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getAllTopic()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $getAll_topics_query = "SELECT * FROM `topics` WHERE disc_id=:disc_id ";
        $getAll_topics_stmt = $this->dbh->prepare($getAll_topics_query);
        $getAll_topics_stmt->bindValue(":disc_id", $data2->disc_id, PDO::PARAM_INT);
        if ($getAll_topics_stmt->execute()) {
            $results = $getAll_topics_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }


    public function getSingleTopic()
    {

        $data2 = json_decode(file_get_contents("php://input"));

        $getsingle_topic_query = "SELECT * FROM `topics` WHERE id=:id";
        $getsingle_topic_stmt = $this->dbh->prepare($getsingle_topic_query);
        $getsingle_topic_stmt->bindValue(":id", $data2->id, PDO::PARAM_INT);
        if ($getsingle_topic_stmt->execute()) {
            $result = $getsingle_topic_stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createTopic()
    {
        $data = $_POST;
        //$data2 = json_decode(file_get_contents("php://input"));
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

        $create_topic_query = "INSERT INTO `topics` SET title=:title ,image=:image,description=:description,user_id=:user_id,disc_id=:disc_id";
        $create_topic_stmt = $this->dbh->prepare($create_topic_query);
        $create_topic_stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
        $create_topic_stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
        $create_topic_stmt->bindValue(":user_id", $data["user_id"], PDO::PARAM_INT);
        $create_topic_stmt->bindValue(":disc_id", $data["desc_id"], PDO::PARAM_INT);
        if ($_FILES["image"]['name']) {
            $create_topic_stmt->bindValue(":image", $imageName, PDO::PARAM_STR);
        }
        if ($create_topic_stmt->execute()) {
            if ($_FILES) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $filetowrite);
            }
            return $msg = [
                "status" => 1,
                "message" => "Topic was created"
            ];
        }
    }


    public function createCommentAdmin()
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

        $create_comment_query = "INSERT INTO `comments` SET title=:title , topic_id=:topic_id,type=:type,user_type=:user_type";
        $create_comment_stmt = $this->dbh->prepare($create_comment_query);
        if ($_FILES["audio"]['name']) {
            $create_comment_stmt->bindValue(":title", $imageName, PDO::PARAM_STR);
        }
        $create_comment_stmt->bindValue(":topic_id", $data["topic_id"], PDO::PARAM_INT);
        $create_comment_stmt->bindValue(":type", $data["type"], PDO::PARAM_INT);
        $create_comment_stmt->bindValue(":user_type", 1, PDO::PARAM_INT);
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

    public function createComment()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $create_comment_query = "INSERT INTO `comments` SET title=:title , topic_id=:topic_id,type=:type,user_type=:user_type";
        $create_comment_stmt = $this->dbh->prepare($create_comment_query);
        $create_comment_stmt->bindValue(":title", $data2->title, PDO::PARAM_STR);
        $create_comment_stmt->bindValue(":topic_id", $data2->topic_id, PDO::PARAM_INT);
        $create_comment_stmt->bindValue(":type", $data2->type, PDO::PARAM_INT);
        $create_comment_stmt->bindValue(":user_type", $data2->user_type, PDO::PARAM_INT);
        if ($create_comment_stmt->execute()) {
            return $msg = [
                "status" => 1,
                "message" => "Comment created!"
            ];
        }
    }

    public function getComments()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $get_comments_query = "SELECT * FROM `comments` WHERE topic_id=:topic_id";
        $get_comments_stmt = $this->dbh->prepare($get_comments_query);
        $get_comments_stmt->bindValue(":topic_id", $data2->topic_id, PDO::PARAM_INT);
        if ($get_comments_stmt->execute()) {
            $results = $get_comments_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function getSingleComment()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $get_siglecomment_query = "SELECT * FROM `comments` WHERE id=:id";
        $get_siglecomment_stmt = $this->dbh->prepare($get_siglecomment_query);
        $get_siglecomment_stmt->bindValue(":id", $data2->id, PDO::PARAM_INT);
        if ($get_siglecomment_stmt->execute()) {
            $result = $get_siglecomment_stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createReply()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $create_reply_query = "INSERT INTO `replies` SET title=:title , reply_tytpe=:reply_tytpe , comment_id=:comment_id,user_id=:user_id";
        $create_reply_stmt = $this->dbh->prepare($create_reply_query);
        $create_reply_stmt->bindValue(":title", $data2->title, PDO::PARAM_STR);
        $create_reply_stmt->bindValue(":reply_tytpe", $data2->reply_type, PDO::PARAM_INT);
        $create_reply_stmt->bindValue(":comment_id", $data2->comment_id, PDO::PARAM_INT);
        $create_reply_stmt->bindValue(":user_id", $data2->user_id, PDO::PARAM_INT);

        if ($create_reply_stmt->execute()) {
            return $msg = [
                "status" => 1,
                "message" => "Reply added!!"
            ];
        }
    }

    public function getReply()
    {
        $data2 = json_decode(file_get_contents("php://input"));

        $get_reply_query = "SELECT * FROM `replies` WHERE comment_id=:comment_id";
        $get_reply_stmt = $this->dbh->prepare($get_reply_query);
        $get_reply_stmt->bindValue(":comment_id", $data2->comment_id, PDO::PARAM_INT);
        if ($get_reply_stmt->execute()) {
            $result = $get_reply_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}
