<?php namespace Korra\Models\Interfaces;

interface PostInterface
{
    public function index($params);
    public function show($postId);
    public function create($input);
    public function update($id, $inpit);
    public function delete($id);
}