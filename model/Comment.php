<?php

class Comment {
    private $id;
    private $sticky;
    private $contextid;
    private $courseid;
    private $rootid;
    private $body;
    private $format;
    //public $body_formatted;
    private $format;
    private $uid;
    private $groupid;
    private $privacy;
    private $created;
    private $updated;

    public function __construct($data = array()) {
        $this->id = $data['id'] ?? null;
        $this->sticky = $data['sticky'] ?? null;
        $this->contextid = $data['contextid'] ?? null;
        $this->courseid = $data['courseid'] ?? null;
        $this->rootid = $data['rootid'] ?? null;
        $this->body = $data['body'] ?? '';
        $this->body_formatted = $data['body_formatted'] ?? '';
        $this->uid = $data['uid'] ?? null;
        $this->groupid = $data['groupid'] ?? null;
        $this->privacy = $data['privacy'] ?? [];
        //$node_data['privacy']['privacyDefault']
        //$node_data['privacy']['privacyOptions']
        //$node_data['permissions']['canCreateComment']
        //$node_data['permissions']['canEdit']
        //$node_data['permissions']['canDelete']
        //$node_data['permissions']['canSetSticky']
        //$node_data['context']['nid']
        //$node_data['context']['title']
        //$node_data['context']['link']
        //$node_data['container']['nid']
        //$node_data['container']['title']
        //$node_data['container']['link']
        //$node_data['attachments'][]
        //$file = file_load($item['fid']);
        //      $attachment = [];
        //      $attachment['fid'] = $file->fid;
        //      $attachment['filesize'] = $file->filesize;
        //      $attachment['uid'] = $file->uid;
        //      $attachment['filename'] = $file->filename;
        //      $attachment['type'] = $file->type;
        //      $attachment['filemime'] = $file->filemime;
        //      $attachment['download_link'] = $icon . " " . l($attachment['filename'], $uri['path'], $uri['options']);
        //      $attachment['permissions'] = [];
        //      $attachment['permissions']['canDelete']
        //$node_data['poll']
        $this->created = $data['created'] ?? time();
        $this->updated = $data['updated'] ?? time();
    }

}


