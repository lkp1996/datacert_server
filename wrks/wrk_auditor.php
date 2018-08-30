<?php

class WrkAuditor
{
    private $connection;

    public function get_auditors_list(DBConnection $db_connection, $pk_auditor)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM auditor WHERE pk_auditor != $pk_auditor AND pk_auditor != 1 ORDER BY lastName";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray[] = $row;
            }
        } else {
            echo "No auditor available";
        }
        $this->connection->close();
        return json_encode($emparray);
    }

    public function get_auditor_administration(DBConnection $db_connection, $pk_auditor)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM auditor WHERE pk_auditor = " . $pk_auditor;
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray = $row;
            }
        } else {
            echo "No auditor administration available";
        }
        $this->connection->close();
        return json_encode($emparray);
    }

    public function add_auditor(DBConnection $db_connection, $auditor)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        //$username = checkUsername($auditor->firstName . $auditor->lastName);
        $username = $auditor->firstName . $auditor->lastName;
        $password = $this->generate_password();
        $sql = "INSERT INTO auditor (pk_auditor, lastName, firstName,phone, email, username, password, fk_userType, fk_language)
            VALUES (NULL, '" . addslashes($auditor->lastName) . "', '" . addslashes($auditor->firstName) . "', '" . $auditor->phone
            . "', '" . $auditor->email . "', '" . addslashes($username) . "', '" . md5($password) . "', '" . $auditor->fk_userType
            . "', '" . $auditor->fk_language . "')";
        if ($this->connection->query($sql)) {
            $last_id = $this->connection->insert_id;
        } else {
            $last_id = null;
        }

        $this->connection->close();
        $this->generate_mail_content($auditor->email, $username, $password);
        return $last_id;
    }

    public function delete_auditor(DBConnection $db_connection, $pk_auditor)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "DELETE FROM auditor WHERE auditor.pk_auditor = $pk_auditor";
        if ($this->connection->query($sql)) {
            $message = "OK";
        } else {
            $message = "KO";
        }

        $this->connection->close();
        return $message;
    }

    public function update_auditor_admin(DBConnection $db_connection, $auditor)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "UPDATE auditor SET lastName = '" . addslashes($auditor->lastName) . "', firstName = '" . addslashes($auditor->firstName) . "', 
                  phone = '" . addslashes($auditor->phone) . "', email = '$auditor->email' WHERE auditor.pk_auditor = $auditor->pk_auditor";
        if ($this->connection->query($sql)) {
            $message = "OK";
        } else {
            $message = "KO";
        }

        $this->connection->close();
        return $message;
    }

    public function update_password(DBConnection $db_connection, $auditor)
    {
        $this->connection = mysqli_connect($db_connection->get_server(), $db_connection->get_username(), $db_connection->get_password(), $db_connection->get_dbname());
        mysqli_set_charset($this->connection, "utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $sql = "SELECT * FROM auditor WHERE pk_auditor = '$auditor->pk_auditor' AND password = '$auditor->oldPassword'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE auditor SET password = '$auditor->newPassword' WHERE auditor.pk_auditor = $auditor->pk_auditor";
            if ($this->connection->query($sql)) {
                $message = 1;
            } else {
                $message = 2;
            }
        } else {
            $message = 3;
        }

        $this->connection->close();
        return $message;
    }

    private function checkUsername($username)
    {
        $sql = "SELECT username FROM auditor";
        $result = mysqli_query($this->connection, $sql);
        $num = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["username"] == $username) {
                    $username .= $num;
                    $num++;
                }
            }
        }
        $this->connection->close();
        return $username;
    }

    private function generate_password()
    {
        $length = 8;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

    private function generate_mail_content($dest, $username, $password)
    {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <direction@edelcert.ch>' . "\r\n";
        $message = "<html>
        <head>
        <title>Indentifiant Datacert</title>
        </head>
        <body>
        <p>Nous avons le plaisir de vous faire parvenir votre indentifiant ainsi que votre mot de passe pour accéder à la plateforme <a href=\"https://datacert.ch/\">Datacert</a> (<a href=\"https://datacert.ch/\">http://datacert.ch/</a>).<br></p>
        <p><b>Nom d'utilisateur</b> : " . $username . "<br><b>Mot de passe</b> : " . $password . " </p>
        <p>En vous remerciant de prendre note de ce qui précède, veuillez recevoir, nos meilleures salutations</p>
        <br>
        <p>Stéphane Perrottet, directeur</p>
        <p>EdelCert & InSpectorat<br>Av. de la Gare 8<br>CH - 1700 Fribourg</p>
        <p>0041 79 617 33 61</p>
        </body>
        </html>
        ";

        mail($dest, "Indentifiant Datacert", $message, $headers);
    }
}

?>