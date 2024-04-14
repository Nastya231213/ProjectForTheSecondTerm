<?php

class Review extends Controller
{

    function index()
    {
    }

    function add_for_drink($index)
    { 
    
        $this->add($index, 'drinks');
    }
    function add_for_dishes($index)
    { 
    
        $this->add($index, 'drinks');
    }
    
    private function add($index, $type){
        if (!isLoggedIn()) {

            $this->redirect('login');
        } else {
            if (count($_POST) > 0) {
                $data['rating'] = $_POST['rating'];
                $data['comment'] = $_POST['comment'];

                $data['user_id'] = $_SESSION['user']->id;
                $data['product_id']=$index;
                $processor = new ReviewProcessor();
                $processor->processReview($data);
                $this->redirect($type.'/details/'.$index);
            }
            $this->view('add-review');
        }
    }
}
