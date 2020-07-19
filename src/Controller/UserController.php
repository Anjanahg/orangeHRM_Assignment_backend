<?php
namespace App\Controller;

use App\Entity\Employee;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class UserController extends AbstractController{


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//login function

    /**
     * @Route("/login")
     */
    public function login(Request $request){
        //getting values from frontend
        $obj = json_decode($request->getContent(),true);
        $username = $obj['username'];
        $password = $obj['password'];

        //accessing database
        $user = $this->getDoctrine()->getRepository(User::class)
                                    ->findOneBy([
                                        'username' => $username,
                                        'password' => md5($password),
                                    ]);;

        if($user){
            $isLoggedIn = true;
            $eId = $user->getEid();
        }else{
            $isLoggedIn = false;
            $eId = '';
        }

        $arr = array ('isLoggedIn'=>$isLoggedIn,'eId'=>$eId);
        $response = json_encode($arr);
        return new Response($response);
    }

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   //Read employee data function

    /**
     * @Route("/readAll/")
     */
    public function readAll(Request $request) {
        $obj = json_decode($request->getContent(),true);
        $id = $obj['id'];
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        $fname = $employee->getFname();
        $lname = $employee->getLname();
        $address = $employee->getAddress();

        $arr = array ('fname'=>$fname,'lname'=>$lname,'address'=>$address);
        $response = json_encode($arr);

        return new Response($response);
    }

}
