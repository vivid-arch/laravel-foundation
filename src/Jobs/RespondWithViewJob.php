<?php

namespace Vivid\Foundation\Jobs;

class RespondWithViewJob extends Job {
    
    private $template;
    private $data;
    
    public function __construct(string $template, array $data)
    {
        $this->template = $template;
        $this->data = $data;
    }
    
    public function handle()
    {
        return view($template, $data);
    }
    
}