<?php
include "./_app/Config.php";
class NotFoundController extends RenderView{

    public function index() {

        $this->loadView("notFound", [
           ]);

    }

}