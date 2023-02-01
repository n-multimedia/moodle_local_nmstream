<?php

namespace local_nmstream;

class CommentController {
    /**
     * Create a new comment
     *
     * @param stdClass $request
     * @return json
     */
    public function create($request) {
        global $DB;
        $context = context_course::instance($request->courseid);

        // Check if the user has permission to create comments
        require_capability('local/nmstream:createcomment', $context);

        // Validate request data
        $validatedData = json_decode($request);
        if (empty($validatedData->content) || !is_string($validatedData->content) ||
                empty($validatedData->post_id) || !is_int($validatedData->post_id)) {
            throw new moodle_exception('invalidrequestdata', 'error');
        }

        // Create a new comment with the validated data
        $comment = new stdClass();
        $comment->content = $validatedData->content;
        $comment->post_id = $validatedData->post_id;
        $comment->created_at = time();
        $comment->id = $DB->insert_record('comments', $comment);

        // Return a response with the new comment's id
        return json_encode(array('id' => $comment->id));
    }

    /**
     * Get a comment by id
     *
     * @param int $id
     * @return json
     */
    public function read(int $id) {
        global $DB;
        // Find the comment by id
        $comment = $DB->get_record('comments', array('id' => $id), '*', MUST_EXIST);

        // Return a response with the comment's data
        return json_encode(array(
                'id' => $comment->id,
                'content' => $comment->content,
                'post_id' => $comment->post_id,
                'created_at' => $comment->created_at
        ));
    }

    /**
     * Update a comment
     *
     * @param stdClass $request
     * @param int $id
     * @return json
     */
    public function update($request) {
        global $DB;
        $context = context_course::instance($request->courseid);

        // Check if the user has permission to update comments
        require_capability('local/nmstream:updatecomment', $context) ||
        require_capability('local/nmstream:updateowncomment', $context);

        // Validate request data
        $validatedData = json_decode($request);
        if (empty($validatedData->content) || !is_string($validatedData->content)) {
            throw new moodle_exception('invalidrequestdata', 'error');
        }

        // Update the comment with the validated data
        $comment = new stdClass();
        $comment->id = $request->id;
        $comment->content = $validatedData->content;
        $DB->update_record('comments', $comment);

        // Return a response with the updated comment's id
        return json_encode(array('id' => $comment->id));
    }

    /**
     * Delete a comment
     *
     * @param int $id
     * @return json
     */
    public function delete($request) {
        global $DB;
        $context = context_course::instance($request->courseid);

        // Check if the user has permission to delete comments
        require_capability('local/nmstream:deletecomment', $context) ||
        require_capability('local/nmstream:deleteowncomment', $context);

        // Find the comment by id
        $comment = $DB->get_record('comments', array('id' => $request->id), '*', MUST_EXIST);

        // Delete the comment
        $DB->delete_records('comments', array('id' => $request->id));

        // Return a response with the deleted comment's id
        return json_encode(array('id' => $comment->id));
    }
}
