<?php

    class user extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data user';
        $data['users'] =  $this->model('user_model')->getAllUsers();
        $this->view('list', $data);
    }

    public function detail($id)
    {
        $data["judul"] = "Detail user";
        $data['user'] = $this->model('User_model')->getUserByld($id);
        $this->view('detail, $data');
    }

}











   

?>
