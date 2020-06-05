<?php

namespace Controller;

class HomeController
{
    public function display()
    {
        global $userRepo;
        global $typeRepo;
        global $postRepo;
        $items = array();

        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            if (strpos($search, "@") === 0) {

                //permet de decider quelle partie du string on veut passer en url
                $nickname = substr($search, 1);
                $users = $userRepo->findBy(array("nickname" => $nickname));
                //check if user exists
                if (count($users) == 1) {
                    $user = $users[0];
                    $items = $postRepo->findBy(array('user' => $user->id));
                }
            } else {
                $items = $postRepo->findBy(array("title" => $search));
            };
        } else {
            $items = $postRepo->findAll();
        }
        include '../templates/display.php';
    }
}