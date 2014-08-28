<?php namespace Korra\Models\Interfaces;

interface TagInterface
{
    public function index();
    public function show($id);
    public function create($input);
    public function update($id, $input);
    public function delete($id);
}