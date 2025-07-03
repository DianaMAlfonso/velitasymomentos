<?php
// Home controller. Default controller used when no specific route is given.

class HomeController {
    public function index() {
        // Load the default home page
        require __DIR__ . '/../views/home/index.php';

    }
}
