<?php

class Education extends Controller
{

    protected function createEducation()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->createEducation());
    }

    protected function getAllEducation()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->getAllEducation());
    }

    protected function getSingleEducation()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->getSingleEducation());
    }

    protected function addLesson()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->addLesson());
    }
    protected function getSingleLesson()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->getSingleLesson());
    }

    protected function getSinlgeProgram()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->getSinlgeProgram());
    }

    protected function createClientVideoComment()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->createClientVideoComment());
    }

    protected function getAllVideoComments()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->getAllVideoComments());
    }
    protected function replyText()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->replyText());
    }

    protected function getAllReplies()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->getAllReplies());
    }
    protected function createReplyAdmin()
    {
        $educationModel = new EducationModel();
        echo json_encode($educationModel->createReplyAdmin());
    }
}
