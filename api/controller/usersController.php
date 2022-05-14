<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



class UsersController extends BaseController
{
    private $RequestMethod = "GET";
    private $ErrorDesc = "";
    private $ErrorHeader = "";

    public function Index($limit = 10)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($this->RequestMethod) == 'GET') {

            try {
                $userModel = new User();

                if (
                    isset($arrQueryStringParams['limit'])
                    && $arrQueryStringParams['limit']
                ) {
                    $limit = (int)$arrQueryStringParams['limit'];
                }

                $arrUsers = $userModel->getUsers($limit)->fetchAll(PDO::FETCH_ASSOC);;
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong! Please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }


        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }

    public function Details($id)
    {

        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'GET') {
            try {
                $userModel = new User();

                $arrUser = $userModel->getUserBy($id);
                if ($arrUser->rowCount() > 0) {
                    $responseData = json_encode($arrUser->fetch(PDO::FETCH_ASSOC));
                } else {
                    $this->SetError("User not Found", "HTTP/1.1 404 not Found");
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong! Please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorDesc)
            );
        }
    }



    public function UserAuth($data)
    {
        $loginData =  explode("-", $data);
        $username = $loginData[0];
        $password = $loginData[1];

        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $userModel = new User();

                $arrUser = $userModel->getLoginData($username);
                if ($arrUser->rowCount() > 0) {
                    $responseData = json_encode(["message" => "user found"]);
                    $loginData2 = $arrUser->fetch(PDO::FETCH_ASSOC);
                    //check password
                    if (!password_Verify($password, $loginData2["password"])) {
                        $this->SetError("Username or password not valid", "HTTP/1.1 402 bad request");
                    }
                    //

                } else {
                    $this->SetError("User not Found", "HTTP/1.1 404 not Found");
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong! Please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            session_start();
            $_SESSION["username"] = $username;
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }



    public function Create()
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $userModel = new User();
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $isCreated = $userModel->createUser($input);

                if ($isCreated) {
                    $responseData = json_encode(["message" => "user Created"]);
                } else {
                    $this->SetError(
                        'user NOT Created, try again!',
                        'HTTP/1.1 400 Bad Request'
                    );
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong! Please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            session_start();
            $_SESSION["username"] = $input["username"];

            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }
    public function Update($id)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $userModel = new User();
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $isUpdate = $userModel->updateUser($input, $id);

                if ($isUpdate) {
                    $responseData = json_encode(["message" => "user Upadted"]);
                } else {
                    $responseData = json_encode(["message" => "user NOT Updated, try again!"]);
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong! Please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }

    public function Delete($id)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($this->RequestMethod) == 'POST') {

            try {
                $userModel = new User();

                $arrUser = $userModel->getUserBy($id);
                if ($arrUser->rowCount() > 0) {
                    $userModel->deleteUser($id);
                    $responseData = json_encode(["message" => "user deleted"]);
                } else {
                    $this->SetError("User not Found", "HTTP/1.1 404 not Found");
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong! Please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }



    //check if user already login
    public   function IsLogIn()
    {


        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];

        //check method
        if (!(strtoupper($this->RequestMethod) == 'POST')) {
            $this->sendOutput(
                json_encode(["message" => "Method not supported"]),
                array('HTTP/1.1 422 Unprocessable Entity')
            );
        }

        //check SESSION_ID
        session_start();
        if (!isset($_SESSION["username"])) {
            $this->sendOutput(
                json_encode(["message" => "User Not Log In"]),
                array('HTTP/1.1 404 not Found')
            );
        }

        //true if log in
        $this->sendOutput(
            json_encode(["message" => "user Log in"]),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }


    public function GetUserData($username)
    {
        $userModel = new User();
        $arrUser = $userModel->getLoginData($username);
        if ($arrUser->rowCount() > 0) {
            $responseData = json_encode($arrUser->fetch(PDO::FETCH_ASSOC));
        } else {
            $this->SetError("User not Found", "HTTP/1.1 404 not Found");
        }


        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }








    private function SetError($errorDesc, $errorheader)
    {
        $this->ErrorDesc = $errorDesc;
        $this->ErrorHeader = $errorheader;
    }
}
