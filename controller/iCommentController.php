<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14.09.2017
 * Time: 21:16
 */

interface iCommentController
{
    function addNewComment($commentContent, $userId, $superCommentId);
    function getCommentById($commentId);
    function deleteCommentById($commentId);
    function updateCommentById($newCommentContent, $commentId);
    function getAllCommentsByUserId($userId)

}