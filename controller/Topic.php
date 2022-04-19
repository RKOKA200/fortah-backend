<?php

class Topic extends Controller
{

    protected function getAllTopics()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->getAllTopic());
    }

    protected function getSingleTopic()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->getSingleTopic());
    }

    protected function createTopic()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->createTopic());
    }

    protected function createComment()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->createComment());
    }
    protected function getComments()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->getComments());
    }

    protected function getSingleComment()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->getSingleComment());
    }
    protected function createReply()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->createReply());
    }

    protected function getReply()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->getReply());
    }

    protected function createDiscussion()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->createDiscussion());
    }

    protected function getAllDiscussion()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->getAllDiscussion());
    }

    protected function getSingleDiscussion()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->getSingleDiscussion());
    }
    protected function createCommentAdmin()
    {
        $topicModel = new TopicModel();
        echo json_encode($topicModel->createCommentAdmin());
    }
}
