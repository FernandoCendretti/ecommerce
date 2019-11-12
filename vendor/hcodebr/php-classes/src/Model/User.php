<?php

namespace Hcode\Model;

use Hcode\DB\Sql;
use Hcode\Model;

class User extends Model
{
    const SESSION = "User";

    public static function login($login, $password)
    {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
            ":LOGIN" => $login
        ));

        if (count($results) === 0) {
            throw new \Exception("Ususário inexisente ou senha inválida", 1);
        }

        $data = $results[0];

        if (password_verify($password, $data["despassword"]) === true) {
            $user = new User();

            $user->setData($data);

            $_SESSION[User::SESSION] = $user.getValues()

            exit;
        } else {
            throw new \Exception("Ususário inexisente ou senha inválida", 1);
        }
    }
}
