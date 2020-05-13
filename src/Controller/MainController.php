<?php
namespace Controller;

class MainController 
{
    function indexPage()
    {
        view("index");
    }

    function overviewPage()
    {
        view("biff/overview");
    }

    function eventPage()
    {
        view("biff/event-info");
    }
}