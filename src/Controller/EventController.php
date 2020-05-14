<?php
namespace Controller;

class EventController {
    function participatePage(){
        $addition_head = [
            "<link rel=\"stylesheet\" href=\"/css/participate.css\">",
            "<script src=\"/js/participate/App.js\"></script>",
            "<script src=\"/js/participate/Viewer.js\"></script>",
            "<script src=\"/js/participate/Track.js\"></script>",
            "<script src=\"/js/participate/Clip.js\"></script>",
            "<script src=\"/js/participate/Line.js\"></script>",
            "<script src=\"/js/participate/Rect.js\"></script>",
            "<script src=\"/js/participate/Text.js\"></script>",
            "<script src=\"/js/participate/Group.js\"></script>"
        ];

        view("events/participation", [], $addition_head);
    }
}