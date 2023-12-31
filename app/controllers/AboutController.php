<?php

    class AboutController
    {
        public function index()
        {
            $company = "He-Arc";
            return Helper::view("about", ['company' => $company]);
        }
    }