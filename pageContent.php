<?php

abstract class pageContent
{
    protected bool $protected_page = true;
    public abstract function show_content();

    public function is_protected(): bool{
        return $this->protected_page;
    }
}