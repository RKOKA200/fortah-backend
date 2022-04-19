<?php 
 class UserModel extends Model {

    public function login()
    {
            $data2 = json_decode(file_get_contents("php://input"));
            $msg = [];

            if (isset($data2->email) && isset($data2->password)) {
                    $fetch_user_by_username = "SELECT * FROM `user` WHERE `email`=:email";
                    $fetch_stmt = $this->dbh->prepare($fetch_user_by_username);
                    $fetch_stmt->bindValue(":email", $data2->email, PDO::PARAM_STR);
                    $fetch_stmt->execute();

                    if ($fetch_stmt->rowCount()) {
                            $generatedToken = md5(openssl_random_pseudo_bytes(32));
                            $row = $fetch_stmt->fetch(PDO::FETCH_ASSOC);


                            $check_password = password_verify($data2->password, $row['password']);
                            $change_token_query = "UPDATE `user` SET user.token=:token WHERE  user.id=" . $row['id'] . " ";
                            $change_token_stmt = $this->dbh->prepare($change_token_query);
                            $change_token_stmt->bindValue(":token", $generatedToken, PDO::PARAM_STR);
                            $change_token_stmt->execute();

                            if ($check_password) {


                                    return  $msg = [

                                            'status' => 1,
                                            'message' => 'Hyrje me sukses!',
                                            'token' => $generatedToken,
                                            'id' => $row['id'] * 1,
                                            'type' => $row['type'] * 1

                                    ];
                            } else {
                                    return $msg = [
                                            'status' => 0,
                                            'message' => 'Username ose password gabim'
                                    ];
                            }
                    } else {
                            return $msg = [
                                    'status' => 0,
                                    'message' => 'Username ose password gabim'
                            ];
                    }
            } else {
                    return $msg = [
                            'status' => 0,
                            'message' => "Njera nga fushat ose te dyja jane bosh!"
                    ];
            }
    }


    public  function addAdmin()
    {

            $data = json_decode(file_get_contents("php://input"));
            $msg = [];

            $add_admin_query = "INSERT INTO `user` SET email=:email , password=:password , token=:token , name=:name , type=:type";
            $add_admin_stmt = $this->dbh->prepare($add_admin_query);
            $add_admin_stmt->bindValue(":email", $data->email, PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":password", password_hash($data->password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":token", md5(openssl_random_pseudo_bytes(32)), PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":name", $data->name, PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":type", 1, PDO::PARAM_INT);
            if ($add_admin_stmt->execute()) {
                    return $msg = [
                            "status" => 1,
                            "message" => "Admin was added",
                    ];
            } else {
                    return $msg = [
                            "status" => 0,
                            "message" => "Admin was not added",
                    ];
            }
    }
    public  function addUser()
    {

            $data = json_decode(file_get_contents("php://input"));
            $msg = [];

            $add_admin_query = "INSERT INTO `user` SET email=:email , password=:password , token=:token , name=:name , type=:type";
            $add_admin_stmt = $this->dbh->prepare($add_admin_query);
            $add_admin_stmt->bindValue(":email", $data->email, PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":password", password_hash($data->password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":token", md5(openssl_random_pseudo_bytes(32)), PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":name", $data->name, PDO::PARAM_STR);
            $add_admin_stmt->bindValue(":type", 2, PDO::PARAM_INT);
            if ($add_admin_stmt->execute()) {
                    return $msg = [
                            "status" => 1,
                            "message" => "Admin was added",
                    ];
            } else {
                    return $msg = [
                            "status" => 0,
                            "message" => "Admin was not added",
                    ];
            }
    


 }

 public function getUser() {

        $data = json_decode(file_get_contents("php://input"));

        $get_user_query = "SELECT * FROM `user` WHERE id=:id";
        $get_user_stmt = $this->dbh->prepare($get_user_query);
        $get_user_stmt->bindValue(":id",$data->id,PDO::PARAM_INT);
        if($get_user_stmt->execute()){
                $result = $get_user_stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
        }

 }

 
 }
