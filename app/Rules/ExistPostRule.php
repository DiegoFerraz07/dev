<?php

namespace App\Rules;

use App\Repositories\PostRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistPostRule implements ValidationRule
{
    protected PostRepository $postRepository;

    public function __construct()
    {
        $this->postRepository = new postRepository();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isPost= $this->postRepository->get($value);
        if(!$isPost) {
            $fail('Users não encontrado!');
        }
    }
}
